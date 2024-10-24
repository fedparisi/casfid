document.addEventListener("DOMContentLoaded", function() {
    console.log('DOM completamente cargado y analizado');

    // Lógica para agregar ingredientes
    const addIngredientButton = document.getElementById('add-ingredient');
    if (addIngredientButton) {
        addIngredientButton.addEventListener('click', function() {
            console.log('Botón agregar ingrediente clickeado');
            const ingredientContainer = document.getElementById('ingredient-container');

            // Crea un nuevo div para el ingrediente
            const newIngredient = document.createElement('div');
            newIngredient.classList.add('ingredient-item', 'mb-3'); // Añadir clases para margen y manejo

            // Se añade el HTML para el nuevo ingrediente
            newIngredient.innerHTML = `
                <input type="text" name="ingredients[]" class="form-control mb-3" placeholder="Nombre del ingrediente" required>
                <input type="number" name="prices[]" class="form-control mb-3" placeholder="Precio" required>
                <button type="button" class="btn btn-danger remove-ingredient">Remover</button>
            `;

            // Agrega el nuevo ingrediente al contenedor
            ingredientContainer.appendChild(newIngredient);
        });
    }

    // Lógica para remover ingredientes
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('remove-ingredient')) {
            console.log('Botón remover ingrediente clickeado');
            const ingredientItem = event.target.parentElement; // Obtiene el div del ingrediente
            ingredientItem.remove(); // Elimina el div
        }
    });
});
