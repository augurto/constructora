		$(document).ready(function(){
			load(1);
		});

		function load(page){
			var q= $("#q").val();
			$("#loader").fadeIn('slow');
			$.ajax({
				url:'./ajax/buscar_grupos.php?action=ajax&page='+page+'&q='+q,
				 beforeSend: function(objeto){
				 $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
			  },
				success:function(data){
					$(".outer_div").html(data).fadeIn('slow');
					$('#loader').html('');
					
				}
			})
		}


		function eliminar (id)
		{
				swal({
  title: "Realmente deseas eliminar el grupo?",
  text: "Una vez eliminado, no volveras a ver el grupo",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {

  if (willDelete) {
    swal("Grupo eliminado exitosamente", {
      icon: "success",
    });
        $.ajax({
        type: "GET",
        url: "./ajax/buscar_grupos.php",
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
		
		
	
$( "#guardar_grupos" ).submit(function( event ) {
  $('#guardar_datos').attr("disabled", true);
  
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "ajax/nuevo_grupo.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados_ajax").html("Mensaje: Cargando...");
			  },
			success: function(datos){
			$("#resultados_ajax").html(datos);
			$('#guardar_datos').attr("disabled", false);
			
	document.getElementById("guardar_grupos").reset();
			load(1);
		  }
	});
  event.preventDefault();
})

$( "#editar_grupo" ).submit(function( event ) {
  $('#actualizar_datos').attr("disabled", true);
  
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "ajax/editar_grupo.php",
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
				var estado = $("#estado"+id).val();
					var programa = $("#programa"+id).val();
			
	
			$("#mod_nombre").val(nombre);
			$("#mod_programa").val(programa);
				$("#mod_estado").val(estado);
			$("#mod_id").val(id);
		
		}
	
		
		

