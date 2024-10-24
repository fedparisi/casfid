@extends('layouts.app')

@section('card-title', 'Agregar Ingrediente') <!-- Define el título de la tarjeta -->

@section('content')
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

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary mr-2">Agregar Ingrediente</button>
            <a href="{{ route('ingredients.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
@endsection
