<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Audra</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="css/sweetalert.css">
      <link rel="stylesheet" type="text/css" href="css/facebook.css">
</head>

<body class="bg-gradient-primary">

  <div class="container">
    <br>
    <p></p>
    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row" style="background-color: #f0f8ffa8;">
           <!--    <div class="col-lg-6 d-none d-lg-block"><img src="img/logo.png" width="470px" height="520px"></div> -->
              <div class="col-lg-6">
                <br>
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4"><b>Audra</b></h1>
                  </div>
                  <div class="alert alert-danger" id="error" style="display: none;" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>Nombre de usuario o contraseña inválidos.</div>

                  <form class="user" id="login" name="login">
                    <div class="form-group">
                      <label for="exampleInputEmail">Usuario:</label>
                      <input type="text" class="form-control form-control-user" id="exampleInputEmail" name="username" aria-describedby="emailHelp" placeholder="Usuario" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail">Contraseña:</label>
                      <input type="password" class="form-control form-control-user" id="exampleInputPassword" name="password" placeholder="Contraseña" required>
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                <?php if(isset($_GET['session_destroy'])){?>
                  <div th:if="${param.logout}" id="logged"  class="alert alert-success" role="alert">
                Usted ha sido desconectado.
                </div>
              <?php } ?>
                      </div>
                    </div>
                       <button type="submit" class="btn btn-primary btn-user btn-block login" id="login"><i class="fas fa-sign-in-alt"></i>  Iniciar Sesion </button>
                <br>
                <br>
                <br>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>

<script type="text/javascript">
    $( "#login" ).submit(function( even) {
  var parametros = $(this).serialize();
     $.ajax({
            type: "POST",
            url: "ajax/acceso.php",
            data: parametros,
             beforeSend: function(objeto){
                $(".login").html("Cargando...");
              },
            success: function(datos){
                 $(".login").html("<i class='fas fa-sign-in-alt'></i>  Iniciar Sesion");
            if(datos=='1'){
               swal("Bienvenido(a) al sistema", {
      icon: "success",
    });
                location.href="index.php";
            }else{
             swal("El usuario o la contraseña no es valida", {
      icon: "error",
    });
            }
          }
    });
  even.preventDefault();
})

</script>
</html>

