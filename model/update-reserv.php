<?php
include("../model/conexion.php");
if(isset($_POST)){
    if(strlen($_POST['id'])>=1 &&
    strlen($_POST['producto'])>=1 &&
    strlen($_POST['precio'])>=1 &&
    strlen($_POST['cantidad'])>=1 &&
    strlen($_POST['fecha'])>=1 &&
    strlen($_POST['hora'])>=1){
        $id=trim($_POST['id']);
        $producto=trim($_POST['producto']);
        $precio=trim($_POST['precio']);
        $cantidad=trim($_POST['cantidad']);
        $fecha=trim($_POST['fecha']);
        $hora=trim($_POST['hora']);

        $query="UPDATE reservas SET Producto='$producto', Precio='$precio', Cantidad='$cantidad', Fecha='$fecha', Hora='$hora' WHERE idReserva='$id'";
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