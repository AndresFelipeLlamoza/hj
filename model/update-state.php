<?php
include("../model/conexion.php");

//CAMBIAR ESTADO//
$id=$_GET["id"];
$v="UPDATE reservas SET Estado='Retirado' WHERE idReserva='$id'";
$result=mysqli_query($conx,$v);

if($result){
    header("location:../view/admin/admin-reservs.php");
}else{
    echo "Error";
}
?>