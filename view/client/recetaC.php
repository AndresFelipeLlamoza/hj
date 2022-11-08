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
    <link rel="stylesheet" href="/hj/css/recetas.css">
    <link rel="stylesheet" href="/hj/css/header.css">
    <title>Huevos Jireth | Huevos con Pure de Aguacate</title>
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

    <div class="Contenerdor" >
    <div class="recetaC">
        <div class="titulo">
            <h1>HUEVOS CON PURE DE AGUACATE</h1>
        </div>
        <div class="imge">
            <img src="/hj/images/aguacate 1.jpg" alt="Sándwich de aguacate y huevo">
            <img src="/hj/images/aguacate 2.jpg" alt="Sándwich de aguacate y huevo">
        </div>
        <br>
        <div class="ingre">
            <H3>Ingredientes</H3>
            <ul>
                <li>2 rebanadas de pan de molde de centeno</li>
                <li>Medio aguacate</li>
                <li>Una pizca de sal en escamas</li>
                <li>Una pizca de semillas de sésamo negro</li>
                <li>Una pizca de tomate deshidratado en hojuelas</li>
                <li>Una pizca de pimienta negra molida</li>
                <li>5 ml de aceite de oliva virgen extra</li>
                <li>1 huevo campero</li>
            </ul>
        </div>  
        <div class="text">
            <h3>Elaboración</h3>
            <p>Lo primero que tenemos que hacer es poner las 2 rebanadas de pan de molde de centeno a tostar en un grill, o en una tostadora, durante unos minutos.<br> <br>

                Retiramos la piel de la mitad de un aguacate, que estará preferiblemente maduro, y lo cortamos en rodajas no muy gruesas. Las ponemos sobre una de las rebanadas de pan de molde tostado y condimentamos con una pizca de sal en escamas, una pizca de semillas de sésamo negro, 1 pizca de tomate deshidratado en hojuelas y pimienta negra molida.<br> <br>
                
                Echamos en una sartén 5 ml de aceite de oliva virgen extra y, cuando esté caliente, cascamos un huevo y lo hacemos a la plancha procurando que la yema no se cuaje.<br> <br>
                Ponemos el huevo sobre el aguacate y volvemos a condimentar con la mezcla de especias anteriormente citadas. Colocamos la otra rebanada de pan de molde tostado y ya tenemos nuestro sándwich listo para disfrutar. <br> <br>
        </div>
    </div>
    </div>
    <?php include("../../view/template/footer.php") ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>