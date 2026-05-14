<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->getId(),
            'name'        => $this->getName(),
            'description' => $this->getDescription(),
            'price'       => $this->getPrice(),
            'brand'       => $this->getBrand(),
            'type'        => $this->getType(),
            'keywords'    => $this->getKeyword(),
            'category'    => $this->getCategory()->getName(),
            'rating'      => $this->getAverageScore(),
        ];
    }
}
