
  $(document).ready(function(){
  	load();
  })


$( "#guardar_evento" ).submit(function( event ) {
  $('#guardar_datos').attr("disabled", true);
  
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "ajax/addEvent.php",
			data: parametros,
			 beforeSend: function(objeto){
			  },
			success: function(datos){
				$('#guardar_datos').attr("disabled", false);
			  swal("Bien", "Evento se ha guardado correctamente", "success");
			     $('#InsertarCalendario').modal('hide');
			load();
		  }
	});
  event.preventDefault();
})


$( "#guardar_evento1" ).submit(function( event ) {
  $('#guardar_datos1').attr("disabled", true);
  
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "ajax/editEventTitle.php",
			data: parametros,
			 beforeSend: function(objeto){
			  },
			success: function(datos){
				$('#guardar_datos1').attr("disabled", false);
			  swal("Bien", "Accion ejecutada correctamente", "success");
			   $('#editCalendario').modal('hide');
			load();
		  }
	});
  event.preventDefault();
})


function load(){
			$.ajax({
				url:'ajax/calendario.php',
				 beforeSend: function(objeto){
			  },
				success:function(data){
					$("#fc").html(data);			
				}
			})
		}