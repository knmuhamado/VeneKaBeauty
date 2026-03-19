<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
    protected $fillable = ['score', 'comment'];

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
