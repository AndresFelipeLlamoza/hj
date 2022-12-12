<?php
include("../../model/conexion.php");
session_start();
if (!isset($_SESSION['usuario'])) {
    echo "<script>alert('Debes iniciar sesion');location='/hj/view/login.php';</script>";
    session_destroy();
    die();
}
$id = $_GET["id"];
$query = "SELECT * FROM productos WHERE idProducto='$id'";
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
    <link rel="stylesheet" href="../../package/dist/sweetalert2.min.css">
    <script src="../../js/jquery-3.6.1.min.js"></script>
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
        <div class="text">
            <br>
            <div>
                <h2>Editar Producto</h2>
            </div>
            <!--TABLA DE PRODUCTOS-->
            <?php while ($row = mysqli_fetch_assoc($ok)) { ?>
                <form method="post">
                    <div class="mb-3 row">
                        <div class="col-sm-10">
                            <input id="idp" type="hidden" class="form-control" value="<?php echo $row["idProducto"] ?>" name="id" readonly>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label">Nombre</label>
                        <div class="col-sm-10">
                            <input id="nombreP" type="text" class="form-control" value="<?php echo $row["Nombre"] ?>" name="name" onkeypress="return sololetras(event)">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label">Precio</label>
                        <div class="col-sm-10">
                            <input id="precioP" type="number" maxlength="5" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="form-control" value="<?php echo $row["Precio"] ?>" name="price" onkeypress="return solonumeros(event)">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label">Cantidad en panales</label>
                        <div class="col-sm-10">
                            <input id="cantidadP" type="number" maxlength="3" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="form-control" value="<?php echo $row["Cantidad"] ?>" name="amount" onkeypress="return solonumeros(event)">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label">Descripción</label>
                        <div class="col-sm-10">
                            <input id="descP" type="text" class="form-control" value="<?php echo $row["Descripcion"] ?>" name="desc">
                        </div>
                    </div>
                    <div class="footer-buttons">
                        <button id="ap" type="submit" class="btn btn-success btn-sm">Actualizar</button>
                        <button type="button" class="btn btn-danger btn-sm" onclick="window.history.back(-1)">Cancelar</button>
                    </div>
                </form>
            <?php } ?>
        </div>
    </section>

    <script src="/hj/js/menu.js"></script>
    <script src="../../package/dist/sweetalert2.all.js"></script>
    <script src="../../package/dist/sweetalert2.all.min.js"></script>
    <script type="text/javascript">
        $(function() {
            $('#ap').click(function(e) {
                var valid = this.form.checkValidity();

                if (valid) {
                    var id = $('#idp').val();
                    var producto = $('#nombreP').val();
                    var precio = $('#precioP').val();
                    var cantidad = $('#cantidadP').val();
                    var descripcion = $('#descP').val();

                    e.preventDefault();

                    /*---VALIDACIONES---*/
                    /*NOMBRE*/
                    if (producto === "") {
                        swal.fire({
                            position: 'center',
                            icon: 'warning',
                            title: 'Introduzca el nombre del producto',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        return false;
                    } else if (producto.length < 15) {
                        swal.fire({
                            position: 'center',
                            icon: 'warning',
                            title: 'El nombre es corto',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        return false;
                    } else if (producto.length > 20) {
                        swal.fire({
                            position: 'center',
                            icon: 'warning',
                            title: 'El nombre es muy largo',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        return false;
                    }

                    /*PRECIO*/
                    if (precio === "") {
                        swal.fire({
                            position: 'center',
                            icon: 'warning',
                            title: 'Introduzca el precio',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        return false;
                    } else if (precio.length < 4) {
                        swal.fire({
                            position: 'center',
                            icon: 'warning',
                            title: 'El precio debe ser mayor de 3 digitos',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        return false;
                    } else if (precio > 30000) {
                        swal.fire({
                            position: 'center',
                            icon: 'warning',
                            title: 'El precio no debe superar de los $30.000',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        return false;
                    }

                    /*CANTIDAD*/
                    if (cantidad === "") {
                        swal.fire({
                            position: 'center',
                            icon: 'warning',
                            title: 'Introduzca la cantidad',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        return false;
                    } else if (cantidad > 300) {
                        swal.fire({
                            position: 'center',
                            icon: 'warning',
                            title: 'La cantidad no debe superar a los 300',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        return false;
                    }

                    /*DESCRIPCION*/
                    if (descripcion === "") {
                        swal.fire({
                            position: 'center',
                            icon: 'warning',
                            title: 'Introduzca la descripción',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        return false;
                    } else if (descripcion.length < 18) {
                        swal.fire({
                            position: 'center',
                            icon: 'warning',
                            title: 'La descripción es corta',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        return false;
                    } else if (descripcion.length > 300) {
                        swal.fire({
                            position: 'center',
                            icon: 'warning',
                            title: 'La descripción es demasiada larga',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        return false;
                    }

                    $.ajax({
                        type: 'POST',
                        url: '../../model/update-product.php',
                        data: {
                            id: id,
                            producto: producto,
                            precio: precio,
                            cantidad: cantidad,
                            descripcion: descripcion
                        },
                        success: function(data) {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Producto Actualizado',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(function() {
                                window.location = '../../view/admin/admin-products.php';
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