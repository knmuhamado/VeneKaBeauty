<?php

namespace App\Utils;

use App\Models\Category;
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
        $categoryIds = Category::detectAssistantCategoryIds($message);
        $products = Product::getAssistantRelevantProducts(
            $message,
            self::MAX_RECOMMENDED_PRODUCTS,
            $categoryIds,
        );

        $apiKey = (string) config('services.nvidia.api_key');

        if ($apiKey === '') {
            return $this->fallbackResponse($message, $products, 'missing_api_key', $categoryIds);
        }

        try {
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
                    'max_tokens' => 350,
                ]);
        } catch (RequestException $e) {
            return $this->fallbackResponse($message, $products, 'nvidia_request_exception', $categoryIds);
        } catch (Throwable $e) {
            return $this->fallbackResponse($message, $products, 'nvidia_unexpected_exception', $categoryIds);
        }

        if (! $response->successful()) {
            return $this->fallbackResponse($message, $products, 'nvidia_error_'.$response->status(), $categoryIds);
        }

        $assistantText = $this->extractAssistantText($response->json());

        if ($assistantText === '') {
            return $this->fallbackResponse($message, $products, 'empty_nvidia_response', $categoryIds);
        }

        return [
            'user_message' => $message,
            'assistant_message' => $assistantText,
            'recommended_products' => $this->buildProductPayload($products),
            'meta' => [
                'source' => 'nvidia',
                'model' => (string) config('services.nvidia.model'),
                'assistant_category_ids' => $categoryIds,
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

    private function fallbackResponse(
        string $message,
        Collection $products,
        string $reason,
        array $assistantCategoryIds = [],
    ): array {
        $assistantMessage = $this->buildFallbackMessage($products, $assistantCategoryIds);

        return [
            'user_message' => $message,
            'assistant_message' => $assistantMessage,
            'recommended_products' => $this->buildProductPayload($products),
            'meta' => [
                'source' => 'fallback',
                'reason' => $reason,
                'assistant_category_ids' => $assistantCategoryIds,
            ],
        ];
    }

    private function buildFallbackMessage(Collection $products, array $assistantCategoryIds): string
    {
        $categoriesLabel = Category::commaSeparatedOrderedNamesForIds($assistantCategoryIds);
        $names = $products->pluck('name')->take(2)->implode(__('assistant.backend.fallback.names_join_separator'));

        $intro = $categoriesLabel !== ''
            ? __('assistant.backend.fallback.context_for_categories', ['categories' => $categoriesLabel])
            : __('assistant.backend.fallback.context_general');

        if ($names !== '') {
            return trim($intro.' '.__('assistant.backend.fallback.with_products', ['names' => $names]));
        }

        return trim($intro.' '.__('assistant.backend.fallback.without_products'));
    }

    private function buildProductPayload(Collection $products): array
    {
        return $products->map(fn (Product $product) => $product->toAssistantPayload())->all();
    }
}
