<?php

// David Alejandro Gutiérrez Leal

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Item;


class Product extends Model
{
    /**
     * PRODUCT ATTRIBUTES
     * $this->attributes['id'];- int - contains the product primary key (id)
     * $this->attributes['name'];- string - contains the product name
     * $this->attributes['image'];- string - contains the product image path or filename
     * $this->attributes['description'];- string - contains the product description
     * $this->attributes['available'];- bool - indicates if the product is available
     * $this->attributes['price'];- int - contains the product price
     * $this->attributes['brand'];- string|null - contains the product brand name
     * $this->attributes['keyword'];- array - contains the product keywords
     * $this->attributes['type'];- string - contains the product type (article/service)
     * $this->attributes['category_id'];- int|null - contains the category id
     * $this->attributes['created_at'];- timestamp - contains the product creation date
     * $this->attributes['updated_at'];- timestamp - contains the product update date
     */
    protected $fillable = [
        'name',
        'image',
        'description',
        'available',
        'price',
        'brand',
        'keyword',
        'type',
        'category_id',
    ];

    protected $casts = [
        'available' => 'boolean',
        'keyword' => 'array',
        'category_id' => 'integer',
    ];

    public function getId(): ?int
    {
        return $this->attributes['id'];
    }

    public function getName(): ?string
    {
        return $this->attributes['name'];
    }

    public function setName(string $name): self
    {
        $this->attributes['name'] = $name;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->attributes['image'];
    }

    public function setImage(string $image): self
    {
        $this->attributes['image'] = $image;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->attributes['description'];
    }

    public function setDescription(string $description): self
    {
        $this->attributes['description'] = $description;

        return $this;
    }

    public function getAvailable(): ?bool
    {
        return $this->attributes['available'];
    }

    public function setAvailable(bool $available): self
    {
        $this->attributes['available'] = $available;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->attributes['price'];
    }

    public function setPrice(int $price): self
    {
        $this->attributes['price'] = $price;

        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->attributes['brand'];
    }

    public function setBrand(?string $brand): self
    {
        $this->attributes['brand'] = $brand;

        return $this;
    }

    public function getKeyword(): array
    {
        return $this->keyword ?? [];
    }

    public function setKeyword(array $keyword): self
    {
        $this->keyword = $keyword;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->attributes['type'];
    }

    public function setType(string $type): self
    {
        $this->attributes['type'] = $type;

        return $this;
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    // / Method for calculating the average rating of product reviews
    public function getAverageScore(): int
    {
        if ($this->reviews->count() == 0) {
            return 0;
        }

        return (int) round($this->reviews->avg('score'));
    }

    // Method for retrieving the top-rated products based on average review scores
    public static function getTopRatedProducts()
    {
        $products = self::with('reviews', 'category')
            ->has('reviews') // only products with reviews
            ->get();

        // Calculate average
        $products = $products->map(function ($product) {
            $product->average_score = $product->getAverageScore();

            return $product;
        });

        // Filter and sort
        return $products->filter(fn ($p) => $p->average_score >= 4)->sortByDesc('average_score')->take(5);
    }

    // This function counts how many reviews a comment has
    public function getRating(): string
    {
        $count = $this->reviews->count();

        if ($count === 0) {
            return __('product.rating_no');
        }

        $text = $count === 1 ? __('product.rating_comment_singular') : __('product.rating_comment_plural');

        return $this->getAverageScore()." - ($count $text)";
    }

    public function getCategoryId(): ?int
    {
        return $this->attributes['category_id'];
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function scopeFilterByName(Builder $query, string $nombre): Builder
    {
        return $query->where('name', 'like', '%'.$nombre.'%');
    }

    public function scopeFilterByCategories(Builder $query, array $categoryIds): Builder
    {
        return $query->whereIn('category_id', $categoryIds);
    }

    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }

    public function getItems(): Collection
    {
        return $this->items;
    }
    
    public function getCreatedAt()
    {
    return $this->attributes['created_at'];
    }

    public function getUpdatedAt()
    {
    return $this->attributes['updated_at'];
    }
    
}
