<?php
include("../model/conexion.php");

$id=$_POST["id"];
$producto=$_POST["product"];
$precio=$_POST["price"];
$cantidad=$_POST["amount"];
$fecha=$_POST["date"];
$hora=$_POST["time"];

$update="UPDATE reservas SET Producto='$producto', Precio='$precio', Cantidad='$cantidad', Fecha='$fecha', Hora='$hora' WHERE idReserva='$id'";
$result=mysqli_query($conx,$update);

if($result){
    echo "<script>alert('Reserva Actualizada');window.location='/hj/view/client/user-reserv.php';</script>";
}else{
    echo "<script>alert('No se pudo actualizar');window.history.go(-1);</script>";
}
?>