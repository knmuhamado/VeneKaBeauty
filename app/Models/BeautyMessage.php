<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeautyMessage extends Model
{
    use HasFactory;

    /**
     * BEAUTY MESSAGE ATTRIBUTES
     * $this->attributes['id']; - int - primary key
     * $this->attributes['beauty_conversation_id']; - int - foreign key to conversation
     * $this->attributes['role']; - string - 'user' or 'assistant'
     * $this->attributes['content']; - string - message text
     * $this->attributes['created_at']; - timestamp - creation date
     * $this->attributes['updated_at']; - timestamp - update date
     */

    // Model properties
    protected $fillable = [
        'beauty_conversation_id',
        'role',
        'content',
    ];

    protected $casts = [
        'beauty_conversation_id' => 'integer',
    ];

    // Getters / Setters
    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function setBeautyConversationId(int $id): void
    {
        $this->attributes['beauty_conversation_id'] = $id;
    }

    public function getRole(): string
    {
        return $this->attributes['role'];
    }

    public function setRole(string $role): void
    {
        $this->attributes['role'] = $role;
    }

    public function getContent(): string
    {
        return (string) ($this->attributes['content'] ?? '');
    }

    public function setContent(string $content): void
    {
        $this->attributes['content'] = $content;
    }

    public function getNormalizedContent(): string
    {
        $rawContent = (string) ($this->attributes['content'] ?? '');
        $rawContent = trim($rawContent);

        $normalized = preg_replace("/(\r?\n){2,}/", "\n\n", $rawContent);

        return (string) $normalized;
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
