<?php
    require_once("controladores/cn.php");
    $connet = new cn();
    $conn = $connet->cn();


    //GRAFICO1
    $sql = 'SELECT categorias.nombre AS categoria, COUNT(productos.id) AS cantidad
            FROM categorias
            LEFT JOIN productos ON categorias.id = productos.categoria_id
            GROUP BY categorias.id';
    $resultado = $conn->query($sql);
    $categorias = [];
    $cantidades = [];
    while ($fila = $resultado->fetch_assoc()) {
        $categorias[] = $fila['categoria'];
        $cantidades[] = (int)$fila['cantidad'];
    }
    $categoriasJSON = json_encode($categorias);
    $cantidadesJSON = json_encode($cantidades);


    //GRAFICO2
    $sql2 = 'SELECT categorias.nombre AS categoria, SUM(productos.precio) AS precio_total, SUM(productos.disponibilidad) AS existencias_total
    FROM categorias
    LEFT JOIN productos ON categorias.id = productos.categoria_id
    GROUP BY categorias.id';
    $resultado2 = $conn->query($sql2);
    $categorias2 = [];
    $preciosTotal = [];
    $existenciasTotal = [];
    while ($fila = $resultado2->fetch_assoc()) {
        $categorias2[] = $fila['categoria'];
        $preciosTotal[] = (float)$fila['precio_total'];
        $existenciasTotal[] = (int)$fila['existencias_total'];
    }
    $categorias2JSON = json_encode($categorias2);
    $preciosTotalJSON = json_encode($preciosTotal);
    $existenciasTotalJSON = json_encode($existenciasTotal);


    // Cerrar la conexión a la base de datos
    $conn->close();
?>
<?php
    require_once("controladores/cn.php");
    $connet = new cn();
    $conn = $connet->cn();
    $sql = "SELECT MONTH(fecha) AS mes, SUM(total) AS suma_dinero FROM compras GROUP BY mes";

    $result = $conn->query($sql);

    $meses = array();
    $sumas_dinero = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $numero_mes = $row['mes'];
            $nombre_mes = date('F', mktime(0, 0, 0, $numero_mes, 1));
            $meses[] = $nombre_mes;
            $sumas_dinero[] = $row['suma_dinero'];
        }
    }

    // Codificar los arreglos en formato JSON
    $mesesJSON = json_encode($meses);
    $sumasDineroJSON = json_encode($sumas_dinero);

    $conn->close();
?>

<style>
    .canvas_ProductosCategorias {
        display: flex;
    }

    .canvas-tamano {
        width: 50%;
        height: 400px;
    }

    #boton {
        background-color: red;
        color: white;
        padding: 10px 20px;
        font-size: 16px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
    #contenedorBtn {
    text-align: right;
    padding: 20px;
  }
</style>

