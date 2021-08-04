<div>

            <?php
            //Creamos Nuestra Función
            $codigo="1";
                    //Creamos Nuestra Función
                    function listFiles($directorio){ //La función recibira como parametro un directorio
                    if (is_dir($directorio)) { //Comprobamos que sea un directorio Valido
                    if ($dir = opendir($directorio)) {//Abrimos el directorio
                    echo '<ul>'; //Abrimos una lista HTML para mostrar los archivos
                    while (($archivo = readdir($dir)) !== false){ //Comenzamos a leer archivo por archivo
                    if ($archivo != '.' && $archivo != '..'){//Omitimos los archivos del sistema . y ..
                    $nuevaRuta = $directorio.$archivo.'/';//Creamos unaruta con la ruta anterior y el nombre del archivo actual 
                    echo '<li>'; //Abrimos un elemento de lista 
                    if (is_dir($nuevaRuta)) { //Si la ruta que creamos es un directorio entonces:
                    echo '<b>'.$nuevaRuta.'</b>'; //Imprimimos la ruta completa resaltandola en negrita
                    listFiles($nuevaRuta);//Volvemos a llamar a este metodo para que explore ese directorio.
                    } else { //si no es un directorio: 
                    
                    //echo 'Archivo: '.$archivo; //simplemente imprimimos el nombre del archivo actual
                    $ruta_archivo = $directorio.$codigo.'/'.$archivo.""; //agregamos el $codigo + '/' para especificar la ruta en la que se encuentra el archivo
                    $ruta_carpeta =$codigo;
                    echo "<a href='$ruta_archivo' target='_blank'>Archivo: $archivo</a>";
                    echo "<a href='borrar.php?borrar=$ruta_archivo&reload=$ruta_carpeta' target='_blank'>Eliminar</a>";
                    
                    

                    }
                    '</li>'; //Cerramos el item actual y se inicia la llamada al siguiente archivo
                    }
                    }//finaliza While
                    echo '</ul>';//Se cierra la lista 
                    closedir($dir);//Se cierra el archivo

                    }
                    }else{//Finaliza el If de la linea 12, si no es un directorio valido, muestra el siguiente mensaje
                    echo 'No Existe el directorio';
             /*        echo'	<a href="crear_carpeta.php?codigo='.$_GET["id_p"].'">Crear carpeta</a>'; */
                    
                    
                        
                    }

                    }//Fin de la Función	 
                    //Llamamos a la función y le pasamos el nombre de nuestro directorio.
                    listFiles("1");
            ?>
            </div>