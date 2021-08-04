<?php 
    $conexion = new mysqli("localhost","u415020159_constructora","Constructora*#17", "u415020159_constructora");
    $nombre = $_POST["nombre"];
    $version=  $_POST["version"];
    $fecha=  $_POST["fecha"];

    if ($_FILES["archivo"]) {

        # code...
        $nombre_base = basename($_FILES["archivo"]["name"]);
        $nombre_final = date("m-d-y"). "-" . date("H-i-s"). "-" .$nombre_base;
        $ruta ="entregables/". $nombre_final;
        $subir_archivo=move_uploaded_file($_FILES["archivo"]["tmp_name"], $ruta);
        if ($subir_archivo) {
            # code...
            $insertarSQL = "INSERT INTO entregables2(nombre ,version,fecha,archivo) VALUES  ('$nombre', '$version','$fecha', '$ruta') ";
            $resultado = mysqli_query($conexion, $insertarSQL);
            if ($resultado) {
                # code...
                echo "<script>alert('funciona la vaina'); windows.location='index.html'</script>";


            }else{
                printf("Errormessage:%s\n", mysqli_error($conexion));

            }
        } else{
            echo "Error al subir archivo";
        }

    }
    
    

?>