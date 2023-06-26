/*Formulario agregar producto*/
function mostrarVistaPrevia(event) {
    var archivo = event.target.files[0];
    var vistaPrevia = document.getElementById('vista-previa');

    if (archivo) {
        var lector = new FileReader();

        lector.onload = function(e) {
            vistaPrevia.src = e.target.result;
            vistaPrevia.style.display = 'block';
        };

        lector.readAsDataURL(archivo);
    } else {
        vistaPrevia.src = '#';
        vistaPrevia.style.display = 'none';
    }
}


