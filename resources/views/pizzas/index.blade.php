@extends('layouts.app')

@section('card-title', 'Listado de Pizzas') <!-- Título de la tarjeta -->

@section('content')
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('pizzas.create') }}" class="btn btn-primary">Crear Pizza</a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pizzas as $pizza)
                <tr>
                    <td>{{ $pizza->id }}</td>
                    <td>{{ $pizza->name }}</td>
                    <td>
                        <img src="{{ asset('storage/' . $pizza->image) }}" alt="{{ $pizza->image }}" style="width: 100px;">
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
@endsection
