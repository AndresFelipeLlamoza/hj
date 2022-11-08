<?php
include("../model/conexion.php");

$id=$_GET["id"];
$delete="DELETE FROM mensajes WHERE idMensaje='$id'";
$result=mysqli_query($conx,$delete);

if($result){
    header("location:../view/admin-messages.php");
}else{
    echo "<script>alert('No se pudo eliminar');window.history.go(-1);</script>";
}
?>