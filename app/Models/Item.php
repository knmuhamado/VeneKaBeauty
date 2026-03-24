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

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function setId(int $id): void
    {
        $this->attributes['id'] = $id;
    }

    public function getQuantity(): int
    {
        return $this->attributes['quantity'];
    }

    public function setQuantity(int $quantity): void
    {
        $this->attributes['quantity'] = $quantity;
    }

    public function getPrice(): int
    {
        return $this->attributes['price'];
    }

    public function setPrice(int $price): void
    {
        $this->attributes['price'] = $price;
    }

    public function getOrderId(): ?int
    {
        return $this->attributes['order_id'];
    }

    public function setOrderId(?int $orderId): void
    {
        $this->attributes['order_id'] = $orderId;
    }

    public function getProductId(): ?int
    {
        return $this->attributes['product_id'];
    }

    public function setProductId(?int $productId): void
    {
        $this->attributes['product_id'] = $productId;
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