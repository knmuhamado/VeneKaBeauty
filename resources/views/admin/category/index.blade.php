{{-- David Alejandro Gutiérrez Leal --}}
@extends('layouts.app')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
    <h2 class="mb-0">{{ __('category.admin_manage') }}</h2>

    <div class="d-flex flex-wrap gap-2">
        <a href="{{ route('admin.product.index') }}" class="btn btn-outline-secondary">
            {{ __('category.go_to_products') }}
        </a>

        <a href="{{ route('admin.category.create') }}" class="btn btn-primary">
            {{ __('category.create') }}
        </a>
    </div>
</div>

@include('layouts._success_alert')

<table class="table table-bordered table-striped align-middle">
    <thead class="table-dark">
        <tr>
            <th>{{ __('category.id') }}</th>
            <th>{{ __('category.name') }}</th>
            <th>{{ __('category.actions') }}</th>
        </tr>
    </thead>
    <tbody>
        @forelse($categories as $category)
            <tr>
                <td>{{ $category->getId() }}</td>
                <td>{{ $category->getName() }}</td>
                <td>
                    <a href="{{ route('admin.category.edit', $category->getId()) }}" class="btn btn-outline-secondary btn-sm">
                        {{ __('category.edit') }}
                    </a>

                    <form action="{{ route('admin.category.destroy', $category->getId()) }}"
                          method="POST"
                          style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        @php($deleteConfirm = __('category.delete_confirm'))

                        <button type="submit"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('{{ $deleteConfirm }}')">
                            {{ __('category.delete') }}
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="text-center">
                    {{ __('category.empty_registered') }}
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection
