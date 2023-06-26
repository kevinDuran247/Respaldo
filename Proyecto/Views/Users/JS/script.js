

function togglePasswordVisibility() {
    var passwordInput = document.getElementById("passwordInput");
    var toggleIcon = document.getElementById("toggleIcon");

    if (passwordInput.getAttribute("type") === "password") {
        passwordInput.setAttribute("type", "text");
        toggleIcon.classList.remove("fa-eye");
        toggleIcon.classList.add("fa-eye-slash");
    } else {
        passwordInput.setAttribute("type", "password");
        toggleIcon.classList.remove("fa-eye-slash");
        toggleIcon.classList.add("fa-eye");
    }
}

    function actualizarModelos() {
        var departamentoSelect = document.getElementById("departamento");
        var modeloSelect = document.getElementById("modelo");
        var departamentoSeleccionado = departamentoSelect.value;
      
        // Limpiar select de modelos
        modeloSelect.innerHTML = '<option value="" selected disabled>Selecciona un municipio</option>';
      
        var municipios = obtenerMunicipios(departamentoSeleccionado);
      
        municipios.forEach(function (municipio) {
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
        }else if(departamento==="La Paz"){
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
        }else if(departamento==="San Miguel"){
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
              

        }else if(departamento==="La Unión"){
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
              

        }else if(departamento==="Chalatenango"){
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
              

        }else if(departamento==="Usulután"){
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
              

        }else if(departamento==="Cuscatlán"){
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
              

        }else if(departamento==="Morazán"){
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
              

        }else if(departamento==="Cabañas"){
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
              

        }else if(departamento==="San Vicente"){
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
        }else if (departamento === "Santa Ana") {
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
          } 
    
        else {
          municipios = []; // Departamento no válido, no hay municipios
        }
        var departamentoSelect = document.getElementById("departamento");
        departamentoSelect.addEventListener("change", actualizarModelos);
      
        return municipios;
      }

      
      
 
