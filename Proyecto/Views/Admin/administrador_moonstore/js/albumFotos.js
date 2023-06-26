    // Obtener referencias a los elementos del DOM
    const form = document.getElementById('form');
    const input = document.getElementById('imageInput');
    const preview = document.getElementById('imagePreview');
    const clearButton = document.getElementById('clearButton');
    let files = []; // Array para almacenar las imágenes seleccionadas

    // Escuchar el evento 'change' del input de imágenes
    input.addEventListener('change', function(e) {
        const newFiles = Array.from(e.target.files); // Convertir FileList en un array

        // Limpiar la vista previa y el array de archivos
        preview.innerHTML = '';
        files = [];

        // Mostrar una vista previa de cada imagen seleccionada
        newFiles.forEach(function(file) {
            files.push(file);

            const reader = new FileReader();

            reader.onload = function(e) {
                const image = document.createElement('img');
                image.src = e.target.result;
                image.classList.add('img-thumbnail');
                image.classList.add('img-fluid');
                image.style.width = '95px';
                image.style.height = 'auto';

                const deleteButton = document.createElement('button');
                deleteButton.textContent = 'X';
                deleteButton.addEventListener('click', function() {
                    deleteImage(image);
                });

                const container = document.createElement('div');
                container.appendChild(image);
                container.appendChild(deleteButton);
                preview.appendChild(container);
            };

            reader.readAsDataURL(file);
        });

        // Verificar si se han agregado imágenes y mostrar/ocultar el botón
        if (input.files.length > 0) {
            clearButton.style.display = 'block';
        } else {
            clearButton.style.display = 'none';
        }

        updateInputValue();
    });

    // Agrega el evento click al botón clearButton
    clearButton.addEventListener('click', function() {
        // Vaciar la vista previa y el array de archivos
        preview.innerHTML = '';
        files = [];

        // Ocultar el botón
        clearButton.style.display = 'none';
    });

    // Ocultar el botón inicialmente si no hay imágenes cargadas
    clearButton.style.display = 'none';

    // Resto del código...



    // Función para eliminar una imagen del input y de la vista previa
    function deleteImage(image) {
        const container = image.parentNode;
        const index = Array.from(preview.children).indexOf(container);

        if (index !== -1) {
            files.splice(index, 1);
            preview.removeChild(container);
            updateInputValue();
        }
    }

    // Función para actualizar el valor del input
    function updateInputValue() {
        const fileList = new DataTransfer();
        files.forEach(function(file) {
            fileList.items.add(file);
        });
        input.files = fileList.files;

        if (files.length > 0) {
            input.value = `${files.length} archivo${files.length > 1 ? 's' : ''}`;
        } else {
            input.value = '';
        }
    }

    // Escuchar el evento 'click' del botón de vaciar
    clearButton.addEventListener('click', function() {
        files = [];
        preview.innerHTML = '';
        updateInputValue();
    });