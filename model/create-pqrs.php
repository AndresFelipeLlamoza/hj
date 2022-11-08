<?php
include ("conexion.php");

$nombre = $_POST["name"];
$correo = $_POST["email"];
$telefono = $_POST["phone"];
$mensaje = $_POST["message"];

$pqrs = "INSERT INTO mensajes (Nombre, Correo, Telefono, Mensaje) VALUES ('$nombre', '$correo', '$telefono','$mensaje')";
$result = mysqli_query($conx, $pqrs);

if(isset($result)){
    echo "<script>alert('Su mensaje se ha enviado correctamente');window.location='/hj/view/client/user-pqrs.php';</script>";
}else{
    echo "<script>alert('No se realizo el registro');window.history.go(-1)</script>";
}
?>