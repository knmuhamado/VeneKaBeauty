<?php

// David Alejandro Gutiérrez Leal

namespace App\Models;

use App\Utils\AssistantTextNormalizer;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    /**
     * CATEGORY ATTRIBUTES
     * $this->attributes['id'] - int - contains the category primary key (id)
     * $this->attributes['name'] - string - contains the category name
     * $this->attributes['created_at'] - timestamp - contains the category creation date
     * $this->attributes['updated_at'] - timestamp - contains the category update date
     * $this->products - Collection - contains the category products
     */

    // Model properties
    protected $fillable = [
        'name',
    ];

    // Getters / Setters
    public function getId(): ?int
    {
        return $this->attributes['id'];
    }

    public function getName(): string
    {
        return $this->attributes['name'];
    }

    public function setName(string $name): void
    {
        $this->attributes['name'] = $name;
    }

    public function getCreatedAt()
    {
        return $this->attributes['created_at'];
    }

    public function getUpdatedAt()
    {
        return $this->attributes['updated_at'];
    }

    // Relationships
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    // relationship getters
    public function getProducts(): Collection
    {
        return $this->products;
    }

    // Business logic
    public static function getWithSelection(array $selectedIds = []): Collection
    {
        return self::query()->orderBy('name')->get()->map(function (Category $category) use ($selectedIds) {
            $category->isSelected = in_array($category->getId(), $selectedIds, true);

            return $category;
        });
    }

    public static function commaSeparatedOrderedNamesForIds(array $ids): string
    {
        if ($ids === []) {
            return '';
        }

        return self::query()
            ->whereIn('id', $ids)
            ->orderBy('name')
            ->pluck('name')
            ->implode(', ');
    }

    public static function detectAssistantCategoryIds(string $message): array
    {
        $categories = self::query()->orderBy('name')->get();

        if ($categories->isEmpty()) {
            return [];
        }

        $normalizedMessage = AssistantTextNormalizer::normalize($message);
        $terms = AssistantTextNormalizer::extractTerms($message);
        $hit = [];

        foreach ($categories as $category) {
            $cid = $category->getId();
            $catNorm = AssistantTextNormalizer::normalize($category->getName());

            if (mb_strlen($catNorm) < 3) {
                continue;
            }

            if (str_contains($normalizedMessage, $catNorm)) {
                $hit[$cid] = true;

                continue;
            }

            self::assistantHitCategoryWordInMessage($catNorm, $normalizedMessage, $cid, $hit);
            self::assistantHitTermsAgainstCategory($catNorm, $terms, $cid, $hit);
        }

        self::assistantThemeAnchors($categories, $normalizedMessage, $hit);

        ksort($hit);

        return array_map(static fn (int|string $k): int => (int) $k, array_keys(array_filter($hit)));
    }

    private static function assistantHitCategoryWordInMessage(string $catNorm, string $normalizedMessage, int $cid, array &$hit): void
    {
        $pieces = preg_split('/[^\p{L}\p{N}]+/u', $catNorm) ?: [];

        foreach ($pieces as $piece) {
            if (mb_strlen($piece) < 3) {
                continue;
            }

            if (str_contains($normalizedMessage, $piece)) {
                $hit[$cid] = true;

                return;
            }
        }
    }

    private static function assistantHitTermsAgainstCategory(string $catNorm, array $terms, int $cid, array &$hit): void
    {
        foreach ($terms as $term) {
            $t = AssistantTextNormalizer::normalize($term);
            if ($t === '' || mb_strlen($t) < 3) {
                continue;
            }

            if (str_contains($catNorm, $t)) {
                $hit[$cid] = true;

                return;
            }
        }
    }

    private static function assistantThemeAnchors(Collection $categories, string $normalizedMessage, array &$hit): void
    {
        $anchors = [
            [
                'messages' => ['cabel', 'champ', 'shamp', 'pelo', 'pelu', 'tinte', 'acondicio', 'capilar'],
                'categories' => ['cabel', 'capil', 'cabell'],
            ],
            [
                'messages' => ['rostr', 'facial', 'acne', 'piel', ' exfol', 'crema', 'antiedad'],
                'categories' => ['rostr', 'facial', 'piel ', 'acr ', ' cara'],
            ],
            [
                'messages' => ['uñ', 'unas', 'cutic', 'mani'],
                'categories' => ['uñ'],
            ],
            [
                'messages' => ['fraganci', 'perfum', 'aromat', 'colonia'],
                'categories' => ['frag', 'perf'],
            ],
            [
                'messages' => ['cuerpo', 'masaje', 'body', 'corp'],
                'categories' => ['cuerp', 'corp', 'masaje'],
            ],
            [
                'messages' => ['labial', 'labios', 'boca'],
                'categories' => ['lab'],
            ],
        ];

        foreach ($anchors as $group) {
            $msgHits = false;
            foreach ($group['messages'] as $fragment) {
                if (str_contains($normalizedMessage, $fragment)) {
                    $msgHits = true;

                    break;
                }
            }

            if (! $msgHits) {
                continue;
            }

            foreach ($categories as $category) {
                $cid = $category->getId();
                $cn = AssistantTextNormalizer::normalize($category->getName());

                foreach ($group['categories'] as $needle) {
                    if (mb_strlen($needle) >= 2 && str_contains($cn, $needle)) {
                        $hit[$cid] = true;

                        break;
                    }
                }
            }
        }
    }
}
