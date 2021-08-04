$(document).ready(function(){
      loadd(1);
         loaddd(1);
      b_inv_info(1);
      b_est_info(1);
    });


function loaddd(page){
  var ce=$('#cx').val();
      var qq= $("#q").val();
      $("#loader").fadeIn('slow');
      $.ajax({
        url:'./ajax/buscar_est.php?action=ajax&page='+page+'&qq='+q+'&ce='+ce,
         beforeSend: function(objeto){
         $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
        },
        success:function(data){
          $(".outer_divinf2").html(data).fadeIn('slow');
          $('#loader').html('');
          
        }
      })
    }

 
function loadd(page){
  var c=$('#cx').val();
      var qq= $("#q").val();
      $("#loader").fadeIn('slow');
      $.ajax({
        url:'./ajax/buscar_inv.php?action=ajax&page='+page+'&qq='+q+'&c='+c,
         beforeSend: function(objeto){
         $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
        },
        success:function(data){
          $(".outer_divinf").html(data).fadeIn('slow');
          $('#loader').html('');
          
        }
      })
    }

function b_inv_info(page){
      var q= $("#q").val();
      var cx= $("#cx").val();
      $.ajax({
        url:'./ajax/b_inv_info.php?action=ajax&page='+page+'&qq='+q+'&c='+cx,
         beforeSend: function(objeto){
         $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
        },
        success:function(data){
          $(".outer_divww").html(data).fadeIn('slow');
          loaddd(1);
           loadd(1);
        }
      })
    }

    function b_est_info(page){
   var q= $("#q").val();
      var cx= $("#cx").val();
      $.ajax({
        url:'./ajax/b_est_info.php?action=ajax&page='+page+'&qq='+q+'&ce='+cx,
         beforeSend: function(objeto){
        },
        success:function(data){
          $(".outer_divyy").html(data).fadeIn('slow');
           loaddd(1);
           loadd(1);
        }
      })
    }

    $( "#guardar_inv" ).submit(function( event ) {
  var parametros = $(this).serialize();
   $.ajax({
      type: "POST",
      url: "ajax/inv.php",
      data: parametros,
       beforeSend: function(objeto){
        },
      success: function(datos){
      $("#resultados2").html(datos);
      $('#guardar_inv').attr("disabled", false);
     b_inv_info(1);

      }
  });
  event.preventDefault();
})

$( "#guardar" ).submit(function( even) {
  var parametros = $(this).serialize();
  var cod=$('#ce').val();

   $.ajax({
      type: "POST",
      url: "ajax/est.php?ce="+cod,
      data: parametros,
       beforeSend: function(objeto){
        $("#resultados3").html("Mensaje: Cargando...");
        },
      success: function(datos){
      $("#resultados3").html(datos);
      $('#guardar').attr("disabled", false);
      b_est_info(1);
      }
  });
  even.preventDefault();
})

     function eliminar (id)
    {
        swal({
  title: "Realmente deseas eliminar el Supervisor?",
  text: "Una vez eliminado, no volveras a ver el Supervisor",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {

  if (willDelete) {
    swal("Supervisor eliminado exitosamente", {
      icon: "success",
    });
        $.ajax({
        type: "GET",
        url: "./ajax/b_inv.php",
        data: "id="+id,
     beforeSend: function(objeto){
      $("#result").html("Mensaje: Cargando...");
      },
        success: function(datos){
    $("#result").html(datos);
     b_inv_info(1);
    }
      });
  } else {
  
  }
});
    }


    function eliminarr (id)
    {
        swal({
  title: "Realmente deseas eliminar el Colaborador?",
  text: "Una vez eliminado, no volveras a ver el Colaborador",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {

  if (willDelete) {
    swal("Colaborador eliminado exitosamente", {
      icon: "success",
    });
        $.ajax({
        type: "GET",
        url: "./ajax/b_est.php",
        data: "id="+id,
     beforeSend: function(objeto){
      $("#result1").html("Mensaje: Cargando...");
      },
        success: function(datos){
    $("#result1").html(datos);
     b_est_info(1);
    }
      });
  } else {
  
  }
});
    }
