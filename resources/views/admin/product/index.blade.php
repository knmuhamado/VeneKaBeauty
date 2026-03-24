{{-- David Alejandro Gutiérrez Leal --}}
@extends('layouts.app')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-2">
    <h2 class="mb-0">{{ __('product.admin_manage') }}</h2>

    <div class="d-flex flex-wrap gap-2">
        <a href="{{ route('admin.category.index') }}" class="btn btn-outline-secondary btn-lg">
            {{ __('product.go_to_categories') }}
        </a>

        <a href="{{ route('admin.product.create') }}" class="btn btn-primary btn-lg d-inline-flex align-items-center gap-2">
            <span>{{ __('product.create') }}</span>
        </a>
    </div>
</div>

@include('layouts._success_alert')

<x-product.filter
    action-route="admin.product.index"
    :query="$query"
    :categories="$categories"
    :has-filters="$hasFilters"
    query-input-id="admin-query"
    category-id-prefix="admin-category"
/>

<x-product.table
    :products="$products"
    :empty-message="__('product.empty_registered')"
    :show-admin-actions="true"
/>
@endsection
