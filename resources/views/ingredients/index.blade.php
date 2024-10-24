@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Ingredientes</h1>

    @if ($ingredients->count() > 0)
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
    @else
        <p>No hay ingredientes disponibles.</p>
    @endif
    <a href="{{ route('ingredients.create') }}" class="btn btn-primary mb-3">Agregar Ingrediente</a>
</div>
@endsection
