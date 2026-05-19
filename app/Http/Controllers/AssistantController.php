<?php

namespace App\Http\Controllers;

use App\Http\Resources\AssistantMessageResource;
use App\Models\BeautyConversation;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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

            $viewData['messages'] = AssistantMessageResource::collection(
                $conversation->messages()->orderBy('id')->get()
            )->resolve();
        }

        return view('assistant.index', $viewData);
    }

    public function destroy(Request $request): RedirectResponse
    {
        $conversation = BeautyConversation::where('user_id', (int) $request->user()->getId())->first();

        if ($conversation) {
            $conversation->delete();
        }

        return redirect()->route('assistant.index')
            ->with('success', __('assistant.controller.chat_cleared'));
    }
}