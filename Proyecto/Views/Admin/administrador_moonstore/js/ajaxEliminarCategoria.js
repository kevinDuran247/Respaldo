$(document).ready(function () {
    // Utilizar delegación de eventos para el evento de clic en los botones de eliminar
    $("table").on("click", ".delete-category-button", function () {
        var categoryId = $(this).data("id");
        console.log(categoryId); // Agrega esta línea para imprimir el ID de la categoría en la consola
        if (confirm("¿Estás seguro de que deseas eliminar esta categoría?")) {
            $.ajax({
                url: "controladores/acciones_categorias/eliminar_categoria.php",
                type: "POST",
                data: { id: categoryId },
                success: function (response) {
                    // Aquí puedes manejar la respuesta del servidor después de eliminar la categoría
                    console.log(response);
                    alert("Categoría eliminada");
                    $('tbody').html(response);
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });
        }
    });
});
