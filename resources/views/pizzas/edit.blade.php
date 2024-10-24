@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Editar Pizza</h1>
    
    <form method="POST" action="{{ route('pizzas.update', $pizza->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nombre de la Pizza</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $pizza->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="ingredients" class="form-label">Ingredientes</label>
            <select name="ingredients[]" id="ingredients" class="form-control" multiple required>
                @foreach($ingredients as $ingredient)
                    <option value="{{ $ingredient->id }}" 
                        {{ $pizza->ingredients->contains($ingredient->id) ? 'selected' : '' }}>
                        {{ $ingredient->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Imagen de la Pizza</label>
            <input type="file" name="image" class="form-control" id="image">
            @if ($pizza->image)
                <img src="{{ asset('storage/' . $pizza->image) }}" alt="{{ $pizza->name }}" class="img-thumbnail mt-2" style="width: 100px;">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Pizza</button>
        <a href="{{ route('pizzas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
