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
    <title>Cambiar Contraseña | Huevos Jireth</title>
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
            <h2 class="title-header">Cambiar Contraseña</h2>
            <hr>
        </div>
        <!--FORM-->
        <div class="dataP">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-dialog form-user">
                    <div class="modal-content">
                        <form action="../../model/updateContra.php" method="POST" onsubmit="return changepassword(event)">
                            <div class="modal-body">
                                <?php foreach ($conx->query("SELECT * from usuarios WHERE Nombre = '" . $_SESSION['usuario'] . "'") as $row) { ?>
                                    <input id="idc" type="hidden" value="<?php echo $row["idUsuario"] ?>" name="id">
                                    <div class="mb-3">
                                        <label class="col-form-label">Contraseña actual</label>
                                        <input id="passA" type="password" class="form-control" name="contraseñaAnterior">
                                    </div>
                                    <div class="mb-3">
                                        <label class="col-form-label">Contraseña nueva</label>
                                        <input id="passB" type="password" class="form-control" name="contraseñaNueva"></input>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="modal-footer justify-content-center">
                                <button id="ac" type="submit" class="btn btn-warning">Cambiar</button>
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
            $('#ac').click(function(e) {
                var valid = this.form.checkValidity();

                if (valid) {
                    var id = $('#idc').val();
                    var pass1 = $('#passA').val();
                    var pass2 = $('#passB').val();

                    e.preventDefault();

                    /*---VALIDACIONES---*/
                    /*PASS1*/
                    if (pass1 === "") {
                        swal.fire({
                            position: 'center',
                            icon: 'warning',
                            title: 'Introduzca la contraseña actual',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        return false;
                    }

                    /*PASS2*/
                    if (pass2 === "") {
                        swal.fire({
                            position: 'center',
                            icon: 'warning',
                            title: 'Digite la nueva contraseña',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        return false;
                    } else if (pass2.length < 5) {
                        swal.fire({
                            position: 'center',
                            icon: 'warning',
                            title: 'La contraseña nueva debe tener mínimo 5 caracteres',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        return false;
                    } else if (pass2.length > 10) {
                        swal.fire({
                            position: 'center',
                            icon: 'warning',
                            title: 'La contraseña debe ser como máximo 10 caracteres',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        return false;
                    }

                    $.ajax({
                        type: 'POST',
                        url: '../../model/update-pass.php',
                        data: {
                            pass1: pass1,
                            pass2: pass2,
                            id:id
                        },
                        success: function(data) {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Contraseña Actualizada',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(function() {
                                window.location = '../../view/client/user-pass.php';
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