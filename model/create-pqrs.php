<?php
include ("conexion.php");
if(isset($_POST)){
    if(strlen($_POST['nombre'])>=1 &&
    strlen($_POST['correo'])>=1 &&
    strlen($_POST['telefono'])>=1 &&
    strlen($_POST['mensaje'])>=1){
        $nombre=trim($_POST['nombre']);
        $correo=trim($_POST['correo']);
        $telefono=trim($_POST['telefono']);
        $mensaje=trim($_POST['mensaje']);

        $query="INSERT INTO mensajes (Nombre,Correo,Telefono,Mensaje) VALUES ('$nombre','$correo','$telefono','$mensaje')";
        $result=mysqli_query($conx,$query);
        if($result){
            echo 'Bien';
        }else{
            echo 'Mal';
        }
    }else{
        echo 'No Data';
    }
}
?>