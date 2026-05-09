<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class BeautyConversation extends Model
{
    use HasFactory;

    /**
     * BEAUTY CONVERSATION ATTRIBUTES
     * $this->attributes['id']; - int - primary key
     * $this->attributes['user_id']; - int - owner user id
     * $this->attributes['last_message_at']; - datetime - timestamp of last message
     * $this->attributes['created_at']; - timestamp - creation date
     * $this->attributes['updated_at']; - timestamp - update date
     */

    // Model properties
    protected $fillable = [
        'user_id',
        'last_message_at',
    ];

    protected $casts = [
        'last_message_at' => 'datetime',
    ];

    // Getters / Setters
    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getUserId(): ?int
    {
        return $this->attributes['user_id'] ?? null;
    }

    public function getLastMessageAt()
    {
        return $this->last_message_at ?? null;
    }

    public function setLastMessageAt($dateTime): void
    {
        $this->attributes['last_message_at'] = $dateTime;
    }

    public function getCreatedAt()
    {
        return $this->attributes['created_at'] ?? null;
    }

    public function getUpdatedAt()
    {
        return $this->attributes['updated_at'] ?? null;
    }

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(BeautyMessage::class);
    }

    // Business logic
    public function getMessagesPayload(): Collection
    {
        return $this->messages()
            ->orderBy('id')
            ->get()
            ->map(fn (BeautyMessage $message) => $message->toApiPayload())
            ->values();
    }

    public function addMessage(string $role, string $content, array $products = [], array $meta = []): BeautyMessage
    {
        $message = new BeautyMessage;
        $message->setBeautyConversationId($this->getId());
        $message->setRole($role);
        $message->setContent($content);
        $message->setProducts($products);
        $message->setMeta($meta);
        $message->save();

        return $message;
    }
}
