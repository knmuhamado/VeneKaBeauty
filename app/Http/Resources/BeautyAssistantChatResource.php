<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BeautyAssistantChatResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'success' => true,
            'messages' => AssistantMessageResource::collection(
                $this->resource->messages()->orderBy('id')->get()
            ),
        ];
    }
}
