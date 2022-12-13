<?php
session_start();
include ("conexion.php");
include ("swal.php");

$nombre=$_POST["user"];
$contraseña=$_POST["password"];
$contraseña=hash('sha512',$contraseña);
$read=mysqli_query($conx, "SELECT * FROM usuarios WHERE Nombre='".$nombre."' and Contraseña='".$contraseña."'");
$result=mysqli_fetch_array($read);

if($result["idRol"]==1){
    $_SESSION['usuario']=$nombre;
    header ("location:../view/admin/admin-home.php");
}else
if($result["idRol"]==2){
    $_SESSION['usuario']=$nombre;
    header ("location:../view/client/user.php");
}else{
    echo "<script>Swal.fire({
        title: 'Hubo un problema',
        text: 'Nombre o contraseña incorrecta',
        icon: 'error',
        confirmButtonColor: '#d33',
        confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                window.history.go(-1);
            }
        })
    </script>";
}