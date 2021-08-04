	function comments(id_ent, id_seg){
			$("#ident").val(id_ent);
			$("#id_seg").val(id_seg);
			var id_p=$('#idd_proyecto').val();
  			var id_est=$('#id_est').val();
			comentarios(id_p, id_est, id_seg, id_ent);
		}


$( "#subir_comentario" ).submit(function( event ) {
  $('#guardar_datos').attr("disabled", true);
  var id_p=$('#idd_proyecto').val();
  var id_est=$('#id_est').val();
  var id_seg=$('#id_seg').val();
   var id_ent=$('#ident').val();
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "ajax/nuevo_comments.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados_ajax").html("Mensaje: Cargando...");
			  },
			success: function(datos){
			
			$('#guardar_datos').attr("disabled", false);
			comentarios(id_p, id_est, id_seg, id_ent);
		  }
	});
  event.preventDefault();
})


			function comentarios(id_proyecto, id_estudiante, id_seguimiento, id_entregable){
			$("#loader").fadeIn('slow');
			$.ajax({
				url:'./ajax/comments.php?action=ajax&id_proyecto='+id_proyecto+'&id_estudiante='+id_estudiante+'&id_seguimiento='+id_seguimiento+'&id_entregable='+id_entregable,
				 beforeSend: function(objeto){
				 $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
			  },
				success:function(data){
					$("#card_comentarios").html(data).fadeIn('slow');
					$('#loader').html('');
					
				}
			})
		}


		

