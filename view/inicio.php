<?php
include("../hj/model/conexion.php");
session_start();
if(isset($_SESSION['usuario'])){
    header("location:./view/client/user.php");
}
$products = "SELECT * FROM productos";
$show = mysqli_query($conx, $products);
$I = array(
    "images/bg_huevos1.jpg",
    "images/bg_huevos2.jpg",
    "images/bg_huevos3.jpg",
    "images/bg_huevos4.jpg"
);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="/hj/css/inicio.css">
</head>

<body style="background-color:rgb(221, 219, 219);">
    <!--SLIDER-->
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="/hj/images/huevos1.jpg" class="d-block w-100" alt="Huevos 1">
            </div>
            <div class="carousel-item">
                <img src="/hj/images/huevos2.jpg" class="d-block w-100" alt="Huevos 2">
            </div>
            <div class="carousel-item">
                <img src="/hj/images/huevos3.jpg" class="d-block w-100" alt="Huevos 3">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!--PRODUCTOS-->
    <?php $nImg = 0; ?>
    <section id="productos">
        <h1 class="barrita">PRODUCTOS</h1>
        <div class="productos">
            <?php while ($row = mysqli_fetch_assoc($show)) { ?>
                <div class="pedaso" style="background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.3)), url(<?php echo $I[$nImg]; ?>);">
                    <?php $nImg = $nImg + 1; ?>
                    <h1><?php echo $row["Nombre"] ?></h1>
                    <h4>$<?php echo $row["Precio"] ?></h4>
                    <p style="color: greenyellow">Cantidad disponible: <?php echo $row["Cantidad"] ?> Panales</p>
                    <p><?php echo $row["Descripcion"] ?></p>
                </div>
            <?php }
            mysqli_free_result($show); ?>
        </div>
    </section>

    <!--RESERVAR-->
    <section id="reservar">
        <center>
            <button type="button" class="btn-rsv" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-custom-class="custom-popover" data-bs-title="¡HAZ TU RESERVA YA!" data-bs-content="Para realizar una reserva, debes iniciar sesión o crear una cuenta.">
                Reservar
            </button>
        </center>
    </section>

    <!--RECETAS-->
    <section id="recetas">
        <h1 class="barrita">RECETAS</h1>
        </div>
        <div class="recetas">
            <div class="receta">
                <img src="/hj/images/receta1.jpg" alt="Receta 1">
                <h1>HUEVOS A LA FLAMENCA</h1>
                <a href="/hj/view/receta1.php" class="re">Ver más</a>
            </div>
            <div class="receta">
                <img src="/hj/images/receta2.jpg" alt="Receta 2">
                <h1>HUEVOS BENEDICTOS</h1>
                <a href="/hj/view/receta2.php" class="re">Ver más</a>
            </div>
            <div class="receta">
                <img src="/hj/images/receta3.jpg" alt="Receta 3">
                <h1>HUEVOS CON PURE DE AGUACATE</h1>
                <a href="/hj/view/receta3.php" class="re">Ver más</a>
            </div>
            <div class="receta">
                <img src="/hj/images/receta1.jpg" alt="Receta 4">
                <h1>HUEVOS TURCOS</h1>
                <a href="/hj/view/receta4.php" class="re">Ver más</a>
            </div>
        </div>
    </section>

    <script src="/hj/js/modal-home.js"></script>
</body>

</html>