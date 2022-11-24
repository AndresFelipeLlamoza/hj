<?php
include("../../model/conexion.php");
session_start();
if (!isset($_SESSION['usuario'])) {
    echo "<script>alert('Debes iniciar sesion');location='/hj/view/login.php';</script>";
    session_destroy();
    die();
}
$query = "SELECT * FROM productos";
$ok = mysqli_query($conx, $query);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="/hj/css/dshbadmin.css">
    <link rel="shortcut icon" href="/hj/images/icon.png" type="image/x-icon">
    <title>Panel de Control (Productos) | Huevos Jireth</title>
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
            <h2 class="title-header">Productos</h2>
            <hr>
        </div>
        <br>
        <!--TABLA DE PRODUCTOS-->
        <div class="table-responsive">
            <table class="table table-secondary table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Descripción</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($ok)) { ?>
                        <tr>
                            <td><?php echo $row["Nombre"] ?></td>
                            <td><?php echo $row["Precio"] ?></td>
                            <td><?php echo $row["Cantidad"] ?></td>
                            <td><?php echo $row["Descripcion"] ?></td>
                            <td>
                                <a href="/hj/view/admin/admin-product-edit.php?id=<?php echo $row["idProducto"] ?>">
                                    <button class="btn btn-success btn-sm" title="Editar">
                                        <i class='bx bxs-pencil'></i>
                                    </button>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </section>

    <script src="/hj/js/menu.js"></script>
</body>

</html>