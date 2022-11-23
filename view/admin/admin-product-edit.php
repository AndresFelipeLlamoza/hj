<?php
include ("../../model/conexion.php");
session_start();
if(!isset($_SESSION['usuario'])){
    echo "<script>alert('Debes iniciar sesion');location='/hj/view/login.php';</script>";
    session_destroy();
    die();
}
$id=$_GET["id"];
$query="SELECT * FROM productos WHERE idProducto='$id'";
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
    <link rel="stylesheet" href="/hj/css/dshbadmin.css">
    <link rel="shortcut icon" href="/hj/images/icon.png" type="image/x-icon">
    <script src="/hj/js/validation.js"></script>
    <title>Panel de Control (Editar Producto) | Huevos Jireth</title>
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
        <div class="text">
            <br>
            <div>
                <h2>Editar Producto</h2>
            </div>
            <!--TABLA DE PRODUCTOS-->
            <?php while($row=mysqli_fetch_assoc($ok)) { ?>
            <form action="../../model/update-product.php" method="post" onsubmit="return product(event)">
                <div class="mb-3 row">
                    <div class="col-sm-10">
                        <input type="hidden" class="form-control" value="<?php echo $row["idProducto"]?>" name="id" readonly>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Nombre</label>
                    <div class="col-sm-10">
                        <input id="nombreP" type="text" class="form-control" value="<?php echo $row["Nombre"]?>" name="name" onkeypress="return sololetras(event)">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Precio</label>
                    <div class="col-sm-10">
                        <input id="precioP" type="text" maxlength="5" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="form-control" value="<?php echo $row["Precio"]?>" name="price" onkeypress="return solonumeros(event)">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Cantidad</label>
                    <div class="col-sm-10">
                        <input id="cantidadP" type="text" maxlength="3" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="form-control" value="<?php echo $row["Cantidad"]?>" name="amount" onkeypress="return solonumeros(event)">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Descripción</label>
                    <div class="col-sm-10">
                        <input id="descP" type="text" class="form-control" value="<?php echo $row["Descripcion"]?>" name="desc">
                    </div>
                </div>
                <div class="footer-buttons">
                    <button type="submit" class="btn btn-success btn-sm">Actualizar</button>
                    <a style="text-decoration: none;" href="/hj/view/admin/admin-products.php">
                        <button type="button" class="btn btn-danger btn-sm">Cancelar</button>
                    </a>
                </div>
            </form>
            <?php } ?>
        </div>
    </section>

    <script src="/hj/js/menu.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>