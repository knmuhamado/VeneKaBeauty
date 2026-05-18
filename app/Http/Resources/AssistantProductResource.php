<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AssistantProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $id = $this->extractId();
        $url = $this->extractUrl($id);

        return [
            'id' => $id,
            'name' => $this->extractName(),
            'category' => $this->extractCategory(),
            'url' => $url,
        ];
    }

    private function extractId(): ?int
    {
        if (is_array($this->resource)) {
            return isset($this->resource['id']) && is_numeric($this->resource['id'])
                ? (int) $this->resource['id']
                : null;
        }

        return method_exists($this->resource, 'getId')
            ? (int) $this->resource->getId()
            : null;
    }

    private function extractUrl(?int $id): string
    {
        if (is_array($this->resource)) {
            $url = $this->resource['url'] ?? null;

            if (is_string($url) && trim($url) !== '') {
                return $url;
            }
        }

        return $id ? route('product.show', ['id' => $id]) : '#';
    }

    private function extractName(): string
    {
        if (is_array($this->resource)) {
            return isset($this->resource['name']) ? (string) $this->resource['name'] : '';
        }

        return method_exists($this->resource, 'getName')
            ? (string) ($this->resource->getName() ?? '')
            : '';
    }

    private function extractCategory(): string
    {
        if (is_array($this->resource)) {
            return isset($this->resource['category']) ? (string) $this->resource['category'] : '';
        }

        if (method_exists($this->resource, 'getCategory')) {
            $category = $this->resource->getCategory();

            return $category ? (string) ($category->getName() ?? '') : '';
        }

        return '';
    }
}
