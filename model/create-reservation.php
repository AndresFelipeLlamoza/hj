<?php
include("conexion.php");
if(isset($_POST)){
    if(strlen($_POST['nombre'])>=1 &&
        strlen($_POST['producto'])>=1 &&
        strlen($_POST['precio'])>=1 &&
        strlen($_POST['cantidad'])>=1 &&
        strlen($_POST['fecha'])>=1 &&
        strlen($_POST['hora'])>=1){
        $nombre=trim($_POST['nombre']);
        $producto=trim($_POST['producto']);
        $precio=trim($_POST['precio']);
        $cantidad=trim($_POST['cantidad']);
        $fecha=trim($_POST['fecha']);
        $hora=trim($_POST['hora']);

        $query="INSERT INTO reservas (Cliente,Producto,Precio,Cantidad,Fecha,Hora) VALUES ('$nombre','$producto','$precio','$cantidad','$fecha','$hora')";
        $result=mysqli_query($conx,$query);
        if($result){
            echo 'bien';
        }else{
            echo 'mal';
        }

        //RESTAR CANTIDAD
        $rst="UPDATE productos SET Cantidad=(Cantidad - $cantidad) WHERE Nombre='$producto'";
        $ok=mysqli_query($conx,$rst);
        if($ok){
            echo "Reserva Guardada";
        }else{
            echo "No se pudo";
        }
    }else{
        echo 'No Data';
    }
}
?>