<?php

namespace App\Utils;

use App\Http\Resources\AssistantProductResource;
use App\Models\Product;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Collection;
use Illuminate\Support\Collection as SupportCollection;
use Illuminate\Support\Facades\Http;
use Throwable;

class NvidiaBeautyAssistantService
{
    private const MAX_RECOMMENDED_PRODUCTS = 5;

    public function respond(string $message): array
    {
        // Provide the assistant with all available products (no category filtering).
        $products = Product::getAssistantAvailableProducts();

        $apiKey = (string) config('services.nvidia.api_key');

        if ($apiKey === '') {
            throw new \RuntimeException('Missing NVIDIA API key');
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
                    'max_tokens' => 400,
                ]);
        } catch (RequestException $e) {
            throw $e;
        } catch (Throwable $e) {
            throw $e;
        }

        if (! $response->successful()) {
            throw new \RuntimeException('NVIDIA API error: '.$response->status());
        }

        $assistantText = $this->extractAssistantText($response->json());

        if ($assistantText === '') {
            throw new \RuntimeException('Empty NVIDIA response');
        }

        $recommendedNames = $this->extractRecommendedNames($assistantText);
        $recommendedProducts = $this->resolveRecommendedProducts($recommendedNames, $products);

        return [
            'assistant_message' => $this->cleanAssistantText($assistantText),
            'recommended_products' => $this->buildProductPayload($recommendedProducts),
            'meta' => [
                'source' => 'nvidia',
                'model' => (string) config('services.nvidia.model'),
                'assistant_category_ids' => [],
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

    private function extractRecommendedNames(string $assistantText): array
    {
        if (preg_match('/\n(?:PRODUCTS|PRODUCTOS):\s*(.+)$/im', $assistantText, $matches)) {
            $rawList = trim((string) $matches[1]);

            if ($rawList === '') {
                return [];
            }

            return array_values(array_filter(array_map(static function (string $item): string {
                $item = trim($item);
                $item = preg_replace('/^[-*\d\.\)\s]+/u', '', $item) ?? $item;
                $item = preg_replace('/\s*\(.*$/u', '', $item) ?? $item;

                return trim($item);
            }, preg_split('/\s*,\s*/', $rawList) ?: [])));
        }

        return [];
    }

    private function resolveRecommendedProducts(array $recommendedNames, SupportCollection $products): SupportCollection
    {
        if ($recommendedNames === []) {
            return $products->take(2);
        }

        $selected = collect();

        foreach ($recommendedNames as $recommendedName) {
            $normalizedName = trim((string) $recommendedName);

            if ($normalizedName === '') {
                continue;
            }

            $match = Product::query()
                ->with('category')
                ->where('available', true)
                ->filterByName($normalizedName)
                ->orderByDesc('id')
                ->first();

            if (! $match) {
                $match = $products->first(function (Product $product) use ($normalizedName) {
                    return str_contains(mb_strtolower($product->getName()), mb_strtolower($normalizedName));
                });
            }

            if ($match && ! $selected->contains(fn (Product $product) => $product->getId() === $match->getId())) {
                $selected->push($match);
            }
        }

        if ($selected->isEmpty()) {
            return $products->take(2);
        }

        return $selected->values();
    }

    private function cleanAssistantText(string $text): string
    {
        return trim(preg_replace('/\n(?:PRODUCTS|PRODUCTOS):.*$/i', '', $text));
    }

    private function buildProductPayload(Collection $products): array
    {
        return AssistantProductResource::collection($products)->resolve();
    }
}
