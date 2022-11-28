<?php
include("../model/conexion.php");
if(isset($_POST)){
    if(strlen($_POST['id'])>=1 &&
    strlen($_POST['producto'])>=1 &&
    strlen($_POST['precio'])>=1 &&
    strlen($_POST['cantidad'])>=1 &&
    strlen($_POST['descripcion'])>=1){

        $id=$_POST['id'];
        $nombre=$_POST['producto'];
        $precio=$_POST['precio'];
        $cantidad=$_POST['cantidad'];
        $desc=$_POST['descripcion'];

        $query="UPDATE productos SET Nombre='$nombre', Precio='$precio', Cantidad='$cantidad', Descripcion='$desc' WHERE idProducto='$id'";
        $result=mysqli_query($conx,$query);
        if($result){
            echo 'Bien';
        }else{
            echo 'Mal';
        }
    }else{
        echo 'No Data';
    }
}
?>