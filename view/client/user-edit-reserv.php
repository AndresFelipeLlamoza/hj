<?php
include("../../model/conexion.php");
session_start();
if (!isset($_SESSION['usuario'])) {
    echo "<script>alert('Debes iniciar sesion');location='/hj/view/login.php';</script>";
    session_destroy();
    die();
}
$id = $_GET["id"];
$rsv = "SELECT * FROM reservas WHERE idReserva='$id'";
$ok = mysqli_query($conx, $rsv);
//
$np = "SELECT Producto AS nomp FROM reservas WHERE idReserva='$id'";
$npq = mysqli_query($conx, $np);
$npf = mysqli_fetch_assoc($npq);
//
$prd = "SELECT * FROM productos WHERE Nombre !='$npf[nomp]' AND Cantidad>=1";
$ok2 = mysqli_query($conx, $prd);

$hoy = date('Y-m-d');
$max = date('Y-m-d', strtotime($hoy . '+2 days'));
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="/hj/css/dshbuser.css">
    <link rel="shortcut icon" href="/hj/images/icon.png">
    <script src="/hj/js/jquery-3.6.1.min.js"></script>
    <script src="/hj/js/validation.js"></script>
    <link rel="stylesheet" href="../../package/dist/sweetalert2.min.css">
    <script src="../../js/jquery-3.6.1.min.js"></script>
    <title>Editar reserva | Huevos Jireth</title>
    <script>
        $(document).ready(function() {
            $("#listproductos").change(function() {
                $("#listproductos option:selected").each(function() {
                    idrsv = $(this).val();
                    $.post("/hj/model/get_precio.php", {
                        idrsv: idrsv
                    }, function(data) {
                        $("#listprecios").html(data);
                        const cop = new Intl.NumberFormat('es-CO', {
                            style: 'currency',
                            currency: 'COP',
                            minimumFractionDigits: 0
                        })
                        var a = parseFloat(document.getElementById("listprecios").value)
                        var b = !isNaN(parseFloat(document.getElementById("cantidad").value)) ? parseFloat(document.getElementById("cantidad").value) : 1
                        document.getElementById("total").innerHTML = cop.format(a * b)
                    });
                });
            })
        })
    </script>
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
            <h2 class="title-header">Editar reserva</h2>
            <hr>
        </div>
        <div>
            <?php while ($list = mysqli_fetch_assoc($ok)) { ?>
                <form method="post">
                    <div class="row">
                        <input id="idr" type="hidden" value="<?php echo $list["idReserva"] ?>" name="id" readonly>
                        <div class="col">
                            <label class="form-label">Producto</label>
                            <select id="listproductos" class="form-select" name="product">
                                <option value="<?php echo $list["Producto"] ?>"><?php echo $list["Producto"] ?></option>
                                <?php while ($list2 = mysqli_fetch_assoc($ok2)) { ?>
                                    <option value="<?php echo $list2["Nombre"] ?>"><?php echo $list2["Nombre"] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col">
                            <label class="form-label">Precio</label>
                            <select id="listprecios" class="form-control" onselect="calcular()" name="price">
                                <option value="<?php echo $list["Precio"] ?>"><?php echo $list["Precio"] ?></option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <label class="form-label">Fecha</label>
                            <input id="fecha" class="form-control" type="date" name="date" min="<?php echo $hoy ?>" max="<?php echo $max ?>" value="<?php echo $list["Fecha"] ?>" required>
                        </div>
                        <div class="col">
                            <label class="form-label">Hora</label>
                            <input id="hora" class="form-control" type="time" min="07:00" max="21:00" name="time" value="<?php echo $list["Hora"] ?>" required>
                        </div>
                    </div>
                    <br>
                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label">Panales</label>
                        <div class="col-sm-1 col-md-2">
                            <input id="cantidad" type="number" class="form-control form-control-sm" name="amount" min="1" max="10" oninput="calcular()" value="<?php echo $list["Cantidad"] ?>" required>
                        </div>
                    </div>
                    <br>
                    <label class="form-label">Valor total</label>
                    <h3><span id="total">$ <?php echo $list["Total"] ?></span></h3>
                    <br>
                    <div class="footer-buttons">
                        <button id="ar" type="submit" class="btn btn-primary">Actualizar</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick=(window.history.back(-1))>Cancelar</button>
                    </div>
                </form>
            <?php } ?>
        </div>
    </section>

    <script src="/hj/js/menu.js"></script>
    <script src="/hj/js/select.js"></script>
    <script src="../../package/dist/sweetalert2.all.js"></script>
    <script src="../../package/dist/sweetalert2.all.min.js"></script>
    <!--ACTUALIZAR RESERVA-->
    <script type="text/javascript">
        $(function() {
            $('#ar').click(function(e) {
                var valid = this.form.checkValidity();

                if (valid) {
                    var id = $('#idr').val();
                    var producto = $('#listproductos').val();
                    var precio = $('#listprecios').val();
                    var cantidad = $('#cantidad').val();
                    var fecha = $('#fecha').val();
                    var hora = $('#hora').val();

                    e.preventDefault();

                    $.ajax({
                        type: 'POST',
                        url: '../../model/update-reserv.php',
                        data: {
                            id: id,
                            producto: producto,
                            precio: precio,
                            cantidad: cantidad,
                            fecha: fecha,
                            hora: hora
                        },
                        success: function(data) {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Reserva Actualizada',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(function() {
                                window.location = '../../view/client/user-reserv.php';
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
    <script type="text/javascript">
        $('#cantidad').keypress(function(e){
            if(event.which<2 || this.value.length===2){
                return false;
            }
        })
    </script>
</body>

</html>