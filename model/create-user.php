<?php
include ("conexion.php");
if(isset($_POST)){
    if(strlen($_POST['nombre'])>=1 &&
        strlen($_POST['correo'])>=1 &&
        strlen($_POST['contraseña'])>=1){
        $nombre=trim($_POST['nombre']);
        $correo=trim($_POST['correo']);
        $contraseña=trim($_POST['contraseña']);
        $contraseña=hash('sha512',$contraseña);

        $query="INSERT INTO usuarios (Nombre,Correo,Contraseña) VALUES ('$nombre','$correo','$contraseña')";
        $result=mysqli_query($conx,$query);
        if($result){
            echo 'bien';
        }else{
            echo 'mal';
        }
    }else{
        echo 'No Data';
    }
}

// $nombre=$_POST["user"];
// $correo=$_POST["email"];
// $contraseña=$_POST["password"];
// $contraseña=hash('sha512',$contraseña);

// if(repeatname($nombre,$conx)==1){
//     echo "<script>alert('El nombre ya existe');window.history.go(-1)</script>";
// }else{
//     $create="INSERT INTO usuarios (Nombre,Correo,Contraseña) VALUES ('$nombre','$correo','$contraseña')";
//     echo $result=mysqli_query($conx,$create);
// }

// function repeatname($nombre,$conx){
//     $sql="SELECT * FROM usuarios WHERE Nombre='$nombre'";
//     $ok=mysqli_query($conx,$sql);

//     if(mysqli_num_rows($ok)>0){
//         return 1;
//     }else{
//         echo "<script>alert('Usuario Registrado');window.location='/hj/view/login.php'</script>";
//     }
// }
?>