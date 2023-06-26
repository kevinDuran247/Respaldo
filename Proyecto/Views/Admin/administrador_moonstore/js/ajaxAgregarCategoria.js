
$(document).ready(function () {
    $("button[name='btnAgregarCategoria']").click(function (event) {
        event.preventDefault(); // Evita que se envíe el formulario por defecto

        var formulario = $("#formularioCategoria").serialize(); // Serializar el formulario

        $.ajax({
            url: "controladores/acciones_categorias/agregar_categoria.php",
            type: "POST",
            data: formulario,
            success: function (response) {
                alert ("Categoria agregada");
                console.log(response);
                $('tbody').html(response);
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    });
});
