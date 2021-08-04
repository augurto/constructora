		$(document).ready(function(){
			load(1);
		});

		function load(page){
			var q= $("#q").val();
			var id_p= $("#id_p").val();
			$("#loader").fadeIn('slow');
			$.ajax({
				url:'./ajax/buscar_entregables.php?action=ajax&page='+page+'&q='+q+'&id_p='+id_p,
				 beforeSend: function(objeto){
				 $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
			  },
				success:function(data){
					$("#outer_div").html(data).fadeIn('slow');
					$('#loader').html('');
					
				}
			})
		}

		
			function eliminar (id)
		{
			var q= $("#q").val();
		if (confirm("Realmente deseas eliminar el programa")){	
		$.ajax({
        type: "GET",
        url: "./ajax/buscar_programas.php",
        data: "id="+id,"q":q,
		 beforeSend: function(objeto){
			$("#resultados").html("Mensaje: Cargando...");
		  },
        success: function(datos){
		$("#resultados").html(datos);
		load(1);
		}
			});
		}
		}
		
		
	
$( "#guardar_programa" ).submit(function( event ) {
  $('#guardar_datos').attr("disabled", true);
  
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "ajax/nuevo_programa.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados_ajax").html("Mensaje: Cargando...");
			  },
			success: function(datos){
			$("#resultados_ajax").html(datos);
			$('#guardar_datos').attr("disabled", false);
			load(1);
		  }
	});
  event.preventDefault();
})

$( "#editar_programa" ).submit(function( event ) {
  $('#actualizar_datos').attr("disabled", true);
  
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "ajax/editar_programa.php",
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
			var programa = $("#programa"+id).val();
			var grupo = $("#grupo"+id).val();
				var estado = $("#estado"+id).val();
			$("#mod_programa").val(programa);
			$("#mod_estado").val(estado);
			$("#mod_grupo").val(grupo);
			$("#mod_id").val(id);
		
		}
	
		
		

