<?php
include ("conexion.php");
if(isset($_POST)){
    if(strlen($_POST['pass1'])>=1 && strlen($_POST['pass2'])>=1 && strlen($_POST['id'])>=1){
        $id=trim($_POST['id']);
        $pass1=trim($_POST['pass1']);
        $pass2=trim($_POST['pass2']);
        $pass1=hash('sha512',$pass1);
        $pass2=hash('sha512',$pass2);

        $query="UPDATE usuarios SET Contraseña='$pass2' WHERE idUsuario='$id'";
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