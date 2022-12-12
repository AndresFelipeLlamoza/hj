<?php
include("../../model/conexion.php");
session_start();
if (!isset($_SESSION['usuario'])) {
    echo "<script>alert('Debes iniciar sesion');location='/hj/view/login.php';</script>";
    session_destroy();
    die();
}
//Vigentes
$query1 = "SELECT * FROM reservas WHERE Cliente = '$_SESSION[usuario]' AND Estado = 'Vigente' ORDER BY idReserva DESC";
$result1 = mysqli_query($conx, $query1);
$conteo1 = "SELECT COUNT(*) AS conteo FROM reservas WHERE Cliente = '$_SESSION[usuario]' AND Estado = 'Vigente'";
$check1 = mysqli_query($conx, $conteo1);
$count1 = mysqli_fetch_assoc($check1);

//Retirados
$query2 = "SELECT * FROM reservas WHERE Cliente = '$_SESSION[usuario]' AND Estado = 'Retirado' ORDER BY idReserva DESC";
$result2 = mysqli_query($conx, $query2);
$conteo2 = "SELECT COUNT(*) AS conteo FROM reservas WHERE Cliente = '$_SESSION[usuario]' AND Estado = 'Retirado'";
$check2 = mysqli_query($conx, $conteo2);
$count2 = mysqli_fetch_assoc($check2);

