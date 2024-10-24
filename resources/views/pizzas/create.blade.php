@extends('layouts.app')

@section('card-title', isset($pizza->id) ? 'Editar Pizza' : 'Crear Pizza')

@section('content')
    <form method="POST" action="{{ isset($pizza) ? route('pizzas.update', $pizza->id) : route('pizzas.store') }}" enctype="multipart/form-data">
        @csrf
        @if (isset($pizza))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="name" class="form-label">Nombre de la Pizza</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ isset($pizza) ? old('name', $pizza->name) : old('name') }}" required>
        </div>

        <div class="mb-3">
            <label for="ingredients" class="form-label">Ingredientes</label>
            <select name="ingredients[]" id="ingredients" class="form-control" multiple required>
                @foreach($ingredients as $ingredient)
                    <option value="{{ $ingredient->id }}" 
                        {{ isset($pizza) && $pizza->ingredients->contains($ingredient->id) ? 'selected' : '' }}>
                        {{ $ingredient->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Imagen de la Pizza</label>
            <input type="file" name="image" class="form-control" id="image">
            @if (isset($pizza) && $pizza->image)
                <img src="{{ asset('storage/' . $pizza->image) }}" alt="{{ $pizza->name }}" class="img-thumbnail mt-2" style="width: 100px;">
            @endif
        </div>

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary mr-2">{{ isset($pizza) ? 'Actualizar' : 'Crear' }}</button>
            <a href="{{ route('pizzas.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
@endsection
