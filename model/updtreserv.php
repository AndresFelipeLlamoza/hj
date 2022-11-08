<?php
include ('conexion.php');

$user=$_POST["usuario"];
$product = $_POST["product"];
$price = $_POST["price"];
$amount = $_POST["amount"];

$update = "UPDATE reservas SET Producto='$product', Precio='$price', Cantidad='$amount' WHERE Cliente='$user' ";
$nr = mysqli_query($conx, $update);

if (isset($nr)){
   echo "<script>alert('Reserva actualizada'); window.location='/hj/view/user-home.php';</script>";
}else{
    echo "<script>alert('Error'); window.history.go(-1);</script>";
}

?>