<?php
include ("conexion.php");
if(isset($_POST)){
    if(strlen($_POST['id'])>=1 && strlen($_POST['correo'])>=1){
        $id=trim($_POST['id']);
        $correo=trim($_POST['correo']);

        $query="UPDATE usuarios SET Correo='$correo' WHERE idUsuario='$id'";
        $result=mysqli_query($conx,$query);
        if($result){
            echo 'Bien';
        }else{
            echo 'Mal';
        }
        //
        $sql1=mysqli_query($conx,"SELECT Nombre AS nam FROM usuarios WHERE idUsuario='$id'");
        $xx=mysqli_fetch_array($sql1);
        $sql2=mysqli_query($conx,"UPDATE mensajes SET Correo='$correo' WHERE Nombre='{$xx['nam']}'");
        //
    }else{
        echo 'No Data';
    }
}
?>