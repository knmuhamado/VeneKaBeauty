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
}
