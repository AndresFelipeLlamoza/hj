<?php
include("../../model/conexion.php");
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
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="/hj/css/dshbuser.css">
    <link rel="stylesheet" href="/hj/css/personaldata.css">
    <link rel="shortcut icon" href="/hj/images/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../../package/dist/sweetalert2.min.css">
    <script src="../../js/jquery-3.6.1.min.js"></script>
    <title>Cambiar Correo | Huevos Jireth</title>
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
            <h2 class="title-header">Cambiar Correo</h2>
            <hr>
        </div>
        <!--FORM-->
        <div class="dataP">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-dialog form-user">
                    <div class="modal-content">
                        <form method="POST">
                            <div class="modal-body">
                                <?php foreach ($conx->query("SELECT * from usuarios WHERE Nombre = '" . $_SESSION['usuario'] . "'") as $row) { ?>
                                    <input id="idc" type="hidden" value="<?php echo $row["idUsuario"] ?>" name="id">
                                    <div class="mb-3">
                                        <label class="col-form-label">Nuevo correo</label>
                                        <input id="email2" class="form-control" type="email" value="<?php echo $row["Correo"] ?>" name="correo">
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="modal-footer justify-content-center">
                                <button id="cc" type="submit" class="btn btn-warning">Cambiar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="/hj/js/menu.js"></script>
    <script src="../../package/dist/sweetalert2.all.js"></script>
    <script src="../../package/dist/sweetalert2.all.min.js"></script>
    <script type="text/javascript">
        $(function() {
            $('#cc').click(function(e) {
                var valid = this.form.checkValidity();
                var expresion = /\w+@\w+\.+[a-z]/;

                if (valid) {
                    var id = $('#idc').val();
                    var correo = $('#email2').val();

                    e.preventDefault();

                    /*---VALIDACIONES----*/
                    /*CORREO*/
                    if (correo==="") {
                        swal.fire({
                            position: 'center',
                            icon: 'warning',
                            title: 'Digite el correo',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        return false;
                    } else if (!expresion.test(correo)) {
                        swal.fire({
                            position: 'center',
                            icon: 'warning',
                            title: 'El correo debe tener un dominio',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        return false;
                    }

                    $.ajax({
                        type: 'POST',
                        url: '../../model/update-email.php',
                        data: {
                            id: id,
                            correo: correo
                        },
                        success: function(data) {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Correo Actualizado',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(function() {
                                window.location = '../../view/client/user-email.php';
                            });
                        },
                        error: function(data) {
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: 'ERROR',
                                showConfirmButton: true,
                                timer: 1500
                            })
                        }
                    })
                }
            })
        })
    </script>
</body>

</html>