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
    <title>Huevos Jireth | Huevos Benedictos</title>
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
                <h1>HUEVOS BENEDICTOS</h1>
            </div>
            <div class="imge">
                <img src="/hj/images/Bene1.jpg" alt="Huevos A la flamenca">
                <img src="/hj/images/Bene2.jfif" alt="Huevos A la flamenca">
            </div>
            <br>
            <div class="ingre">
                <H3>Ingredientes</H3>
                <ul>
                    <li>5 huevos M</li>
                    <li>4 panecillos</li>
                    <li>4-8 lonchas de bacon</li>
                    <li>125 g. de mantequilla</li>
                    <li>Sal y pimienta negra molida recién molida (al gusto de cada casa)</li>
                    <li>1 cda. zumo limón</li>
                    <li>1 litro de agua</li>
                    <li>1 cucharada de vinagre</li>
                </ul>
            </div>
            <div class="text">
                <h3>Elaboración</h3>
                <p>Untamos las rebanadas de pan con mantequilla y las tostamos ligeramente en una sartén por ambas caras. Recortamos cada rebanada con un molde redondo o un cuchillo para darle forma redonda. Reservamos. <br> <br>

                    En la misma sartén freímos las lonchas de bacon hasta que estén ligeramente crujientes y las retiramos del fuego. Para preparar los huevos escalfados ponemos el agua con el vinagre a hervir en una olla. Cuando esté casi a punto de hervir apagamos el fuego. Añadimos, con mucho cuidado para que no se rompan, los huevos enteros y abiertos. <br> <br>

                    Dejamos que se cocinen en esa agua durante 3 minutos. Con una espumadera los retiramos y los pasamos a un cazo con agua fría. Es mejor no añadir al agua más de uno o dos huevos de cada vez. Así evitaremos que el agua se enfríe demasiado y para facilitar el manejo de los huevos sin romperlos.<br> <br>

                    Cuando tengamos todos los huevos listos montamos el plato. Colocamos la rebanada de pan tostado como base, encima ponemos una o dos lonchas del bacon fritas, el huevo escalfado y como coronación una buena porción de salsa holandesa.<br> <br> </p>
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