<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * ORDER ATTRIBUTES
     * $this->attributes['id'] - int - contains the order primary key (id)
     * $this->attributes['total'] - int - contains the order total
     * $this->attributes['date'] - date - contains the order date
     * $this->attributes['paid'] - boolean - contains the order paid status
     * $this->attributes['shipped'] - string - contains the order shipped status
     * $this->attributes['method_of_payment'] - enum - contains the order method of payment (card, cash, bank)
     * $this->attributes['created_at'] - timestamp - contains the order creation date
     * $this->attributes['updated_at'] - timestamp - contains the order update date
     */
    protected $fillable = [
        'total',
        'date',
        'paid',
        'shipped',
        'method_of_payment',
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

    public function getShipped(): string
    {
        return $this->attributes['shipped'];
    }

    public function setShipped(string $shipped): void
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

    public function getCreatedAt()
    {
        return $this->attributes['created_at'];
    }

    public function getUpdatedAt()
    {
        return $this->attributes['updated_at'];
    }
    
}
