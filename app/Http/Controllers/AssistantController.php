<?php

namespace App\Http\Controllers;

use App\Http\Resources\AssistantMessageResource;
use App\Models\BeautyConversation;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class AssistantController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['messages'] = [];

        $userId = Auth::id();

        if ($userId) {
            $conversation = BeautyConversation::firstOrCreate([
                'user_id' => $userId,
            ]);

            $messages = $conversation->messages()->orderBy('id')->get();
            $viewData['messages'] = AssistantMessageResource::collection($messages)->resolve();
        }

        return view('assistant.index', $viewData);
    }
}
