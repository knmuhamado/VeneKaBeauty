<?php

// Mariamny Del Valle Ramírez Telles

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReviewRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'comment' => 'required|string',
            'score' => 'required|integer|between:0,5',
            'product_id' => 'required|integer|exists:products,id',
        ];
    }

    public function reviewData(): array
    {
        $data = $this->validated();

        return [
            'comment' => $data['comment'],
            'score' => $data['score'],
            'product_id' => $data['product_id'] ?? null,
        ];
    }

    public function messages(): array
    {
        return [
            'score.required' => __('review.score.required'),
            'score.integer' => __('review.score.integer'),
            'score.between' => __('review.score.between'),
            'comment.required' => __('review.comment.required'),
            'product_id.integer' => __('review.product_id.integer'),
            'product_id.exists' => __('review.product_id.exists'),
        ];
    }
}
