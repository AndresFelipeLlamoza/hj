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
    <title>Huevos Jireth | Huevos Turcos</title>
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
                <h1>HUEVOS TURCOS</h1>
            </div>
            <div class="imge">
                <img src="/hj/images/turcos1.jpg" alt="Sándwich de aguacate y huevo">
                <img src="/hj/images/turcos2.jfif" alt="Sándwich de aguacate y huevo">
            </div>
            <br>
            <div class="ingre">
                <H3>Ingredientes</H3>
                <ul>
                    <li>1 cebolla</li>
                    <li>2 dientes de ajo</li>
                    <li>1 pimiento rojo</li>
                    <li>1 pimiento verde</li>
                    <li>3 o 4 huevos cocidos</li>
                    <li>1 huevo fresco</li>
                    <li>1 tomate</li>
                    <li>100ml de leche</li>
                    <li>100g de queso para fundir</li>
                    <li>40g de queso viejo</li>
                    <li>Orégano seco</li>
                    <li>Pimentón</li>
                    <li>Sal y pimienta</li>
                    <li>Aceite</li>
                </ul>
            </div>
            <div class="text">
                <h3>Elaboración</h3>
                <p>En una sartén amplia, ponemos un chorrito de aceite y lo calentamos a temperatura media. Cuando esté caliente, añadimos los dientes de ajo, la cebolla, el pimiento rojo y el pimiento verde. Todos ellos cortados en cubos. Salpimentamos y dejamos cocinar alrededor de unos 15 minutos mientras removemos bien todos estos ingredientes.<br> <br>
                    Pasado este tiempo, cuando la verdura esté blandita, la extendemos por toda la superficie de la sartén. <br> <br>
                    Mientras tanto, seguimos con la elaboración de nuestros huevos turcos. En un bol, ponemos un huevo y lo batimos brevemente. Añadimos 100ml de leche. Batimos nuevamente para que se integre la leche con el huevo. Añadimos esta mezcla en la sartén junto con las verduras y nos aseguramos que se extienda bien por toda la superfie de la sartén.<br> <br>
                    Hecho esto, espolvoreamos por toda la superficie de nuestros huevos turcos, orégano seco y pimentón (el pimentón puede ser dulce o picante, a tu elección). Ponemos nuevamente queso para fundir sobre toda la superficie y añadimos además un poco de queso curado- un queso viejo, fuerte, con sabor. Tapamos la sartén y dejamos que se cocine todo durante unos 10 minutos a temperatura muy suave.<br> <br>
                    Pasados estos 10 minutos, destapamos y espolvoreamos nuevamente con orégano. Servimos inmediatamente.
                </p>
            </div>
            <center>
                <button class="btn btn-info" onclick=(window.history.back(-1))>Regresar</button>
            </center>
        </div>
    </div>
    <?php include("../../view/template/footer.php") ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>