<?php

// Kadiha Muhamad

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Item extends Model
{
    /**
     * ITEM ATTRIBUTES
     * $this->attributes['id'] - int - contains the item primary key (id)
     * $this->attributes['quantity'] - int - contains the quantity of the product
     * $this->attributes['price'] - int - contains the price at the moment of purchase
     * $this->attributes['order_id'] - int|null - contains the order id
     * $this->attributes['product_id'] - int|null - contains the product id
     * $this->attributes['created_at'] - timestamp - contains the item creation date
     * $this->attributes['updated_at'] - timestamp - contains the item update date
     */

    protected $fillable = [
        'quantity',
        'price',
        'order_id',
        'product_id',
    ];

    protected $casts = [
        'order_id' => 'integer',
        'product_id' => 'integer',
    ];

    public function getId(): ?int
    {
        return $this->getAttribute('id');
    }

    public function getQuantity(): ?int
    {
        return $this->getAttribute('quantity');
    }

    public function setQuantity(int $quantity): self
    {
        $this->setAttribute('quantity', $quantity);

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

    public function getOrderId(): ?int
    {
        return $this->getAttribute('order_id');
    }

    public function getProductId(): ?int
    {
        return $this->getAttribute('product_id');
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function getOrder(): ?Order
    {
        return $this->order;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }
}