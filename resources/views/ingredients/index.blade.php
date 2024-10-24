@extends('layouts.app')

@section('card-title', 'Listado de Ingredientes') <!-- Título de la tarjeta -->

@section('content')
<div class="container">

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('ingredients.create') }}" class="btn btn-primary">Agregar Ingrediente</a>
    </div>

    @if ($ingredients->count() > 0)
    <div style="max-height: 400px; overflow-y: auto;">
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ingredients as $ingredient)
                <tr>
                    <td>{{ $ingredient->name }}</td>
                    <td>{{ $ingredient->price }}</td>
                    <td>
                        <form action="{{ route('ingredients.destroy', $ingredient->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <p>No hay ingredientes disponibles.</p>
    @endif

</div>
@endsection