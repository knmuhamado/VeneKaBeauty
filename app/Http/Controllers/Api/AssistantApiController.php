<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AssistantChatRequest;
use App\Http\Resources\AssistantChatResource;
use App\Models\BeautyConversation;
use App\Utils\NvidiaBeautyAssistantService;
use Illuminate\Http\JsonResponse;
use Throwable;

class AssistantApiController extends Controller
{
    public function __construct(private NvidiaBeautyAssistantService $beautyAssistant) {}

    public function chat(AssistantChatRequest $request): JsonResponse
    {
        $user = $request->user();
        $conversation = BeautyConversation::resolveForUser($user->getId());
        $message = (string) $request->validated()['message'];

        try {
            $assistantResult = $this->beautyAssistant->respond($message);

            $conversation->addExchange(
                $message,
                (string) ($assistantResult['assistant_message'] ?? ''),
            );
        } catch (Throwable) {
            return response()->json([
                'success' => false,
                'message' => __('assistant.js.fallback_error'),
            ], 503);
        }

        return response()->json(
            (new AssistantChatResource($conversation))->resolve()
        );
    }
}
