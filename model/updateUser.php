<?php

include ("conexion.php");

$correo = $_POST["correo"];
$id = $_POST["id"];

$update = "UPDATE usuarios SET Correo = '$correo' WHERE idUsuario = '$id'";
$updtusu = mysqli_query($conx, $update);



if(isset($updtusu)){
    echo "<script>alert('Registro actualizado');window.location='/hj/view/client/user-email.php';</script>";
}else{
    echo "<script>alert('Error al actualizar este registro');window.history.go(-1)</script>";
}
?>