<?php
session_start();
if(!isset($_SESSION['usuario'])){
    echo "<script>alert('Debes iniciar sesion');location='/hj/view/login.php';</script>";
    session_destroy();
    die();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="shortcut icon" href="/hj/images/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="/hj/css/inicio.css">
    <link rel="stylesheet" href="/hj/css/header.css">
    <title>Huevos Jireth | Misión y Visión</title>
</head>
<body style="background-color:rgb(221, 219, 219);">
<nav class="navbar navbar-expand-lg fixed-top p-0">
        <div class="container-fluid">
            <a class="navbar-brand" href="/hj/view/client/user.php">
                <img src="/hj/images/icon.png" alt="HuevosJireth" height="50" style="margin: 0 5px;">
                <span style="color:red;" class="p-0 m-0">Huevos Jireth</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <i class='bx bx-user-circle icon' style="line-height: 67px; color:black;"></i>
                        <a class="nav-link" style="color:black; text-decoration:none"><?php echo $_SESSION['usuario'] ?></a>
                    </li>
                    <li class="nav-item cs">
                        <a class="nav-link selector" style="color:red;" href="/hj/model/close_session.php">Cerrar Sesión</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section id="mision">
        <div class="nmivi"><br>
            <h1>MISIÓN Y VISIÓN</h1><br>
        </div>
        <div class="misionvision">
            <div class="mision" style="background-color: white;">
                <h1>MISIÓN</h1>
                <p>Satisfacer y suplir la necesidad de nuestros clientes, en el segmento del marcando en cuanto a la comercializacion de huevos de calidad, bajo precio y eficiencia en la entrega del producto.</p>
            </div>
            <div class="vision" style="background-color: white;">
                <h1>VISIÓN</h1>
                <p>Queremos ser una empresa responsable y reconocida y confiable que cumpla con la expectativas de nuestros clientes</p>
            </div>
        </div>
    </section>
    <?php include("../../view/template/footer.php")?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>