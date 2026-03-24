{{-- David Alejandro Gutiérrez Leal --}}
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
