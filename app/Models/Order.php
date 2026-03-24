<?php

// Kadiha Muhamad

namespace App\Models;

use App\Models\Item;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    /**
     * ORDER ATTRIBUTES
     * $this->attributes['id'] - int - contains the order primary key (id)
     * $this->attributes['total'] - int - contains the order total
     * $this->attributes['date'] - date - contains the order date
     * $this->attributes['paid'] - boolean - contains the order paid status
     * $this->attributes['shipped'] - boolean - contains the order shipped status
     * $this->attributes['method_of_payment'] - string - contains the order method of payment (card, cash, bank)
     * $this->attributes['user_id'] - int|null - contains the user id
     * $this->attributes['created_at'] - timestamp - contains the order creation date
     * $this->attributes['updated_at'] - timestamp - contains the order update date
     */

    protected $fillable = [
        'total',
        'date',
        'paid',
        'shipped',
        'method_of_payment',
        'user_id',
    ];

    protected $casts = [
        'paid'    => 'boolean',
        'shipped' => 'boolean',
    ];

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getTotal(): int
    {
        return $this->attributes['total'];
    }

    public function setTotal(int $total): void
    {
        $this->attributes['total'] = $total;
    }

    public function getDate(): string
    {
        return $this->attributes['date'];
    }

    public function setDate(string $date): void
    {
        $this->attributes['date'] = $date;
    }

    public function getPaid(): bool
    {
        return $this->attributes['paid'];
    }

    public function setPaid(bool $paid): void
    {
        $this->attributes['paid'] = $paid;
    }

    public function getShipped(): bool
    {
        return $this->attributes['shipped'];
    }

    public function setShipped(bool $shipped): void
    {
        $this->attributes['shipped'] = $shipped;
    }

    public function getMethodOfPayment(): string
    {
        return $this->attributes['method_of_payment'];
    }

    public function setMethodOfPayment(string $methodOfPayment): void
    {
        $this->attributes['method_of_payment'] = $methodOfPayment;
    }

    public function getUserId(): ?int
    {
        return $this->attributes['user_id'] ?? null;
    }

    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }

    public function getItems(): Collection
    {
        return $this->items;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getUser(): ?User
    {
        return $this->user;
    }
}
