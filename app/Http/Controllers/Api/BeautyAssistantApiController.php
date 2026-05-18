<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BeautyAssistantChatRequest;
use App\Http\Resources\BeautyAssistantChatResource;
use App\Models\BeautyConversation;
use App\Utils\NvidiaBeautyAssistantService;
use Illuminate\Http\JsonResponse;
use Throwable;

class BeautyAssistantApiController extends Controller
{
    public function __construct(private NvidiaBeautyAssistantService $beautyAssistant) {}

    public function chat(BeautyAssistantChatRequest $request): JsonResponse
    {
        $user = $request->user();
        $conversation = $this->resolveConversation($user->getId());
        $message = (string) $request->validated()['message'];

        try {
            $conversation->getConnection()->transaction(function () use ($conversation, $message) {
                $conversation->addMessage('user', $message);

                $assistantResult = $this->beautyAssistant->respond($message);

                $conversation->addMessage(
                    'assistant',
                    (string) ($assistantResult['assistant_message'] ?? ''),
                    $assistantResult['recommended_products'] ?? [],
                    $assistantResult['meta'] ?? [],
                );

                $conversation->touch();
            });
        } catch (Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => __('assistant.js.fallback_error'),
            ], 503);
        }

        return response()->json(
            (new BeautyAssistantChatResource($conversation))->resolve()
        );
    }

    private function resolveConversation(int $userId): BeautyConversation
    {
        return BeautyConversation::firstOrCreate([
            'user_id' => $userId,
        ]);
    }
}
