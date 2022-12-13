<?php
include ("conexion.php");
include ("swal.php");

$nombre=$_POST["user"];
$correo=$_POST["email"];
$contraseña=$_POST["password"];
$contraseña=hash('sha512',$contraseña);

if(repeatname($nombre,$conx)==1){
    echo "<script>Swal.fire({
            title: 'Hubo un problema',
            text: 'El nombre ya está en uso, intente probar con otro',
            icon: 'error',
            confirmButtonColor: '#d33',
            confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.history.go(-1);
                }
            })
        </script>";
}else{
    $create="INSERT INTO usuarios (Nombre,Correo,Contraseña) VALUES ('$nombre','$correo','$contraseña')";
    echo $result=mysqli_query($conx,$create);
}

function repeatname($nombre,$conx){
    include("swal.php");
    $sql="SELECT * FROM usuarios WHERE Nombre='$nombre'";
    $ok=mysqli_query($conx,$sql);

    if(mysqli_num_rows($ok)>0){
        return 1;
    }else{
        echo "<script>Swal.fire({
            title: 'Exito',
            text: 'Usuario Registrado',
            icon: 'success',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location='/hj/view/login.php';
                }
            })
        </script>";
    }
}
?>