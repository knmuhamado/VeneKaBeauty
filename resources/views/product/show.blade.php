{{-- David Alejandro Gutiérrez Leal --}}
@extends('layouts.app')

@section('content')
<h2 class="mb-3">{{ __('product.detail') }}</h2>

@include('layouts._success_alert')

<div class="card shadow-sm mb-4">
    @if($product->getImage())
        <img src="{{ asset('storage/' . $product->getImage()) }}"
             class="card-img-top"
             style="max-height: 360px; object-fit: cover;"
             alt="{{ $product->getName() }}">
    @endif

    <div class="card-body">
        <h5 class="card-title">{{ $product->getName() }}</h5>
        <p class="card-text">{{ $product->getDescription() }}</p>

        <p><strong>{{ __('product.price') }}:</strong> ${{ $product->getPrice() }}</p>
        <p><strong>{{ __('product.available') }}:</strong> {{ $product->getAvailable() ? __('product.yes') : __('product.no') }}</p>
        <p><strong>{{ __('product.brand') }}:</strong> {{ $product->getBrand() ?? __('product.not_available') }}</p>
        <p><strong>{{ __('product.category') }}:</strong> {{ $product->getCategory()?->getName() ?? __('product.not_available') }}</p>
        <p><strong>{{ __('product.type') }}:</strong> {{ $product->getType() }}</p>

        <p><strong>{{ __('product.keywords') }}:</strong>
            @if($product->getKeyword())
                {{ implode(', ', $product->getKeyword()) }}
            @else
                {{ __('product.not_available') }}
            @endif
        </p>

        <div class="d-flex flex-wrap gap-2 mt-3">
            <a href="{{ route('product.index') }}" class="btn btn-secondary">{{ __('product.back') }}</a>

            @if($canReview && empty($userReview))
                <a href="{{ route('review.create', ['product_id' => $product->getId()]) }}" class="btn btn-success">
                    {{ __('review.create') }}
                </a>
            @elseif(! $isLoggedIn)
                <a href="{{ route('login') }}" class="btn btn-outline-secondary">
                    {{ __('home.login_to_buy') }}
                </a>
            @endif
        </div>
    </div>
</div>

<section>
    <h3 class="mb-3">{{ __('review.title_product') }} {{ $product->getName() }}</h3>

    @if($reviews->isEmpty())
        <div class="text-muted border rounded-3 p-4">
            {{ __('review.empty_product') }}
        </div>
    @else
        <div class="row row-cols-1 row-cols-md-2 g-3">
            @foreach($reviews as $review)
                <div class="col">
                    <article class="card h-100 shadow-sm border-0">
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h6 class="mb-0">
                                    {{ $review->getUser()?->getName() ?? __('review.anonymous') }}
                                </h6>
                                <span class="badge bg-primary">{{ $review->getScore() }}/5</span>
                            </div>

                            <p class="mb-2">{{ $review->getComment() }}</p>
                            <small class="text-muted mt-auto">{{ $review->getCreatedAt() }}</small>

                            @if($canReview && !empty($userReview) && $userReview->getId() === $review->getId())
                                <div class="d-flex gap-2 mt-3">
                                    <a href="{{ route('review.edit', $review->getId()) }}" class="btn btn-outline-secondary btn-sm">
                                        {{ __('review.edit') }}
                                    </a>

                                    <form action="{{ route('review.destroy', $review->getId()) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm">{{ __('review.delete') }}</button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </article>
                </div>
            @endforeach
        </div>
    @endif
</section>
@endsection
