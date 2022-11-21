<?php
include("../../model/conexion.php");
session_start();
if (!isset($_SESSION['usuario'])) {
    echo "<script>alert('Debes iniciar sesion');location='/hj/view/login.php';</script>";
    session_destroy();
    die();
}
$query = "SELECT * FROM reservas WHERE Estado='Vigente' ORDER BY idReserva DESC";
$result = mysqli_query($conx, $query);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="/hj/css/dshbadmin.css">
    <link rel="shortcut icon" href="/hj/images/icon.png" type="image/x-icon">
    <title>Panel de Control (Reservas) | Huevos Jireth</title>
</head>

<body>
    <nav class="sidebar close">
        <!--LOGO-->
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="/hj/images/icon.png">
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
                        <a href="/hj/view/admin/admin-home.php">
                            <i class='bx bx-home icon' title="Inicio"></i>
                            <span class="text nav-text">Inicio</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="/hj/view/admin/admin-clients.php">
                            <i class='bx bx-user icon' title="Clientes"></i>
                            <span class="text nav-text">Clientes</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="/hj/view/admin/admin-reservs.php">
                            <i class='bx bx-bookmark-minus icon' title="Reservas"></i>
                            <span class="text nav-text">Reservas</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="/hj/view/admin/admin-products.php">
                            <i class='bx bx-box icon' title="Productos"></i>
                            <span class="text nav-text">Productos</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="/hj/view/admin/admin-messages.php">
                            <i class='bx bx-envelope icon' title="Mensajes"></i>
                            <span class="text nav-text">Mensajes</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!--FOOTER-->
            <div class="bottom-content">
                <li class="nav-link">
                    <i class='bx bx-user-circle icon' title="<?php echo $_SESSION['usuario']?>"></i>                        
                    <span class="text nav-text" style="font-size: 12px;"><?php echo $_SESSION['usuario']?></span>
                </li>
                <li class="">
                    <a href="/hj/model/close_session.php">
                        <i class='bx bx-log-out icon' style="color:red" title="Cerrar Sesión"></i>
                        <span class="text nav-text" style="font-size: 12px; color:red">Cerrar Sesión</span>
                    </a>
                </li>
            </div>
        </div>
    </nav>

    <!--CONTENIDO-->
    <section class="home">
        <br>
        <h2 class="title-header">Reservas</h2>
        <hr>
        <br>
        <!--TABLA DE RESERVAS-->
        <div class="table-responsive">
            <table class="table table-warning table-hover">
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo $row["Cliente"] ?></td>
                            <td><?php echo $row["Producto"] ?></td>
                            <td>$<?php echo $row["Precio"] ?></td>
                            <td><?php echo $row["Cantidad"] ?></td>
                            <td>$<?php echo $row["Total"] ?></td>
                            <td><?php echo $row["Fecha"] ?></td>
                            <td><?php echo $row["Hora"] ?></td>
                            <td><?php echo $row["Estado"] ?></td>
                            <td>
                                <a href="../../model/update-state.php?id=<?php echo $row["idReserva"] ?>" style="text-decoration: none;">
                                    <button class="btn btn-warning btn-sm rr">Retirar</button>
                                </a>
                                <a href="../../model/cancel-reserv1.php?id=<?php echo $row["idReserva"] ?>" style="text-decoration: none;">
                                    <button class="btn btn-danger btn-sm cr">Cancelar</button>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <br>
        <!--OTRAS-->
        <hr>
        <p>
            <button class="btn btn-success" type="button" data-bs-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Retiradas</button>
            <button class="btn btn-danger" type="button" data-bs-toggle="collapse" data-bs-target="#multiCollapseExample2" aria-expanded="false" aria-controls="multiCollapseExample2">Canceladas</button>
        </p>
        <div class="row">
            <div class="col">
                <div class="collapse multi-collapse" id="multiCollapseExample1">
                    <div class="card card-body">
                        <table id="reservs-success" class="display compact nowrap" cellspacing="0" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Cliente</th>
                                    <th>Producto</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th>Total</th>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="collapse multi-collapse" id="multiCollapseExample2">
                    <div class="card card-body">
                        <table id="reservs-cancel" class="display compact nowrap" cellspacing="0" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Cliente</th>
                                    <th>Producto</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th>Total</th>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="/hj/js/menu.js"></script>
    <script src="/hj/js/confirmation.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#table-reservs').DataTable({
                "ajax": {
                    "method": "POST",
                    "url": "../../model/query/reservs.php"
                },
                "columns": [{
                        "data": "Cliente"
                    },
                    {
                        "data": "Producto"
                    },
                    {
                        "data": "Precio"
                    },
                    {
                        "data": "Cantidad"
                    },
                    {
                        "data": "Total"
                    },
                    {
                        "data": "Fecha"
                    },
                    {
                        "data": "Hora"
                    },
                    {
                        "data": "Estado"
                    },
                    {
                        "defaultContent": "<button class='btn btn-warning btn-sm'>Retirar</button>  <button class='btn btn-danger btn-sm'>Cancelar</button>"
                    }
                ],
                "language": {
                    "url": 'https://cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json'
                },
                responsive: true
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#reservs-success').DataTable({
                "ajax": {
                    "method": "POST",
                    "url": "../../model/query/successfully.php"
                },
                "columns": [{
                        "data": "Cliente"
                    },
                    {
                        "data": "Producto"
                    },
                    {
                        "data": "Precio"
                    },
                    {
                        "data": "Cantidad"
                    },
                    {
                        "data": "Total"
                    },
                    {
                        "data": "Fecha"
                    },
                    {
                        "data": "Hora"
                    },
                    {
                        "data": "Estado"
                    },
                ],
                "language": {
                    "url": 'https://cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json'
                },
                responsive: true
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#reservs-cancel').DataTable({
                "ajax": {
                    "method": "POST",
                    "url": "../../model/query/cancel.php"
                },
                "columns": [{
                        "data": "Cliente"
                    },
                    {
                        "data": "Producto"
                    },
                    {
                        "data": "Precio"
                    },
                    {
                        "data": "Cantidad"
                    },
                    {
                        "data": "Total"
                    },
                    {
                        "data": "Fecha"
                    },
                    {
                        "data": "Hora"
                    },
                    {
                        "data": "Estado"
                    },
                ],
                "language": {
                    "url": 'https://cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json'
                },
                responsive: true
            });
        });
    </script>
</body>

</html>