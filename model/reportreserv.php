<?php
require('fpdf.php');
include ('conexion.php');
$consulta = "SELECT * FROM reservas WHERE Estado ='Retirado'";
$resultado = mysqli_query($conx, $consulta);
$total=0;
$consulta2 = "SELECT Producto, SUM(Cantidad) FROM reservas WHERE Estado='Retirado'";
$resultado2 = mysqli_query($conx, $consulta2);

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    $this->Image('../images/logo.png',10,2,45,0,'PNG');    
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(65);
    // Título
    $this->Cell(70,10,'Reporte de las reservas',0,0,'C');
     // Salto de línea
    $this->Ln(7);
    $this->Cell(195,10,'Retiradas',0,0,'C');
     // Salto de línea
    $this->Ln(30);
    $this->Cell(65, 10, 'Producto', 1, 0, 'C', 0);
    $this->Cell(20, 10, 'Precio', 1, 0, 'C', 0);
    $this->Cell(25, 10, 'Cantidad', 1, 0, 'C', 0);
    $this->Cell(20, 10, 'Total', 1, 0, 'C', 0);
    $this->Cell(30, 10, 'Fecha', 1, 0, 'C', 0);
    $this->Cell(30, 10, 'Estado', 1, 1, 'C', 0);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetFillColor(255,140,0);
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
}
}


$pdf = new PDF();
$pdf-> AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',16);



foreach ($conx -> query($consulta) as $row){
    

    $pdf->Cell(65, 10,utf8_decode($row['Producto']) , 1, 0, 'C', 0);
    $pdf->Cell(20, 10, $row['Precio'], 1, 0, 'C', 0);
    $pdf->Cell(25, 10, $row['Cantidad'], 1, 0, 'C', 0);
    $pdf->Cell(20, 10, $row['Total'], 1, 0, 'C', 0);
    $pdf->Cell(30, 10, $row['Fecha'], 1, 0, 'C', 0);
    $pdf->Cell(30, 10, $row['Estado'], 1, 1, 'C', 0);
    $total=$total+$row['Total'];
    
}
$pdf->Cell(70,40,'Ganancias totales: $',0,0,'C');
$pdf->Cell(1,40,$total,0,0,'C');
    

$pdf->Output();
?>