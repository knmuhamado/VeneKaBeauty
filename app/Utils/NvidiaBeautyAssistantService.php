<?php

namespace App\Utils;

use App\Models\Product;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Throwable;

class NvidiaBeautyAssistantService
{
    private const MAX_RECOMMENDED_PRODUCTS = 5;

    public function respond(string $message): array
    {
        $terms = $this->extractAssistantTerms($message);
        $products = Product::getAssistantRelevantProducts($terms, self::MAX_RECOMMENDED_PRODUCTS);

        $apiKey = (string) config('services.nvidia.api_key');

        if ($apiKey === '') {
            return $this->fallbackResponse($message, $products, 'missing_api_key');
        }

        try {
            $response = Http::withToken($apiKey)
                ->timeout(20)
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
                    'max_tokens' => 350,
                ]);
        } catch (RequestException $e) {
            return $this->fallbackResponse($message, $products, 'nvidia_request_exception');
        } catch (Throwable $e) {
            return $this->fallbackResponse($message, $products, 'nvidia_unexpected_exception');
        }

        if (! $response->successful()) {
            return $this->fallbackResponse($message, $products, 'nvidia_error_'.$response->status());
        }

        $assistantText = $this->extractAssistantText($response->json());

        if ($assistantText === '') {
            return $this->fallbackResponse($message, $products, 'empty_nvidia_response');
        }

        return [
            'user_message' => $message,
            'assistant_message' => $assistantText,
            'recommended_products' => $products->map(fn (Product $product) => $product->toAssistantPayload())->all(),
            'meta' => [
                'source' => 'nvidia',
                'model' => (string) config('services.nvidia.model'),
            ],
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
        $keywords = implode(', ', $product->getKeyword());

        return sprintf(
            '- ID:%d | %s | Tipo:%s | Marca:%s | Precio:%d | Categoria:%s | Keywords:%s | Descripcion:%s',
            $product->getId(),
            $product->getName(),
            $product->getType(),
            $product->getBrand() ?? 'N/A',
            $product->getPrice(),
            $product->getCategory()?->getName() ?? 'N/A',
            $keywords !== '' ? $keywords : 'N/A',
            $product->getDescription()
        );
    }

    private function extractAssistantText(mixed $json): string
    {
        if (! is_array($json)) {
            return '';
        }

        $choiceContent = data_get($json, 'choices.0.message.content');
        if (is_string($choiceContent) && trim($choiceContent) !== '') {
            return trim($choiceContent);
        }

        $outputText = data_get($json, 'output_text');
        if (is_string($outputText) && trim($outputText) !== '') {
            return trim($outputText);
        }

        $message = data_get($json, 'message');
        if (is_string($message) && trim($message) !== '') {
            return trim($message);
        }

        return '';
    }

    private function fallbackResponse(string $message, Collection $products, string $reason): array
    {
        $assistantMessage = $this->buildFallbackMessage($products);
        $productPayload = $products->map(fn (Product $product) => $product->toAssistantPayload())->all();

        return [
            'user_message' => $message,
            'assistant_message' => $assistantMessage,
            'recommended_products' => $productPayload,
            'meta' => [
                'source' => 'fallback',
                'reason' => $reason,
            ],
        ];
    }

    private function buildFallbackMessage(Collection $products): string
    {
        $names = $products->map(fn (Product $p) => $p->toAssistantPayload())->pluck('name')->take(2)->implode(' y ');

        if ($names !== '') {
            return __('assistant.backend.fallback.with_products', ['names' => $names]);
        }

        return __('assistant.backend.fallback.without_products');
    }

    

    private function extractAssistantTerms(string $message): array
    {
        $normalized = mb_strtolower($message);
        $parts = preg_split('/[^\p{L}\p{N}]+/u', $normalized) ?: [];

        $stopwords = [
            'de', 'la', 'el', 'los', 'las', 'para', 'con', 'sin', 'una', 'uno', 'unos', 'unas',
            'que', 'quiero', 'necesito', 'recomiendas', 'recomendacion', 'recomendaciones', 'me',
            'mi', 'mis', 'por', 'favor', 'y', 'o', 'en', 'del', 'al', 'un',
        ];

        $terms = [];
        foreach ($parts as $part) {
            if ($part === '' || mb_strlen($part) < 3 || in_array($part, $stopwords, true)) {
                continue;
            }

            $terms[] = $part;
        }

        return array_values(array_unique($terms));
    }
}
