<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BeautyConversation extends Model
{
    use HasFactory;

    /**
     * BEAUTY CONVERSATION ATTRIBUTES
     * $this->attributes['id']; - int - primary key
     * $this->attributes['user_id']; - int - owner user id
     * $this->attributes['created_at']; - timestamp - creation date
     * $this->attributes['updated_at']; - timestamp - update date
     */

    // Model properties
    protected $fillable = [
        'user_id',
    ];

    // Getters / Setters
    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getCreatedAt()
    {
        return $this->attributes['created_at'];
    }

    public function getUpdatedAt()
    {
        return $this->attributes['updated_at'];
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
    public static function resolveForUser(int $userId): self
    {
        return self::firstOrCreate(['user_id' => $userId]);
    }

    public function orderedMessages(): Collection
    {
        return $this->messages()->orderBy('id')->get();
    }

    public function addMessage(string $role, string $content): BeautyMessage
    {
        $message = new BeautyMessage;
        $message->setBeautyConversationId($this->getId());
        $message->setRole($role);
        $message->setContent($content);
        $message->save();

        return $message;
    }

    public function addExchange(string $userMessage, string $assistantMessage): void
    {
        $this->getConnection()->transaction(function () use ($userMessage, $assistantMessage) {
            $this->addMessage('user', $userMessage);
            $this->addMessage('assistant', $assistantMessage);
            $this->touch();
        });
    }
}
