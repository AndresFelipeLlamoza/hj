<?php
include("../model/conexion.php");

$id=$_POST["idrsv"];
$price="SELECT * FROM productos WHERE Nombre='$id'";
$result=mysqli_query($conx,$price);

$html="<option value=''></option>";

while($row=$result->fetch_assoc())
{
    $html="<option value='".$row["Precio"]."'>".$row["Precio"]."</option>";
}
echo $html;
?>