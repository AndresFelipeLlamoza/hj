<?php

include ("conexion.php");

$id = $_POST["id"];
$contraseñaAnterior = $_POST["contraseñaAnterior"];
$contraseñaNueva = $_POST["contraseñaNueva"];
$contraseñaAnterior=hash('sha512',$contraseñaAnterior);
$contraseñaNueva=hash('sha512',$contraseñaNueva);


if ($contraseñaAnterior!=$contraseñaNueva) {
    
    $consulta= "SELECT Contraseña FROM usuarios WHERE idUsuario = '$id'";
    $contraseñaSis = mysqli_query($conx, $consulta);
    $datos = $contraseñaSis->fetch_all();
    

    if($contraseñaAnterior == $datos[0][0]){
        $update = "UPDATE usuarios SET Contraseña = '$contraseñaNueva' WHERE Contraseña = '$contraseñaAnterior' and idUsuario = '$id'";
        mysqli_query($conx, $update);
        echo "<script>alert('Contraseña actualizada');window.location='/hj/view/client/user-pass.php';</script>";
    }else{
        echo "<script>alert('La contraseña actual no coincide con la que está registrada en el sistema');window.history.go(-1);</script>";
    }
}else {
    echo "<script>alert('Las contraseñas están iguales, deben ser diferentes');window.history.go(-1);</script>";
}
?>