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
     * $this->attributes['id'] - int - contains the product primary key (id)
     * $this->attributes['name'] - string - contains the product name
     * $this->attributes['image'] - string - contains the product image path or filename
     * $this->attributes['description'] - string - contains the product description
     * $this->attributes['available'] - bool - indicates if the product is available
     * $this->attributes['price'] - int - contains the product price
     * $this->attributes['brand'] - string|null - contains the product brand name
     * $this->attributes['keyword'] - array - contains the product keywords
     * $this->attributes['type'] - string - contains the product type (article/service)
     * $this->attributes['category_id'] - int|null - contains the category id
     * $this->attributes['created_at'] - timestamp - contains the product creation date
     * $this->attributes['updated_at'] - timestamp - contains the product update date
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
        return $this->getAttribute('id');
    }

    public function getName(): ?string
    {
        return $this->getAttribute('name');
    }

    public function setName(string $name): self
    {
        $this->setAttribute('name', $name);

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->getAttribute('image');
    }

    public function setImage(string $image): self
    {
        $this->setAttribute('image', $image);

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->getAttribute('description');
    }

    public function setDescription(string $description): self
    {
        $this->setAttribute('description', $description);

        return $this;
    }

    public function getAvailable(): ?bool
    {
        return $this->getAttribute('available');
    }

    public function setAvailable(bool $available): self
    {
        $this->setAttribute('available', $available);

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->getAttribute('price');
    }

    public function setPrice(int $price): self
    {
        $this->setAttribute('price', $price);

        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->getAttribute('brand');
    }

    public function setBrand(?string $brand): self
    {
        $this->setAttribute('brand', $brand);

        return $this;
    }

    public function getKeyword(): array
    {
        return $this->getAttribute('keyword') ?? [];
    }

    public function setKeyword(array $keyword): self
    {
        $this->setAttribute('keyword', $keyword);

        return $this;
    }

    public function getType(): ?string
    {
        return $this->getAttribute('type');
    }

    public function setType(string $type): self
    {
        $this->setAttribute('type', $type);

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

    public function getCategoryId(): ?int
    {
        return $this->getAttribute('category_id');
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
    /*
    public function getCreatedAt(): string
    {
    return $this->attributes['created_at'];
    }

    public function setCreatedAt(string $createdAt): void
    {
    $this->attributes['created_at'] = $createdAt;
    }

    public function getUpdatedAt(): string
    {
    return $this->attributes['updated_at'];
    }

    public function setUpdatedAt(string $updatedAt): void
    {
    $this->attributes['updated_at'] = $updatedAt;
    }
    */
}
