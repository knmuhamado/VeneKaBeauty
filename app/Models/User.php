<?php

// Mariamny Del Valle Ramírez Telles

namespace App\Models;

use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * User ATTRIBUTES
     * $this->attributes['id'] - int - contains the user primary key (id)
     * $this->attributes['name'] - string - contains the user name
     * $this->attributes['email'] - string - contains the user email
     * $this->attributes['password'] - string - contains the user password
     * $this->attributes['address'] - string - contains the user address
     * $this->attributes['phoneNumber'] - string - contains the user phone number
     * $this->attributes['role'] - string - contains the user role (client, admin)
     * $this->attributes['created_at'] - timestamp - contains the user creation date
     * $this->attributes['updated_at'] - timestamp - contains the user update date
     * $this->orders - Collection - contains the user orders
     */

    protected $fillable = [
        'name',
        'email',
        'address',
        'password',
        'phoneNumber',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    public function getId(): int
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

    public function getEmail(): string
    {
        return $this->attributes['email'];
    }

    public function setEmail(string $email): void
    {
        $this->attributes['email'] = $email;
    }

    public function getAddress(): string
    {
        return $this->attributes['address'];
    }

    public function setAddress(string $address): void
    {
        $this->attributes['address'] = $address;
    }

    public function getPhoneNumber(): string
    {
        return $this->attributes['phoneNumber'];
    }

    public function setPhoneNumber(string $phoneNumber): void
    {
        $this->attributes['phoneNumber'] = $phoneNumber;
    }

    public function getRole(): string
    {
        return $this->attributes['role'];
    }

    public function setRole(string $role): void
    {
        $this->attributes['role'] = $role;
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function isAdmin(): bool
    {
        return $this->attributes['role'] === 'admin';
    }

    public function isClient(): bool
    {
        return $this->attributes['role'] === 'client';
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
