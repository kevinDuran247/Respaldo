<!doctype html>
<html lang="en">

<head>
    <title>

    </title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <style>
        .contenedor-formulario {
            width: 40%;
            margin: auto;
            margin-top: 60px;
            font-family: JetBrains Mono NL;
            height: 500px;
            border-radius: 10px;
        }

        #alertRegister {
            font-family: JetBrains Mono NL;
            display: none;
            /* Ocultar inicialmente la alerta */
            padding: 10px;
            color: #fff;
            font-weight: bold;
            text-align: center;
            width: 50%;
            margin: auto;
            margin-top: 10px;
        }

        #alertRegister .closebtn {
            float: right;
            cursor: pointer;
        }

        #alertRegister.error {
            background-color: #e42f25;
            /* Color de fondo para la alerta de error */
        }

        #alertRegister.success {
            background-color: #22cc22;
            /* Color de fondo para la alerta de éxito */
        }

        .check-symbol {
            color: green;
        }

        .x-symbol {
            color: red;
        }

        #alert {
            font-family: JetBrains Mono NL;
            display: none;
            /* Ocultar inicialmente la alerta */
            padding: 10px;
            color: #fff;
            font-weight: bold;
            text-align: center;
            width: 50%;
            margin: auto;
            margin-top: 10px;
        }

        #alert .closebtn {
            float: right;
            cursor: pointer;
        }

        #alert.error {
            background-color: #e42f25;
            /* Color de fondo para la alerta de error */
        }

        #alert.success {
            background-color: #22cc22;
            /* Color de fondo para la alerta de éxito */
        }
    </style>

    <?php
    session_start();
    date_default_timezone_set('America/El_Salvador');
    $fecha = date("Y-m-d");
    ?>


    <?php
    if (isset($_SESSION['alert'])) {
        $alert = $_SESSION['alert'];
    ?>
        <div class="alert" id="error">
            <?php echo $alert ?>
        </div>

    <?php
        unset($_SESSION['alert']);
    } ?>

</head>

