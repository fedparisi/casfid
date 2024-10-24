<!-- resources/views/layouts/navigation.blade.php -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Pizza App</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('pizzas.index') }}">Pizzas</a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link" href="{{ route('pizzas.create') }}">Crear pizza</a>
            </li> -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('ingredients.index') }}">Ingredientes</a>
            </li>
            <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="nav-link" style="background: none; border: none; color: inherit; cursor: pointer;">
                        Logout
                    </button>
                </form>
            </li>

        </ul>
    </div>
</nav>