<?php
include("../conexion.php");

$users="SELECT * FROM usuarios WHERE idRol !='1'";
$result=mysqli_query($conx,$users);

if(!$result){
    die("Error");
}else{
    while($data=mysqli_fetch_assoc($result)){
        $arreglo["data"][]=$data;
    };
    echo json_encode($arreglo);
}
mysqli_free_result($result);
mysqli_close($conx);
?>