//Cancelados
$query3 = "SELECT * FROM reservas WHERE Cliente = '$_SESSION[usuario]' AND Estado = 'Cancelado' ORDER BY idReserva DESC";
$result3 = mysqli_query($conx, $query3);
$conteo3 = "SELECT COUNT(*) AS conteo FROM reservas WHERE Cliente = '$_SESSION[usuario]' AND Estado = 'Cancelado'";
$check3 = mysqli_query($conx, $conteo3);
$count3 = mysqli_fetch_assoc($check3);
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
    <link rel="stylesheet" href="../../package/dist/sweetalert2.min.css">
    <script src="/hj/js/jquery-3.6.1.min.js"></script>
    <title>Mis Reservas | Huevos Jireth</title>
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
                    <i class='bx bx-user-circle icon' style="color:red;" title="<?php echo $_SESSION['usuario'] ?>"></i>
                    <span class="text nav-text" style="color:red;"><?php echo $_SESSION['usuario'] ?></span>
                </li>
                <li class="nav-link hola">
                    <a href="/hj/model/close_session.php">
                        <i class='bx bx-log-out icon' style="color:red;" title="Cerrar Sesión"></i>
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
            <h2 class="title-header">Mis Reservas</h2>
            <hr>
        </div>
        <!--TICKETS-->
        <!--VIGENTES-->
        <h3 class="t-tk">Vigentes (<?php echo $count1["conteo"] ?>)</h3>
        <div class="ticketv">
            <?php while ($row1 = mysqli_fetch_assoc($result1)) : ?>
                <div class="text-center ticket">
                    <div class="card mb-4 rounded-3 shadow-sm border-warning">
                        <div class="card-header py-2 text-bg-warning border-warning">
                            <h4 class="my-0 fw-normal"><?php echo $row1["Estado"] ?></h4>
                        </div>
                        <div class="card-body">
                            <h2 id="coin" class="card-title pricing-card-title">$<?php echo $row1["Total"] ?></h2>
                            <ul class="list-unstyled mt-3 mb-4">
                                <li><b>Producto</b></li>
                                <li><?php echo $row1["Producto"] ?></li>
                                <li><b>Cantidad</b></li>
                                <li><?php echo $row1["Cantidad"] ?> <?php if ($row1["Cantidad"] == 1) {echo 'Panal';} else {echo 'Panales';} ?></li>
                                <li><b>Fecha</b></li>
                                <li><?php echo $row1["Fecha"] ?></li>
                                <li><b>Hora</b></li>
                                <li><?php echo $row1["Hora"] ?></li>
                            </ul>
                            <a href="../../view/client/user-edit-reserv.php?id=<?php echo $row1["idReserva"] ?>" style="text-decoration: none;">
                                <button type="button" class="btn btn-mb btn-warning">Editar</button>
                            </a>
                            <a id="rcancel" href="../../model/cancel-reserv2.php?id=<?php echo $row1["idReserva"] ?>" style="text-decoration: none;">
                                <button type="button" class="btn btn-mb btn-danger" onclick="cancelar(event)">Cancelar</button>
                            </a>
                            <!-- CANCELACION AUTOMATICA -->
                            <?php
                                $id=$row1["idReserva"];
                                $hoy = date('Y-m-d');
                                $ex = $row1["Fecha"];

                                if ($hoy > $ex) {
                                    $zz=mysqli_query($conx,"UPDATE reservas SET Estado='Cancelado' WHERE idReserva='$id'");
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <script>
                    function cancelar(e) {
                        e.preventDefault();
                        const href = $(this).attr('href')

                        const swalWithBootstrapButtons = Swal.mixin({
                            customClass: {
                                confirmButton: 'btn btn-success',
                                cancelButton: 'btn btn-danger'
                            },
                            buttonsStyling: false
                        })
                        swalWithBootstrapButtons.fire({
                            title: '¿Estás seguro de cancelar la reserva?',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Si',
                            cancelButtonText: 'No',
                            reverseButtons: true
                        }).then((result) => {
                            if (result.isConfirmed) {
                                document.location.href = href,
                                    swalWithBootstrapButtons.fire(
                                        'Cancelado',
                                        'Tu reserva fue cancelada exitosamente',
                                        'success'
                                    )
                                window.location = '../../view/client/user-reserv.php'
                            }
                        })
                        let ret = document.querySelectorAll("#rcancel");
                        for (var i = 0; i < ret.length; i++) {
                            ret[i].addEventListener('click', cancelar);
                        }
                    }
                </script>
            <?php endwhile; ?>
        </div>
        <br>
        <!--RETIRADOS-->
        <h3 class="t-tk">Retirados (<?php echo $count2["conteo"] ?>)</h3>
        <div class="tickets">
            <?php while ($row2 = mysqli_fetch_assoc($result2)) { ?>
                <div class="text-center ticket">
                    <div class="card mb-4 rounded-3 shadow-sm border-success">
                        <div class="card-header py-2 text-bg-success border-success">
                            <h4 class="my-0 fw-normal"><?php echo $row2["Estado"] ?></h4>
                        </div>
                        <div class="card-body">
                            <h2 class="card-title pricing-card-title">$<?php echo $row2["Total"] ?></h2>
                            <ul class="list-unstyled mt-3 mb-4">
                                <li><b>Producto</b></li>
                                <li><?php echo $row2["Producto"] ?></li>
                                <li><b>Cantidad</b></li>
                                <li><?php echo $row2["Cantidad"] ?> <?php if ($row2["Cantidad"] == 1) {
                                                                        echo 'Panal';
                                                                    } else {
                                                                        echo 'Panales';
                                                                    } ?></li>
                                <li><b>Fecha</b></li>
                                <li><?php echo $row2["Fecha"] ?></li>
                                <li><b>Hora</b></li>
                                <li><?php echo $row2["Hora"] ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <br>
        <!--CANCELADOS-->
        <h3 class="t-tk">Cancelados (<?php echo $count3["conteo"] ?>)</h3>
        <div class="tickets">
            <?php while ($row3 = mysqli_fetch_assoc($result3)) { ?>
                <div class="text-center ticket">
                    <div class="card mb-4 rounded-3 shadow-sm border-danger">
                        <div class="card-header py-2 text-bg-danger border-danger">
                            <h4 class="my-0 fw-normal"><?php echo $row3["Estado"] ?></h4>
                        </div>
                        <div class="card-body">
                            <h2 class="card-title pricing-card-title">$<?php echo $row3["Total"] ?></h2>
                            <ul class="list-unstyled mt-3 mb-4">
                                <li><b>Producto</b></li>
                                <li><?php echo $row3["Producto"] ?></li>
                                <li><b>Cantidad</b></li>
                                <li><?php echo $row3["Cantidad"] ?> <?php if ($row3["Cantidad"] == 1) {
                                                                        echo 'Panal';
                                                                    } else {
                                                                        echo 'Panales';
                                                                    } ?></li>
                                <li><b>Fecha</b></li>
                                <li><?php echo $row3["Fecha"] ?></li>
                                <li><b>Hora</b></li>
                                <li><?php echo $row3["Hora"] ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>

    <script src="/hj/js/menu.js"></script>
    <script src="../../package/dist/sweetalert2.all.js"></script>
    <script src="../../package/dist/sweetalert2.all.min.js"></script>
    <script>
        const cop = new Intl.NumberFormat('es-CO', {
            style: 'currency',
            currency: 'COP',
            minimumFractionDigits: 0
        })
    </script>
</body>

</html>