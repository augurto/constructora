		$(document).ready(function(){
			load_profile(1);
		});
function load_profile(){
			$("#loader").fadeIn('slow');
			$.ajax({
				url:'./ajax/load_profile.php',
				 beforeSend: function(objeto){
				 $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
			  },
				success:function(data){
					$("#load_profile").html(data).fadeIn('slow');
					
				}
			})
		}
