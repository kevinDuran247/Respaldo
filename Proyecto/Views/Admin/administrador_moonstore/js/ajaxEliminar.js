$(document).ready(function () {
    // Utilizar delegación de eventos para el evento de clic en los botones de eliminar
    $("table").on("click", ".delete-button", function () {
        var productId = $(this).data("id");
        console.log(productId); // Agrega esta línea para imprimir el ID del producto en la consola
        if (confirm("¿Estás seguro de que deseas eliminar este producto?")) {
            $.ajax({
                url: "controladores/acciones_productos/eliminar_producto.php",
                type: "POST",
                data: { id: productId },
                success: function (response) {
                    // Aquí puedes manejar la respuesta del servidor después de eliminar el producto
                    console.log(response);
                    alert("Producto eliminado");
                    $('tbody').html(response);
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });
        }
    });
});
