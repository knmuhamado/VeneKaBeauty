{{-- David Alejandro Gutiérrez Leal --}}
<div class="mb-3">
    <label>Nombre</label>
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
        <label>Imagen actual</label>
        @if($product->getImage())
            <div class="mb-2">
                <img src="{{ asset('storage/' . $product->getImage()) }}" width="120" class="img-thumbnail">
            </div>
        @else
            <p class="mb-2">N/A</p>
        @endif

        <label>Nueva imagen (opcional)</label>
        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
    @else
        <label>Imagen</label>
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
    <label>Descripción</label>
    <textarea name="description"
              class="form-control @error('description') is-invalid @enderror"
              required>{{ old('description', $isEdit ? $product->getDescription() : '') }}</textarea>
    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label>Disponible</label>
    <select name="available" class="form-control @error('available') is-invalid @enderror">
        <option value="1" {{ old('available', $availableDefault) == '1' ? 'selected' : '' }}>Sí</option>
        <option value="0" {{ old('available', $availableDefault) == '0' ? 'selected' : '' }}>No</option>
    </select>
    @error('available')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label>Precio</label>
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
    <label>Marca (opcional)</label>
    <input type="text"
           name="brand"
           class="form-control @error('brand') is-invalid @enderror"
           value="{{ old('brand', $isEdit ? $product->getBrand() : '') }}">
    @error('brand')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label>Keywords (separadas por coma)</label>
    <input type="text"
           name="keyword"
           class="form-control @error('keyword') is-invalid @enderror"
           value="{{ is_array(old('keyword')) ? implode(', ', old('keyword')) : old('keyword', $keywordDefault) }}">
    @error('keyword')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label>Categoría</label>
    <select name="category_id" class="form-control @error('category_id') is-invalid @enderror" required>
        <option value="">Seleccione una categoría</option>
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
    <label>Tipo</label>
    <select name="type" class="form-control @error('type') is-invalid @enderror">
        <option value="article" {{ old('type', $isEdit ? $product->getType() : 'article') === 'article' ? 'selected' : '' }}>Artículo</option>
        <option value="service" {{ old('type', $isEdit ? $product->getType() : 'article') === 'service' ? 'selected' : '' }}>Servicio</option>
    </select>
    @error('type')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
