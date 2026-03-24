{{-- Mariamny Del Valle Ramírez Telles --}}

@if(!empty($viewData['productId']))
    <input type="hidden" name="product_id" value="{{ $viewData['productId'] }}">
@endif

<div class="mb-3">
    <label class="form-label">{{ __('review.comment') }}</label>
    <textarea class="form-control" name="comment">{{ old('comment') }}</textarea>
</div>

<div class="mb-3">
    <label class="form-label">{{ __('review.score') }}</label>
    <input type="number" name="score" min="0" max="5" class="form-control" value="{{ old('score') }}">
</div>