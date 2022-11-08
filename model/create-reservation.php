<?php
include("conexion.php");

$user = $_POST["username"];
$product = $_POST["product"];
$price = $_POST["price"];
$cant = $_POST["amount"];
$date = $_POST["date"];
$time = $_POST["time"];
$reserv="INSERT INTO reservas (Cliente,Producto,Precio,Cantidad,Fecha,Hora) VALUES ('$user','$product','$price','$cant','$date','$time')";
$result=mysqli_query($conx,$reserv);
if($result){
    echo "<script>alert('Reserva guardada');window.location='/hj/view/client/user-reserv.php';</script>";
}else{
    echo "<script>alert('No se pudo');window.history.go(-1);</script>";
}

//RESTAR CANTIDAD
$rst="UPDATE productos SET Cantidad=(Cantidad - $cant) WHERE Nombre='$product'";
$ok=mysqli_query($conx,$rst);
if($ok){
    echo "<script>alert('Reserva guardada');window.location='/hj/view/client/user-reserv.php';</script>";
}else{
    echo "<script>alert('No se pudo');window.history.go(-1);</script>";
}
?>