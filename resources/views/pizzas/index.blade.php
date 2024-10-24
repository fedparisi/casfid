@extends('layouts.app')

@section('card-title', 'Listado de Pizzas') 

@section('content')
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('pizzas.create') }}" class="btn btn-primary">Crear Pizza</a>
    </div>

    @if($pizzas->isEmpty())
        <div class="alert alert-warning" role="alert">
            No hay pizzas disponibles. ¡Agrega una nueva pizza!
        </div>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Imagen</th>
                    <th>Valor</th>
                    <th>Ingredientes</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pizzas as $pizza)
                    <tr>
                        <td>{{ $pizza->id }}</td>
                        <td>{{ $pizza->name }}</td>
                        <td>
                            <img src="{{ asset('storage/' . $pizza->image) }}" alt="{{ $pizza->name }}" style="width: 100px;">
                        </td>
                        <td>{{ $pizza->price }}</td>
                        <td>
                            @foreach($pizza->ingredients as $ingredient)
                                <span class="badge bg-info">{{ $ingredient->name }}</span>
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('pizzas.edit', $pizza->id) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('pizzas.destroy', $pizza->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
