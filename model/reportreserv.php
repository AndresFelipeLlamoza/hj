<?php
require('fpdf.php');
include ('conexion.php');

if(strlen($_GET['desde'])>0 && strlen($_GET['hasta'])>0 && strlen($_GET['producto'])>0){
    $desde = $_GET['desde'];
    $hasta = $_GET['hasta'];
    $prod = $_GET['producto'];

    $verDesde = date('d-m-y', strtotime($desde));
    $verHasta = date('d-m-y', strtotime($hasta));
}else{
    $desde = '1111-01-01';
    $hasta = '9999-12-30';

    $verDesde = '___/__/____';
    $verHasta = '___/__/____';
    
}

$consulta = "SELECT * FROM reservas WHERE Estado='Retirado' AND Fecha BETWEEN '$desde' AND '$hasta' AND Producto='$prod'";
$resultado = mysqli_query($conx, $consulta);
$total=0;
$consulta2 = "SELECT Producto, SUM(Total) AS final FROM reservas WHERE Estado='Retirado' AND Fecha BETWEEN '$desde' AND '$hasta' AND Producto='$prod'";
$resultado2 = mysqli_query($conx, $consulta2);
$resultado3=mysqli_fetch_assoc($resultado2);

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    $this->Image('../images/logo.png',10,2,45,0,'PNG');    
    // Arial bold 15
    $this->SetFont('Arial','',15);
    // Movernos a la derecha
    $this->Cell(65);
    // Título
    $this->Cell(70,10,'Reporte de las reservas retiradas',0,0,'C');
     // Salto de línea
    $this->Ln(10);
    $this->Cell(67,10,'',0,0,'A');
    $this->Cell(180,10,date($_GET['desde']).'  -  '.date($_GET['hasta']),0,0,'A');
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
    $pdf->Cell(20, 10,$row['Precio'], 1, 0, 'C', 0);
    $pdf->Cell(25, 10, $row['Cantidad'], 1, 0, 'C', 0);
    $pdf->Cell(20, 10, $row['Total'], 1, 0, 'C', 0);
    $pdf->Cell(30, 10, date('d-m-y', strtotime($row['Fecha'])), 1, 0, 'C', 0);
    $pdf->Cell(30, 10, $row['Estado'], 1, 1, 'C', 0);
    $total=$total+$resultado3['final'];
    
}
$pdf->Cell(70,40,'Ganancias totales: $',0,0,'C');
$pdf->Cell(1,40,$resultado3['final'],0,0,'C');
    

$pdf->Output();
?>