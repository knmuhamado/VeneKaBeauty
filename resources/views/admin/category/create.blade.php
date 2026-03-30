{{-- Create Category View --}}
@extends('layouts.app')

@section('content')
    <h2>{{ __('category.create_title') }}</h2>

    <form method="POST" action="{{ route('admin.category.store') }}">
        @csrf

        <div class="mb-3">
            <label>{{ __('category.name') }}</label>
            <input type="text"
                   name="name"
                   class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name', $isEdit ? $category->getName() : '') }}"
                   required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">
                {{ __('category.create_submit') }}
            </button>

            <a href="{{ route('admin.category.index') }}" class="btn btn-secondary">
                {{ __('category.back') }}
            </a>
        </div>
    </form>
@endsection
