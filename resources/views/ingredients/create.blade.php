@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Agregar Ingrediente</h1>

    <form method="POST" action="{{ route('ingredients.store') }}">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nombre del Ingrediente</label>
            <input type="text" name="name" class="form-control" id="name" required>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Precio</label>
            <input type="number" name="price" class="form-control" id="price" required>
        </div>

        <button type="submit" class="btn btn-primary">Agregar Ingrediente</button>
        <a href="{{ route('ingredients.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
