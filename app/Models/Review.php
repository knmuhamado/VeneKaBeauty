<?php
//Mariamny Del Valle Ramírez Telles

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    /**
     * Review ATTRIBUTES
     * $this->attributes['id'] - int – contains the review primary key (id)
     * $this->attributes['score'] - int – contains the review score
     * $this->attributes['comment'] - string – contains the review comment
     * $this->attributes['created_at'] - timestamp - contains the review creation date
     * $this->attributes['updated_at'] - timestamp - contains the review update date
     */
    protected $fillable = ['score', 'comment', 'product_id', 'user_id'];

    protected $casts = [
        'product_id' => 'integer',
        'user_id' => 'integer',
    ];

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function setId(int $id): void
    {
        $this->attributes['id'] = $id;
    }

    public function getScore(): int
    {
        return $this->attributes['score'];
    }

    public function setScore(int $score): void
    {
        $this->attributes['score'] = $score;
    }

    public function getComment(): string
    {
        return $this->attributes['comment'];
    }

    public function setComment(string $comment): void
    {
        $this->attributes['comment'] = $comment;
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function getProductId(): ?int
    {
        return $this->getAttribute('product_id');
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getUserId(): ?int
    {
        return $this->getAttribute('user_id');
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    
    public function getCreatedAt()
    {
    return $this->attributes['created_at'];
    }

    public function getUpdatedAt()
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
    
    
}
