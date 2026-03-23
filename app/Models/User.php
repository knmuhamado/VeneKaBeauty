<?php

// Mariamny Del Valle Ramírez Telles

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    // @use HasFactory<\Database\Factories\UserFactory>
    use HasFactory, Notifiable;

    /**
     * User ATRIBUTTES
     * $this->attributes['id'] - int - contains the user primary key (id)
     * $this->attributes['name'] - string - contains the user name
     * $this->attributes['email'] - string - contains the user email
     * * $this->attributes['password'] - string - contains the user password
     * $this->attributes['address'] - string - contains the user address
     * $this->attributes['phoneNumber'] - string - contains the user phone number
     * * $this->attributes['role'] - string - contains the user role (client, admin)
     * $this->attributes['created_at'] - timestamp - contains the user creation date
     * $this->attributes['updated_at'] - timestamp - contains the user update date
     */

    // The attributes that are mass assignable.
    // @var list<string>

    protected $fillable = [
        'name',
        'email',
        'address',
        'password',
        'phoneNumber',
        'role',

    ];

    // The attributes that should be hidden for serialization.
    // @var list<string>

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Get the attributes that should be cast.

    // @return array<string, string>

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function setId(int $id): void
    {
        $this->attributes['id'] = $id;
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

    
    public function getCreatedAt(): string
    {
        return $this->attributes['created_at'];
    }

    public function getUpdatedAt(): string
    {
        return $this->attributes['updated_at'];
    }

        /*
        public function setCreatedAt(string $createdAt): void
        {
            $this->attributes['created_at'] = $createdAt;
        }

        public function setUpdatedAt(string $updatedAt): void
        {
            $this->attributes['updated_at'] = $updatedAt;
        }
        */
    
    public function isAdmin(): bool
    {
        return $this->attributes['role'] === 'admin';
    }

    public function isClient(): bool
    {
        return $this->attributes['role'] === 'client';
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }
}
