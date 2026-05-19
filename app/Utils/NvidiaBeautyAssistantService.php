<?php

namespace App\Utils;

use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class NvidiaBeautyAssistantService
{
    public function respond(string $message): array
    {
        $products = Product::getAssistantAvailableProducts();

        $apiKey = (string) config('services.nvidia.api_key');

        if ($apiKey === '') {
            throw new RuntimeException('Missing NVIDIA API key');
        }

        $response = Http::withToken($apiKey)
            ->timeout(60)
            ->post((string) config('services.nvidia.chat_url'), [
                'model' => (string) config('services.nvidia.model'),
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => __('assistant.backend.system_prompt'),
                    ],
                    [
                        'role' => 'user',
                        'content' => $this->userPrompt($message, $products),
                    ],
                ],
                'temperature' => 0.2,
                'max_tokens' => 400,
            ]);

        if (! $response->successful()) {
            throw new RuntimeException('NVIDIA API error: '.$response->status());
        }

        $assistantText = $this->extractAssistantText($response->json());

        if ($assistantText === '') {
            throw new RuntimeException('Empty NVIDIA response');
        }

        return [
            'assistant_message' => trim($assistantText),
        ];
    }

    private function userPrompt(string $message, Collection $products): string
    {
        return implode("\n\n", [
            implode("\n", [
                __('assistant.backend.user_prompt_prefix.question'),
                $message,
            ]),
            $this->availableProductsBlock($products),
            __('assistant.backend.user_prompt_prefix.instructions'),
        ]);
    }

    private function availableProductsBlock(Collection $products): string
    {
        return implode("\n", array_merge([
            __('assistant.backend.user_prompt_prefix.products'),
        ], $products->map(fn (Product $product) => $this->formatProductLine($product))->all()));
    }

    private function formatProductLine(Product $product): string
    {
        $na = __('assistant.backend.prompt_line.na');
        $keywords = implode(', ', $product->getKeyword());

        return sprintf(
            '- ID:%d | %s | %s:%s | %s:%s | %s:%d | %s:%s | %s:%s | %s:%s',
            $product->getId(),
            $product->getName(),
            __('assistant.backend.prompt_line.type'),
            $product->getType(),
            __('assistant.backend.prompt_line.brand'),
            $product->getBrand() ?? $na,
            __('assistant.backend.prompt_line.price'),
            $product->getPrice(),
            __('assistant.backend.prompt_line.category'),
            $product->getCategory()?->getName() ?? $na,
            __('assistant.backend.prompt_line.keywords'),
            $keywords !== '' ? $keywords : $na,
            __('assistant.backend.prompt_line.description'),
            $product->getDescription(),
        );
    }

    private function extractAssistantText(mixed $json): string
    {
        if (! is_array($json)) {
            return '';
        }

        $candidates = [
            data_get($json, 'choices.0.message.content'),
            data_get($json, 'output_text'),
            data_get($json, 'message'),
        ];

        foreach ($candidates as $candidate) {
            if (is_string($candidate) && trim($candidate) !== '') {
                return trim($candidate);
            }
        }

        return '';
    }
}
