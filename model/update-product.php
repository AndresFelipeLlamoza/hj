<?php
include("../model/conexion.php");

$id=$_POST["id"];
$name=$_POST["name"];
$price=$_POST["price"];
$cant=$_POST["amount"];
$desc=$_POST["desc"];

$update="UPDATE productos SET idProducto='$id', Nombre='$name', Precio='$price', Cantidad='$cant', Descripcion='$desc' WHERE idProducto='$id'";
$result=mysqli_query($conx,$update);

if($result){
    echo "<script>alert('Producto actualizado');window.location='/hj/view/admin/admin-products.php';</script>";
}else{
    echo "<script>alert('No se pudo actualizar');window.history.go(-1);</script>";
}
?>