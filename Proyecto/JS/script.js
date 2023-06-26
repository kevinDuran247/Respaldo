

$(document).ready(function(){
	var formInputs = $('input[type="email"],input[type="password"]');
	formInputs.focus(function() {
       $(this).parent().children('p.formLabel').addClass('formTop');
       $('div#formWrapper').addClass('darken-bg');
       $('div.logo').addClass('logo-active');
	});
	formInputs.focusout(function() {
		if ($.trim($(this).val()).length == 0){
		$(this).parent().children('p.formLabel').removeClass('formTop');
		}
		$('div#formWrapper').removeClass('darken-bg');
		$('div.logo').removeClass('logo-active');
	});
	$('p.formLabel').click(function(){
		 $(this).parent().children('.form-style').focus();
	});
});



// Script para a la alerta y para el proceso del formulario
$(document).ready(function() {
	$('#Login').on('submit', function(e) {
	  e.preventDefault(); // Evita el comportamiento de envío predeterminado del formulario
  
	  var email = $('#email').val();
	  var password = $('#password').val();
  
	  if (email === '' || password === '') {
		// Muestra la alerta sin recargar la página
		$('#alert').html('<span class="closebtn" onclick="closeAlert()">&times;</span>RELLENE LOS CAMPOS VACIOS').addClass('error').show();
  
		var tiempoDesaparicion = 2000;
  
		// Ocultar la alerta después del tiempo especificado
		setTimeout(function() {
		  $('#alert').hide();
		}, tiempoDesaparicion);
  
	  } else {
		window.location.href = 'Controllers/UserControllers/ValidateUser.php?email=' + encodeURIComponent(email) + '&password=' + encodeURIComponent(password);
	  }
	});
  });

  function closeAlert() {
	var alert = document.getElementById("error");
	alert.style.display = "none";
  }
  
  setTimeout(function() {
	closeAlert();
  }, 4000);

  
  

 







  
  