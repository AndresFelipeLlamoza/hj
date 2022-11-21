<?php
include ("../../model/conexion.php");
session_start();
if(!isset($_SESSION['usuario'])){
    echo "<script>alert('Debes iniciar sesion');location='/hj/view/login.php';</script>";
    session_destroy();
    die();
}
$query="SELECT * FROM usuarios WHERE Nombre='$_SESSION[usuario]'";
$ok=mysqli_query($conx,$query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="/hj/css/dshbuser.css">
    <link rel="shortcut icon" href="/hj/images/icon.png" type="image/x-icon">
    <script src="/hj/js/validation.js"></script>
    <title>PQRS | Huevos Jireth</title>
</head>
<body>
    <nav class="sidebar close">
        <!--LOGO-->
        <header>
            <div class="image-text">
                <span class="image">
                    <a href="/hj/view/client/user.php">
                        <img src="/hj/images/icon.png">
                    </a>
                </span>
                <div class="text logo-text">
                    <span class="name">Huevos Jireth</span>
                </div>
            </div>
            <i class='bx bx-chevron-right toggle'></i>
        </header>

        <!--MENU-->
        <div class="menu-bar">
            <div class="menu">
                <ul class="menu-links">
                    <li class="nav-link">
                        <a href="/hj/view/client/user.php">
                            <i class='bx bx-home icon' title="Inicio"></i>
                            <span class="text nav-text">Inicio</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="/hj/view/client/user-pqrs.php">
                            <i class='bx bx-message-dots icon' title="PQRS"></i>
                            <span class="text nav-text">PQRS</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="/hj/view/client/user-email.php">
                            <i class='bx bx-envelope icon' title="Cambiar correo"></i>
                            <span class="text nav-text">Correo</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="/hj/view/client/user-pass.php">
                            <i class='bx bxs-key icon' title="Cambiar contraseña"></i>
                            <span class="text nav-text">Contraseña</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="/hj/view/client/user-reserv.php">
                            <i class='bx bx-bookmarks icon' title="Mis reservas"></i>
                            <span class="text nav-text">Mis reservas</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!--FOOTER-->
            <div class="bottom-content">
                <li class="nav-link" style="border-bottom: 1px solid red;">
                    <i class='bx bx-user-circle icon' style="color:red;"></i>
                    <span class="text nav-text" style="color:red;"><?php echo $_SESSION['usuario'] ?></span>
                </li>
                <li class="nav-link hola">
                    <a href="/hj/model/close_session.php">
                        <i class='bx bx-log-out icon' style="color:red;"></i>
                        <span class="text nav-text" style="color:red">Cerrar Sesión</span>
                    </a>
                </li>
            </div>
        </div>
    </nav>

    <!--CONTENIDO-->
    <section class="home">
        <div>
            <br>
            <h2 class="title-header">Formulario PQRS</h2>
            <hr>
            <p style="text-align: justify;">Si tienes una pregunta, queja, reclamo o sugerencia, puedes enviar tu inquietud en este formulario y te responderemos por medio de correo electrónico o teléfono.</p>
        </div>
        <!--FORMULARIO PQRS-->
        <div class="dataP">
        <?php while($row=mysqli_fetch_assoc($ok)) { ?>
        <form action="../../model/create-pqrs.php" method="POST" onsubmit="return pqrs(event)">
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" class="form-control" value="<?php echo $row["Nombre"]?>" name="name" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label">Correo</label>
                <input type="email" class="form-control" value="<?php echo $row["Correo"]?>" name="email" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label">Teléfono</label>
                <input id="tel" type="number" maxlength="10" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="form-control" name="phone" onkeypress="return solonumeros(event)">
            </div>
            <div class="mb-3">
                <label class="form-label">Mensaje</label>
                <textarea id="text" class="form-control" rows="5" name="message"></textarea>
            </div>
            <button type="submit" class="btn btn-warning">Enviar</button>
        </form>
        <?php } mysqli_free_result($ok)?>
        </div>
    </section>

    <script src="/hj/js/menu.js"></script>
</body>
</html>