<body>
    <header>

    </header>
    <main>

        <div class="" id='alertRegister'>

        </div>

        <div class="contenedor-formulario">
            <div class="container">
                <form id='FormRegister'>
                    <h3 class='text-center' style='font-family:Impact'>REGISTER</h3>
                    <div class="row">
                        <div class="col">
                            <input type="text" class="form-control" placeholder="Nombre completo" id='nombreCompleto'>
                        </div>

                    </div>

                    <div class="row mt-4">
                        <div class="col-sm-6">
                            <input type="password" class="form-control" placeholder="Contraseña" id="PasswordRegister">
                            <div id="password-standards" style="display:none; font-family: Calibri Light ;margin-top: 10px; font-weight: bold;">
                                <div>
                                    <span id="standard-length" class="check-symbol">-</span> Mínimo 8 caracteres
                                </div>
                                <div>
                                    <span id="standard-uppercase" class="check-symbol">-</span> Al menos una letra mayúscula
                                </div>
                                <div>
                                    <span id="standard-lowercase" class="check-symbol">-</span> Al menos una letra minúscula
                                </div>
                                <div>
                                    <span id="standard-number" class="check-symbol">-</span> Al menos un número
                                </div>
                                <div>
                                    <span id="standard-special-char" class="check-symbol">-</span> Al menos un carácter especial
                                </div>
                            </div>

                        </div>
                        <div class="col-sm-6">
                            <input type="email" class="form-control" placeholder="example@gmail.com" id='EmailRegister'>
                            <input type="hidden" id='FechaRegistro' value='<?php echo $fecha ?>'>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-sm-6">
                            <select id='departamentoRegister' class='form-select form-select' name='departamento' onchange='actualizarModelos()'>
                                <option value='' disabled>Selecciona un departamento</option>
                                <option value='San Salvador'>San Salvador</option>
                                <option value='La Libertad'>La Libertad</option>
                                <option value='Santa Ana'>Santa Ana</option>
                                <option value='Sonsonate'>Sonsonate</option>
                                <option value='La Paz'>La Paz</option>
                                <option value='San Miguel'>San Miguel</option>
                                <option value='Ahuachapán'>Ahuachapán</option>
                                <option value='La Unión'>La Unión</option>
                                <option value='Chalatenango'>Chalatenango</option>
                                <option value='Usulután'>Usulután</option>
                                <option value='Cuscatlán'>Cuscatlán</option>
                                <option value='Morazán'>Morazán</option>
                                <option value='Cabañas'>Cabañas</option>
                                <option value='San Vicente'>San Vicente</option>
                            </select>
                        </div>

                        <div class="col-sm-6">
                            <select id='modelo' name='municipio' class='form-select form-select'>
                                <option value='' disabled>Selecciona un municipio</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col">
                            <input type="text" class="form-control" placeholder="Ciudad, Canton, Calle, Casa..." id='direccionRegister'>
                        </div>
                    </div>

                    <div class="row text-center mt-4">
                        <div class="col mx-auto">
                            <button class='btn btn-success btn-custom' type='submit' style='font-family:JetBrains Mono NL'>Registrar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>



    </main>
    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://code.jquery.com/jquery-2.1.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>


    <script>
        $(document).ready(function() {
            $('#FormRegister').on('submit', function(e) {
                e.preventDefault(); // Evita el comportamiento de envío predeterminado del formulario

                var nombreCompleto = $('#nombreCompleto').val();
                var password = $('#PasswordRegister').val();
                var emailRegister = $('#EmailRegister').val();
                var municipio = $('#modeloRegister').val();
                var departamento = $('#departamentoRegister').val();
                var direccionRegister = $('#direccionRegister').val();
                var fecha = $('#FechaRegistro').val();


                if (nombreCompleto === '' || password === '' || emailRegister === '' || municipio === '' || direccionRegister === '') {
                    // Muestra la alerta sin recargar la página
                    $('#alertRegister').html('<span class="closebtn" onclick="closeAlert()">&times;</span>RELLENE LOS CAMPOS VACIOS').addClass('error').show();

                    var tiempoDesaparicion = 2000;

                    // Ocultar la alerta después del tiempo especificado
                    setTimeout(function() {
                        $('#alertRegister').hide();
                    }, tiempoDesaparicion);

                } else {
                    window.location.href = 'Controllers/UserControllers/InsertUser.php?nombreCompleto=' + encodeURIComponent(nombreCompleto) + '&passwordRegister=' + encodeURIComponent(password) + '&emailRegister=' + encodeURIComponent(emailRegister) + '&municipioRegister=' + encodeURIComponent(municipio) + '&direccionRegister=' + encodeURIComponent(direccionRegister) + '&fechaRegister=' + encodeURIComponent(fecha) + '&departamentoRegister=' + encodeURIComponent(departamento);
                }
            });
        });

        function closeAlert() {
            var alert = document.getElementById("alertRegister");
            alert.style.display = "none";
        }

        setTimeout(function() {
            closeAlert();
        }, 4000);
    </script>


    <script>
        const passwordInput = document.getElementById("PasswordRegister");
        const standardsDiv = document.getElementById("password-standards");

        // Agregar eventos de escucha para mostrar/ocultar el cuadro de estándares
        passwordInput.addEventListener("focus", function() {
            standardsDiv.style.display = "block";
        });

        passwordInput.addEventListener("blur", function() {
            standardsDiv.style.display = "none";
        });

        // Agregar un evento de escucha al campo de contraseña
        passwordInput.addEventListener("input", function() {
            const password = this.value;

            // Verificar los estándares que cumple la contraseña y actualizar los símbolos
            document.getElementById("standard-length").innerHTML = password.length >= 8 ? "&#10003;" : "&#x2717;";
            document.getElementById("standard-length").className = password.length >= 8 ? "check-symbol" : "x-symbol";

            document.getElementById("standard-uppercase").innerHTML = /[A-Z]/.test(password) ? "&#10003;" : "&#x2717;";
            document.getElementById("standard-uppercase").className = /[A-Z]/.test(password) ? "check-symbol" : "x-symbol";

            document.getElementById("standard-lowercase").innerHTML = /[a-z]/.test(password) ? "&#10003;" : "&#x2717;";
            document.getElementById("standard-lowercase").className = /[a-z]/.test(password) ? "check-symbol" : "x-symbol";

            document.getElementById("standard-number").innerHTML = /\d/.test(password) ? "&#10003;" : "&#x2717;";
            document.getElementById("standard-number").className = /\d/.test(password) ? "check-symbol" : "x-symbol";

            document.getElementById("standard-special-char").innerHTML = /[!@#$%^&*]/.test(password) ? "&#10003;" : "&#x2717;";
            document.getElementById("standard-special-char").className = /[!@#$%^&*]/.test(password) ? "check-symbol" : "x-symbol";
        });
    </script>
</body>

</html>


<script>
    function actualizarModelos() {
        var departamentoSelect = document.getElementById("departamentoRegister");
        var modeloSelect = document.getElementById("modelo");
        var departamentoSeleccionado = departamentoSelect.value;

        // Limpiar select de modelos
        modeloSelect.innerHTML = '<option value="" selected disabled>Selecciona un municipio</option>';

        var municipios = obtenerMunicipios(departamentoSeleccionado);

        municipios.forEach(function(municipio) {
            var opcion = document.createElement("option");
            opcion.value = municipio;
            opcion.text = municipio;
            modeloSelect.appendChild(opcion);
        });
    }

    function obtenerMunicipios(departamento) {
        var municipios = [];

        if (departamento === "San Vicente") {
            municipios = [
                "Candelaria de la Frontera",
                "Chalchuapa",
                "Coatepeque",
                "El Congo",
                "El Porvenir",
                "Mashualt",
                "Metapán",
                "San Antonio Pajonal",
                "San Sebastian Saltrillo",
                "Santa Ana",
                "Santa Rosa Guachipilín",
                "Santiago de la Frontera",
                "Texistepeque"
            ];
        } else if (departamento === "San Salvador") {
            municipios = [
                "Aguilares",
                "Apopa",
                "Ayutuxtepeque",
                "Ciudad Delgado",
                "Cuscatancingo",
                "El Paisnal",
                "Guazapa",
                "Ilopango",
                "Mejicanos",
                "Nejapa",
                "Panchimalco",
                "San Marcos",
                "San Martín",
                "San Salvador",
                "Santo Tomás",
                "Soyapango",
                "Tonacatepeque"
            ];
        } else if (departamento === "Ahuachapán") {
            municipios = [
                "Ahuachapán",
                "Apaneca",
                "Atiquizaya",
                "Concepción de Ataco",
                "El Refugio",
                "Guaymango",
                "Jujutla",
                "San Francisco Menéndez",
                "San Lorenzo",
                "San Pedro Puxtla",
                "Tacuba",
                "Turín"
            ];
        } else if (departamento === "La Libertad") {
            municipios = [
                "Antiguo Cuscatlán",
                "Chiltiupán",
                "Ciudad Arce",
                "Colón",
                "Comasagua",
                "Huizúcar",
                "Jayaque",
                "Jicalapa",
                "La Libertad",
                "Santa Tecla",
                "Nuevo Cuscatlán",
                "San Juan Opico",
                "Quezaltepeque",
                "Sacacoyo",
                "San José Villanueva",
                "San Matías",
                "San Pablo Tacachico",
                "Talnique",
                "Tamanique",
                "Teotepeque",
                "Tepecoyo",
                "Zaragoza"
            ];
        } else if (departamento === "Sonsonate") {
            municipios = [
                "Acajutla",
                "Armenia",
                "Caluco",
                "Cuisnahuat",
                "Izalco",
                "Juayúa",
                "Nahuizalco",
                "Nahulingo",
                "Salcoatitán",
                "San Antonio del Monte",
                "San Julián",
                "Santa Catarina Masahuat",
                "Santa Isabel Ishuatán",
                "Santo Domingo de Guzmán",
                "Sonsonate",
                "Sonzacate"
            ];
        } else if (departamento === "La Paz") {
            municipios = [
                "Zacatecoluca",
                "Cuyultitán",
                "El Rosario",
                "Jerusalén",
                "Mercedes La Ceiba",
                "Olocuilta",
                "Paraíso de Osorio",
                "San Antonio Masahuat",
                "San Emigdio",
                "San Francisco Chinameca",
                "San Pedro Masahuat",
                "San Juan Nonualco",
                "San Juan Talpa",
                "San Juan Tepezontes",
                "San Luis La Herradura",
                "San Luis Talpa",
                "San Miguel Tepezontes",
                "San Pedro Nonualco",
                "San Rafael Obrajuelo",
                "Santa María Ostuma",
                "Santiago Nonualco",
                "Tapalhuaca"
            ];
        } else if (departamento === "San Miguel") {
            municipios = [
                "Carolina",
                "Chapeltique",
                "Chinameca",
                "Chirilagua",
                "Ciudad Barrios",
                "Comacarán",
                "El Tránsito",
                "Lolotique",
                "Moncagua",
                "Nueva Guadalupe",
                "Nuevo Edén de San Juan",
                "Quelepa",
                "San Antonio",
                "San Gerardo",
                "San Jorge",
                "San Luis de la Reina",
                "San Miguel",
                "San Rafael Oriente",
                "Sesori",
                "Uluazapa"
            ];


        } else if (departamento === "La Unión") {
            municipios = [
                "La Unión",
                "San Alejo",
                "Yucuaiquín",
                "Conchagua",
                "Intipucá",
                "San José",
                "El Carmen",
                "Yayantique",
                "Bolívar",
                "Meanguera del Golfo",
                "Santa Rosa de Lima",
                "Pasaquina",
                "Anamorós",
                "Nueva Esparta",
                "El Sauce",
                "Concepción de Oriente",
                "Polorós",
                "Lislique"
            ];


        } else if (departamento === "Chalatenango") {
            municipios = [
                "Agua Caliente",
                "Arcatao",
                "Azacualpa",
                "Cancasque",
                "Chalatenango",
                "Citalá",
                "Comapala",
                "Concepción Quezaltepeque",
                "Dulce Nombre de María",
                "El Carrizal",
                "El Paraíso",
                "La Laguna",
                "La Palma",
                "La Reina",
                "Las Flores",
                "Las Vueltas",
                "Nombre de Jesús",
                "Nueva Concepción",
                "Nueva Trinidad",
                "Ojos de Agua",
                "Potonico",
                "San Antonio de la Cruz",
                "San Antonio Los Ranchos",
                "San Fernando",
                "San Francisco Lempa",
                "San Francisco Morazán",
                "San Ignacio",
                "San Isidro Labrador",
                "San Luis del Carmen",
                "San Miguel de Mercedes",
                "San Rafael",
                "Santa Rita",
                "Tejutla"
            ];


        } else if (departamento === "Usulután") {
            municipios = [
                "Alegría",
                "Berlín",
                "California",
                "Concepción Batres",
                "El Triunfo",
                "Ereguayquín",
                "Estanzuelas",
                "Jiquilisco",
                "Jucuapa",
                "Jucuarán",
                "Mercedes Umaña",
                "Nueva Granada",
                "Ozatlán",
                "Puerto El Triunfo",
                "San Agustín",
                "San Buenaventura",
                "San Dionisio",
                "San Francisco Javier",
                "Santa Elena",
                "Santa María",
                "Santiago de María",
                "Tecapán",
                "Usulután"
            ];


        } else if (departamento === "Cuscatlán") {
            municipios = [
                "Cojutepeque",
                "Candelaria",
                "El Carmen",
                "El Rosario",
                "Monte San Juan",
                "Oratorio de Concepción",
                "San Bartolomé Perulapía",
                "San Cristóbal",
                "San José Guayabal",
                "San Pedro Perulapán",
                "San Rafael Cedros",
                "San Ramón",
                "Santa Cruz Analquito",
                "Santa Cruz Michapa",
                "Suchitoto",
                "Tenancingo"
            ];


        } else if (departamento === "Morazán") {
            municipios = [
                "Arambala",
                "Cacaopera",
                "Chilanga",
                "Corinto",
                "Delicias de Concepción",
                "El Divisadero",
                "El Rosario",
                "Gualococti",
                "Guatajiagua",
                "Joateca",
                "Jocoaitique",
                "Jocoro",
                "Lolotiquillo",
                "Meanguera",
                "Osicala",
                "Perquín",
                "San Carlos",
                "San Fernando",
                "San Francisco Gotera",
                "San Isidro",
                "San Simón",
                "Sensembra",
                "Sociedad",
                "Torola",
                "Yamabal",
                "Yoloaiquín"
            ];


        } else if (departamento === "Cabañas") {
            municipios = [
                "Cinquera",
                "Dolores",
                "Guacotecti",
                "Ilobasco",
                "Jutiapa",
                "San Isidro (Cabañas)",
                "Sensuntepeque",
                "Tejutepeque",
                "Victoria"
            ];


        } else if (departamento === "San Vicente") {
            municipios = [
                "Apastepeque",
                "Guadalupe",
                "San Cayetano Istepeque",
                "San Esteban Catarina",
                "San Ildefonso",
                "San Lorenzo",
                "San Sebastián",
                "San Vicente",
                "Santa Clara",
                "Santo Domingo",
                "Tecoluca",
                "Tepetitán",
                "Verapaz"
            ];
        } else if (departamento === "Santa Ana") {
            municipios = [
                "Candelaria de la Frontera",
                "Chalchuapa",
                "Coatepeque",
                "El Congo",
                "El Porvenir",
                "Masahuat",
                "Metapán",
                "San Antonio Pajonal",
                "San Sebastián Salitrillo",
                "Santa Ana",
                "Santa Rosa Guachipilín",
                "Santiago de la Frontera",
                "Texistepeque"
            ];
        } else {
            municipios = []; // Departamento no válido, no hay municipios
        }
        var departamentoSelect = document.getElementById("departamentoRegister");
        departamentoSelect.addEventListener("change", actualizarModelos);

        return municipios;
    }

    function closeAlert() {
        var alert = document.getElementById("error");
        alert.style.display = "none";
    }

    setTimeout(function() {
        closeAlert();
    }, 4000);
</script>