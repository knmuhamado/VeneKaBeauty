<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AssistantMessageResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->getId(),
            'role' => $this->resource->getRole(),
            'content' => $this->resource->getContent(),
            'products' => AssistantProductResource::collection($this->resource->getProducts())->resolve(),
            'meta' => $this->resource->getMeta(),
            'created_at' => optional($this->resource->getCreatedAt())?->toIso8601String(),
        ];
    }
}
