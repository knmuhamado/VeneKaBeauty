<?php

// David Alejandro Gutiérrez Leal

namespace App\Models;

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
     */
    protected $fillable = [
        'name',
    ];

<<<<<<< HEAD
    public function getId(): ?int
    {
        return $this->attributes['id'];
=======
    public function getId(): int
    {
        return $this->getAttribute('id');
>>>>>>> master
    }

    public function getName(): ?string
    {
<<<<<<< HEAD
        return $this->attributes['name'];
    }

    public function setName(string $name): void
    {
        $this->attributes['name'] = $name;
=======
        return $this->getAttribute('name');
    }

    public function setName(string $name): self
    {
        $this->setAttribute('name', $name);

        return $this;
>>>>>>> master
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function getProducts(): Collection
    {
        return $this->products;
    }

<<<<<<< HEAD
    public function getCreatedAt()
=======
    /*
    public function getCreatedAt(): string
>>>>>>> master
    {
        return $this->attributes['created_at'];
    }

<<<<<<< HEAD
    public function getUpdatedAt()
    {
        return $this->attributes['updated_at'];
    }
=======
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
>>>>>>> master
}
