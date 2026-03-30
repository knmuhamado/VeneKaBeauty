{{-- Create Product View --}}
@extends('layouts.app')

@section('content')
    <h2>{{ __('product.create_title') }}</h2>

    <form method="POST" action="{{ route('admin.product.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>{{ __('product.name') }}</label>
            <input type="text"
                   name="name"
                   class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name', $isEdit ? $product->getName() : '') }}"
                   required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            @if($isEdit)
                <label>{{ __('product.current_image') }}</label>
                @if($product->getImage())
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $product->getImage()) }}" width="120" class="img-thumbnail">
                    </div>
                @else
                    <p class="mb-2">{{ __('product.not_available') }}</p>
                @endif

                <label>{{ __('product.new_image_optional') }}</label>
                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
            @else
                <label>{{ __('product.image') }}</label>
                <input type="file"
                       name="image"
                       class="form-control @error('image') is-invalid @enderror"
                       required>
            @endif

            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>{{ __('product.description') }}</label>
            <textarea name="description"
                      class="form-control @error('description') is-invalid @enderror"
                      required>{{ old('description', $isEdit ? $product->getDescription() : '') }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>{{ __('product.available') }}</label>
            <select name="available" class="form-control @error('available') is-invalid @enderror">
                <option value="1" {{ old('available', $availableDefault) == '1' ? 'selected' : '' }}>{{ __('product.yes') }}</option>
                <option value="0" {{ old('available', $availableDefault) == '0' ? 'selected' : '' }}>{{ __('product.no') }}</option>
            </select>
            @error('available')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>{{ __('product.price') }}</label>
            <input type="number"
                   name="price"
                   class="form-control @error('price') is-invalid @enderror"
                   value="{{ old('price', $isEdit ? $product->getPrice() : '') }}"
                   required>
            @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>{{ __('product.brand_optional') }}</label>
            <input type="text"
                   name="brand"
                   class="form-control @error('brand') is-invalid @enderror"
                   value="{{ old('brand', $isEdit ? $product->getBrand() : '') }}">
            @error('brand')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>{{ __('product.keywords_hint') }}</label>
            <input type="text"
                   name="keyword"
                   class="form-control @error('keyword') is-invalid @enderror"
                   value="{{ is_array(old('keyword')) ? implode(', ', old('keyword')) : old('keyword', $keywordDefault) }}">
            @error('keyword')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>{{ __('product.category') }}</label>
            <select name="category_id" class="form-control @error('category_id') is-invalid @enderror" required>
                <option value="">{{ __('product.select_category') }}</option>
                @foreach($categories as $category)
                    <option value="{{ $category->getId() }}" {{ old('category_id', $isEdit ? $product->getCategoryId() : null) == $category->getId() ? 'selected' : '' }}>
                        {{ $category->getName() }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>{{ __('product.type') }}</label>
            <select name="type" class="form-control @error('type') is-invalid @enderror">
                <option value="article" {{ old('type', $isEdit ? $product->getType() : 'article') === 'article' ? 'selected' : '' }}>{{ __('product.article') }}</option>
                <option value="service" {{ old('type', $isEdit ? $product->getType() : 'article') === 'service' ? 'selected' : '' }}>{{ __('product.service') }}</option>
            </select>
            @error('type')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">
                {{ __('product.create_submit') }}
            </button>

            <a href="{{ route('admin.product.index') }}" class="btn btn-secondary">
                {{ __('product.back') }}
            </a>
        </div>
    </form>
@endsection
