		$(document).ready(function(){
			load(1);
		});

		function load(page){
			var q= $("#q").val();
			$("#loader").fadeIn('slow');
			$.ajax({
				url:'./ajax/buscar_miembros.php?action=ajax&page='+page+'&q='+q,
				 beforeSend: function(objeto){
				 $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
			  },
				success:function(data){
					$(".outer_div").html(data).fadeIn('slow');
					$('#loader').html('');
					
				}
			})
		}
	
$( "#guardar_miembros" ).submit(function( event ) {
  $('#guardar_datos').attr("disabled", true);
  var idm=$('#email_m').val();
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "ajax/nuevo_miembro.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados_ajax").html("Mensaje: Cargando...");
			  },
			success: function(datos){
			$("#resultados_ajax").html(datos);
			$.post("PHPMailer/send_acceso.php", {username: idm});
			$('#guardar_datos').attr("disabled", false);
			
	document.getElementById("guardar_miembros").reset();
			load(1);
		  }
	});
  event.preventDefault();
})

$( "#editar_estudiante" ).submit(function( event ) {
  $('#actualizar_datos').attr("disabled", true);
  
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "ajax/editar_miembro.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados_ajax2").html("Mensaje: Cargando...");
			  },
			success: function(datos){
			$("#resultados_ajax2").html(datos);
			$('#actualizar_datos').attr("disabled", false);
			load(1);
		  }
	});
  event.preventDefault();
})

	function obtener_datos(id){
			var nombre = $("#nombre"+id).val();
			var apellidos = $("#apellidos"+id).val();
			var cedula = $("#cedula"+id).val();
			var estado = $("#estado"+id).val();
			var rol = $("#rol"+id).val();
			var grupo = $("#grupo"+id).val();
			var email = $("#email"+id).val();
			
			$("#mod_nombre").val(nombre);
			$("#mod_email").val(email);
			$("#mod_apellidos").val(apellidos);
			$("#mod_cedula").val(cedula);
			$("#mod_rol").val(rol);
			$("#mod_estado").val(estado);
			$("#mod_id").val(id);
			$("#mod_grupo").val(grupo);
			
		
		}

		function eliminar (id)
		{
				swal({
  title: "Realmente deseas eliminar el miembro?",
  text: "Una vez eliminado, no volveras a ver el miembro",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {

  if (willDelete) {
    swal("Miembro eliminado exitosamente", {
      icon: "success",
    });
        $.ajax({
        type: "GET",
        url: "./ajax/buscar_miembros.php",
        data: "id="+id,
		 beforeSend: function(objeto){
			$("#resultados").html("Mensaje: Cargando...");
		  },
        success: function(datos){
		$("#resultados").html(datos);
		load(1);
		}
			});
  } else {
  
  }
});
		}
	
		
		

