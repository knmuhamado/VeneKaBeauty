<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BeautyAssistantChatRequest;
use App\Models\BeautyConversation;
use App\Utils\NvidiaBeautyAssistantService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BeautyAssistantApiController extends Controller
{
    public function __construct(private NvidiaBeautyAssistantService $beautyAssistant) {}

    public function history(Request $request): JsonResponse
    {
        $conversation = $this->resolveConversation($request->user()->getId());

        return response()->json([
            'success' => true,
            'messages' => $conversation->getMessagesPayload(),
        ]);
    }

    public function chat(BeautyAssistantChatRequest $request): JsonResponse
    {
        $user = $request->user();
        $conversation = $this->resolveConversation($user->getId());
        $message = (string) $request->validated()['message'];

        $result = $conversation->getConnection()->transaction(function () use ($conversation, $message) {
            $conversation->addMessage('user', $message);

            $assistantResult = $this->beautyAssistant->respond($message);

            $conversation->addMessage(
                'assistant',
                (string) ($assistantResult['assistant_message'] ?? ''),
                $assistantResult['recommended_products'] ?? [],
                $assistantResult['meta'] ?? [],
            );

            $this->touchConversation($conversation);

            return $assistantResult;
        });

        return response()->json($this->buildChatPayload($conversation, $result));
    }

    private function resolveConversation(int $userId): BeautyConversation
    {
        return BeautyConversation::firstOrCreate([
            'user_id' => $userId,
        ]);
    }

    private function buildChatPayload(BeautyConversation $conversation, array $latest): array
    {
        return [
            'success' => true,
            'messages' => $conversation->getMessagesPayload(),
            'latest' => $latest,
        ];
    }

    private function touchConversation(BeautyConversation $conversation): void
    {
        $conversation->setLastMessageAt(now());
        $conversation->save();
    }
}
