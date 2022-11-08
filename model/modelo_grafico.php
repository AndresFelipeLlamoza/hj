<?php
class Modelo_Grafico
{
    private $conexion;
    function __construct()
    {
        require_once('../config/conexion1.php');
        $this->conexion = new conexion();
        $this->conexion->conectar();
    }

    function TraerDatosGraficoBar()
    {
        $sql = "CALL SP_DATOSGRAFICO_BAR";
        $arreglo = array();
        if ($consulta = $this->conexion->conexion->query($sql)) {

            while ($consulta_VU = mysqli_fetch_array($consulta)) {
                $arreglo[] = $consulta_VU;
            }
            return $arreglo;
            $this->conexion->cerrar();
        }
    }

    function TraerDatosGraficoMas()
    {
        $sql = "CALL SP_DATOSGRAFICO_MAS";
        $arreglo = array();
        if ($consulta = $this->conexion->conexion->query($sql)) {

            while ($consulta_VU = mysqli_fetch_array($consulta)) {
                $arreglo[] = $consulta_VU;
            }
            return $arreglo;
            $this->conexion->cerrar();
        }
    }


    function TraerDatosGraficoCant()
    {
        $sql = "CALL SP_DATOSGRAFICO_CANT";
        $arreglo = array();
        if ($consulta = $this->conexion->conexion->query($sql)) {

            while ($consulta_VU = mysqli_fetch_array($consulta)) {
                $arreglo[] = $consulta_VU;
            }
            return $arreglo;
            $this->conexion->cerrar();
        }
    }


    function TraerDatosGraficoParametro($fechainicio, $fechafin)
    {
        $sql = "CALL SP_DATOSGRAFICO_PARAMETRO_UNIDADES('$fechainicio','$fechafin')";
        $arreglo = array();
        if ($consulta = $this->conexion->conexion->query($sql)) {

            while ($consulta_VU = mysqli_fetch_array($consulta)) {
                $arreglo[] = $consulta_VU;
            }
            return $arreglo;
            $this->conexion->cerrar();
        }
    }



    function TraerDatosGraficoGanancias($fechainicio, $fechafin)
    {
        $sql = "CALL SP_DATOSGRAFICO_PARAMETRO_GANACIAS('$fechainicio','$fechafin')";
        $arreglo = array();
        if ($consulta = $this->conexion->conexion->query($sql)) {

            while ($consulta_VU = mysqli_fetch_array($consulta)) {
                $arreglo[] = $consulta_VU;
            }
            return $arreglo;
            $this->conexion->cerrar();
        }
    }

    
    function TraerDatosGraficoVentas($fechainicio, $fechafin)
    {
        $sql = "CALL SP_DATOSGRAFICO_PARAMETRO_VENTAS('$fechainicio','$fechafin')";
        $arreglo = array();
        if ($consulta = $this->conexion->conexion->query($sql)) {

            while ($consulta_VU = mysqli_fetch_array($consulta)) {
                $arreglo[] = $consulta_VU;
            }
            return $arreglo;
            $this->conexion->cerrar();
        }
    }

}
?>