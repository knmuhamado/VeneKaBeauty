<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BeautyMessage extends Model
{
    use HasFactory;

    /**
     * BEAUTY MESSAGE ATTRIBUTES
     * $this->attributes['id']; - int - primary key
     * $this->attributes['beauty_conversation_id']; - int - foreign key to conversation
     * $this->attributes['role']; - string - 'user' or 'assistant'
     * $this->attributes['content']; - string - message text
     * $this->attributes['products']; - array - recommended products payload
     * $this->attributes['meta']; - array - metadata for the message
     * $this->attributes['created_at']; - timestamp - creation date
     * $this->attributes['updated_at']; - timestamp - update date
     */

    // Model properties
    protected $fillable = [
        'beauty_conversation_id',
        'role',
        'content',
        'products',
        'meta',
    ];

    protected $casts = [
        'beauty_conversation_id' => 'integer',
        'products' => 'array',
        'meta' => 'array',
    ];

    // Getters / Setters
    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getBeautyConversationId(): ?int
    {
        return $this->attributes['beauty_conversation_id'] ?? null;
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

    public function getProducts(): array
    {
        return $this->attributes['products'] ?? [];
    }

    public function setProducts(array $products): void
    {
        $this->attributes['products'] = $products;
    }

    public function getMeta(): array
    {
        return $this->attributes['meta'] ?? [];
    }

    public function setMeta(array $meta): void
    {
        $this->attributes['meta'] = $meta;
    }

    public function getCreatedAt()
    {
        return $this->created_at ?? null;
    }

    public function getUpdatedAt()
    {
        return $this->updated_at ?? null;
    }

    // Relationships
    public function conversation(): BelongsTo
    {
        return $this->belongsTo(BeautyConversation::class, 'beauty_conversation_id');
    }

    // Business logic
    public function toApiPayload(): array
    {
        return [
            'id' => $this->getId(),
            'role' => $this->getRole(),
            'content' => $this->getContent(),
            'products' => $this->getProducts(),
            'meta' => $this->getMeta(),
            'created_at' => optional($this->getCreatedAt())?->toIso8601String(),
        ];
    }
}