<div class="container">
    <div id="contenedorBtn">
        <button onclick="generarPDF()" id="boton" class="bx bx-download nav_icon"> Descargar gráficos</button>
    </div>
    <br>
    <h3>
        <center><b>Productos/Categorias</b></center>
    </h3>

    <div class="canvas_ProductosCategorias">

        <div class="canvas-tamano">
            <canvas id="graficoProductos"></canvas>
            <h5>Grafico de cantidad de productos por categoria</h5>
            <script>
                // Obtener los datos de las categorías y cantidades desde PHP
                var categorias = <?php echo $categoriasJSON; ?>;
                var cantidades = <?php echo $cantidadesJSON; ?>;

                // Definir un arreglo de colores predefinidos basados en las categorías
                var colores = obtenerColoresCategoria(categorias.length);

                // Configuración del gráfico
                var ctx = document.getElementById('graficoProductos').getContext('2d');
                var chart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: categorias,
                        datasets: [{
                            label: 'Cantidad',
                            data: cantidades,
                            backgroundColor: colores,
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });

                // Función para asignar colores predefinidos basados en las categorías
                function obtenerColoresCategoria(cantidadCategorias) {
                    var colores = [];
                    var coloresPredefinidos = [
                        'rgba(255, 99, 132, 0.5)',
                        'rgba(54, 162, 235, 0.5)',
                        'rgba(255, 206, 86, 0.5)',
                        'rgba(75, 192, 192, 0.5)',
                        'rgba(153, 102, 255, 0.5)',
                        'rgba(255, 159, 64, 0.5)',
                        'rgba(255, 0, 0, 0.5)',
                        'rgba(0, 255, 0, 0.5)',
                        'rgba(0, 0, 255, 0.5)',
                        'rgba(128, 128, 128, 0.5)',
                        'rgba(255, 255, 0, 0.5)',
                        'rgba(0, 255, 255, 0.5)',
                        'rgba(255, 0, 255, 0.5)',
                        'rgba(128, 0, 0, 0.5)',
                        'rgba(0, 128, 0, 0.5)',
                        'rgba(0, 0, 128, 0.5)',
                        'rgba(255, 192, 203, 0.5)',
                        'rgba(0, 255, 128, 0.5)',
                        'rgba(128, 0, 128, 0.5)',
                        'rgba(255, 255, 255, 0.5)',
                        'rgba(0, 0, 0, 0.5)'
                    ];

                    for (var i = 0; i < cantidadCategorias; i++) {
                        var indiceColor = i % coloresPredefinidos
                            .length; // Obtener el índice del color en el arreglo de colores predefinidos
                        colores.push(coloresPredefinidos[indiceColor]);
                    }

                    return colores;
                }
            </script>
        </div>
        <div class="canvas-tamano">
            <canvas id="graficoPrecioCategorias"></canvas>
            <br>
            <h5>Precios y existencias totales por categoria</h5>
            <script>
                // Obtén los datos de las categorías desde PHP
                var nombresCategorias = <?php echo $categorias2JSON; ?>;
                var costosCategorias = <?php echo $preciosTotalJSON; ?>;
                var existenciasTotal = <?php echo $existenciasTotalJSON; ?>;

                // Configuración del gráfico
                var ctx = document.getElementById('graficoPrecioCategorias').getContext('2d');
                var chart = new Chart(ctx, {
                    type: 'line', // Cambiar a 'line' si prefieres un gráfico lineal
                    data: {
                        labels: nombresCategorias,
                        datasets: [{
                                label: 'Precio Total',
                                data: costosCategorias,
                                backgroundColor: 'rgba(54, 162, 235, 0.5)', // Color de fondo de las barras o línea
                                borderColor: 'rgba(54, 162, 235, 1)', // Color del borde de las barras o línea
                                borderWidth: 1
                            },
                            {
                                label: 'Existencias Total',
                                data: existenciasTotal,
                                backgroundColor: 'rgba(255, 99, 132, 0.5)', // Color de fondo de las barras o línea
                                borderColor: 'rgba(255, 99, 132, 1)', // Color del borde de las barras o línea
                                borderWidth: 1
                            }
                        ]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>
        </div>

    </div>

    <br>
    <br>
    <br>
    <br>
    <br>
    <h3><center><b>Ventas por mes</b></center></h3>
    <canvas id="graficoVentasMes"></canvas>
    <script>
        var meses = <?php echo $mesesJSON; ?>;
        var sumasDinero = <?php echo $sumasDineroJSON; ?>;

        var ctx = document.getElementById('graficoVentasMes').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: meses,
                datasets: [{
                    label: 'Suma de Dinero',
                    data: sumasDinero,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</div>
<script>
    function generarPDF() {
        // Crea el objeto jsPDF
        const doc = new jsPDF();

        // Define el tamaño de la página
        const pageSize = doc.internal.pageSize;
        const pageWidth = pageSize.getWidth();
        const pageHeight = pageSize.getHeight();

        // Define la posición y dimensiones de los gráficos en el PDF
        const width = 130; // Ancho de los gráficos
        const height = 100; // Alto de los gráficos
        const spacing = 50; // Espacio entre gráficos

        // Calcula la posición x para centrar los gráficos horizontalmente
        const x = (pageWidth - width) / 2; // Posición x inicial para centrar

        // Obtén los elementos canvas de los gráficos
        const canvas1 = document.getElementById('graficoProductos');
        const canvas2 = document.getElementById('graficoPrecioCategorias');
        const canvas3 = document.getElementById('graficoVentasMes');

        // Establece el fondo transparente en los lienzos de los gráficos
        const context1 = canvas1.getContext('2d');
        context1.fillStyle = 'transparent';
        context1.fillRect(0, 0, canvas1.width, canvas1.height);

        const context2 = canvas2.getContext('2d');
        context2.fillStyle = 'transparent';
        context2.fillRect(0, 0, canvas2.width, canvas2.height);

        const context3 = canvas3.getContext('2d');
        context3.fillStyle = 'transparent';
        context3.fillRect(0, 0, canvas3.width, canvas3.height);

        // Obtiene las imágenes de los gráficos en formato base64
        const imageData1 = canvas1.toDataURL('image/png');
        const imageData2 = canvas2.toDataURL('image/png');
        const imageData3 = canvas3.toDataURL('image/png');

        // Agrega la primera imagen al PDF en la página actual (página 1)
        doc.addImage(imageData1, 'PNG', x, 10, width, height);

        // Agrega la segunda imagen al PDF en la página actual (página 1)
        doc.addImage(imageData2, 'PNG', x, 10 + height + spacing, width, height);

        // Añade una nueva página al documento (página 2)
        doc.addPage();

        // Agrega la tercera imagen al PDF en la segunda página (página 2)
        doc.addImage(imageData3, 'PNG', x, 10, width, height);

        // Guarda el PDF
        doc.save('Estadisticas.pdf');
    }
</script>