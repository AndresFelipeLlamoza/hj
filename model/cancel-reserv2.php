<?php
include("conexion.php");

//CAMBIAR ESTADO
$id=$_GET["id"];
$cancel="UPDATE reservas SET Estado='Cancelado' WHERE idReserva='$id'";
$check=mysqli_query($conx,$cancel);
if($check){
    header("location:../view/client/user-reserv.php");
}else{
    echo "<script>alert('No se pudo');window.history.go(-1);</script>";
}

//SUMAR CANTIDAD
$id=$_GET["id"];
$c="SELECT Cantidad AS cant FROM reservas WHERE idReserva='$id'";
$cr=mysqli_query($conx,$c);
$cc=mysqli_fetch_assoc($cr);
//
$p="SELECT Producto AS prd FROM reservas WHERE idReserva='$id'";
$pz=mysqli_query($conx,$p);
$px=mysqli_fetch_assoc($pz);
//
$id=$_GET["id"];
$sm="UPDATE productos SET Cantidad=(Cantidad + {$cc["cant"]}) WHERE Nombre='{$px["prd"]}'";
$ok=mysqli_query($conx,$sm);
if($ok){
    header("location:../view/client/user-reserv.php");
}else{
    echo "<script>alert('No se pudo');window.history.go(-1);</script>";
}
?>