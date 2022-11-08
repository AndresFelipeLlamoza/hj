<?php
    require '../model/modelo_grafico.php';

    $MG = new Modelo_Grafico();
    $consulta = $MG -> TraerDatosGraficoMas();
    echo json_encode($consulta);
?>