<?php
include("../conexion.php");

$query="SELECT * FROM reservas WHERE Estado='Cancelado'";
$result=mysqli_query($conx,$query);

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