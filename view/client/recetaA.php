<?php
session_start();
if (!isset($_SESSION['usuario'])) {
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
    <link rel="stylesheet" href="/hj/css/recetas.css">
    <link rel="stylesheet" href="/hj/css/header.css">
    <title>Huevos Jireth | Huevos a la Flamenca</title>
</head>

<body>
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

    <div class="Contenerdor">
        <div class="recetaC">
            <div class="titulo">
                <h1>HUEVOS A LA FLAMENCA</h1>
            </div>
            <div class="imge">
                <img src="/hj/images/flamenca1.jpg" alt="Huevos A la flamenca">
                <img src="/hj/images/flamenca2.jpeg" alt="Huevos A la flamenca">
            </div>
            <br>
            <div class="ingre">
                <H3>Ingredientes</H3>
                <ul>
                    <li>8 huevos</li>
                    <li>350 ml de salsa de tomate</li>
                    <li>2 lonchas gruesas de jamón serrano (100 g)</li>
                    <li>1 puerro</li>
                    <li>aceite de oliva virgen extra</li>
                    <li>pimienta</li>
                    <li>2 patatas</li>
                    <li>100 g de chorizo ibérico</li>
                    <li>2 dientes de ajo</li>
                    <li>150 g de guisantes (desgranados)</li>
                    <li>sal</li>
                    <li>1 cayena</li>
                </ul>
            </div>
            <div class="text">
                <h3>Elaboración</h3>
                <p>Pon agua a calentar en una cazuela, sazona y cuando empiece a hervir, agrega los guisantes. Cuécelos durante 10-15 minutos. Escurre y resérvalos. <br> <br>

                    Pela las patatas y córtalas en daditos. Retira la primera capa del puerro, retírale la parte inferior y superior, lávalo bien y pícalo en medias lunas. <br> <br>

                    Aplasta los dientes de ajo (déjalos con piel) y rehógalos en una sartén con aceite. Añade las patatas y fríelas un poco. Incorpora el puerro, la cayena, sazona y confítalos (a fuego más suave). Escurre y reserva. <br> <br>

                    Pela el chorizo. Corta el chorizo y el jamón en taquitos. Rehoga la mitad de chorizo y la mitad de jamón en una sartén con aceite. Añade las patatas con los puerros y los guisantes. Cocina todo a fuego suave durante 4-5 minutos y repártelo en 4 cazuelitas de barro. Cúbrelas con la salsa de tomate caliente y casca un par de huevos encima de cada cazuelita. Salpimienta los huevos, coloca alrededor el resto de jamón y del chorizo e introduce las cazuelitas en el horno. Hornéalas hasta que los huevos cuajen (a tu gusto). Retira, sirve y decora con unas hojas de perejil. <br> <br> </p>
            </div>
        </div>
    </div>
    <?php include("../../view/template/footer.php") ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>