<?php
include("../../model/conexion.php");
session_start();
if (!isset($_SESSION['usuario'])) {
    echo "<script>alert('Debes iniciar sesion');location='/hj/view/login.php';</script>";
    session_destroy();
    die();
}
$products = "SELECT * FROM productos";
$show = mysqli_query($conx, $products);
$productsx = "SELECT * FROM productos WHERE Cantidad>=1";
$ok = mysqli_query($conx, $productsx);
$I = array(
    "/hj/images/bg_huevos1.jpg",
    "/hj/images/bg_huevos2.jpg",
    "/hj/images/bg_huevos3.jpg",
    "/hj/images/bg_huevos4.jpg"
);
$hoy = date('Y-m-d');
$max = date('Y-m-d', strtotime($hoy . '+2 days'));
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="/hj/css/inicio.css">
    <link rel="shortcut icon" href="/hj/images/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../../package/dist/sweetalert2.min.css">
    <script src="/hj/js/validation.js"></script>
    <script src="/hj/js/jquery-3.6.1.min.js"></script>
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
                        var b = !isNaN(parseFloat(document.getElementById("cantidad").value)) ? parseFloat(document.getElementById("cantidad").value) : 0
                        document.getElementById("total").innerHTML = cop.format(a * b)
                    });
                });
            })
        })
    </script>
</head>

<body style="background-color:rgb(221, 219, 219);">
    <?php include("../template/header_user.php") ?>
    <!--SLIDER-->
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="/hj/images/huevos1.jpg" class="d-block w-100" alt="Huevos 1">
            </div>
            <div class="carousel-item">
                <img src="/hj/images/huevos2.jpg" class="d-block w-100" alt="Huevos 2">
            </div>
            <div class="carousel-item">
                <img src="/hj/images/huevos3.jpg" class="d-block w-100" alt="Huevos 3">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!--PRODUCTOS-->
    <?php $nImg = 0; ?>
    <section id="productos">
        <h1 class="barrita">PRODUCTOS</h1>
        <div class="productos">
            <?php while ($row = mysqli_fetch_assoc($show)) { ?>
                <div class="pedaso" style="background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.3)), url(<?php echo $I[$nImg]; ?>);">
                    <?php $nImg = $nImg + 1; ?>
                    <h1><?php echo $row["Nombre"] ?></h1>
                    <h4>$<?php echo $row["Precio"] ?></h4>
                    <p style="color: greenyellow">Cantidad disponible: <?php echo $row["Cantidad"] ?> Panales</p>
                    <?php if($row["Cantidad"]==0){
                        echo "<span>No Disponible</span>";
                    } ?>
                    <p><?php echo $row["Descripcion"] ?></p>
                </div>
            <?php }
            mysqli_free_result($show); ?>
        </div>
    </section>

    <!--RESERVAS-->
    <section id="reservar" class="reservation">
        <center>
            <button class="btn-rsv" data-bs-toggle="modal" href="#exampleModalToggle">Reservar</button>
        </center>
        <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form action="" method="POST">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalToggleLabel">¡HAZ TU RESERVA YA!</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <center><input type="hidden" id="user_reserv" value="<?php echo $_SESSION['usuario'] ?>" readonly name="username"></center>
                            <div class="row align-items">
                                <div class="col">
                                    <label class="form-label">Escoje tu producto</label>
                                    <select id="listproductos" class="form-select" name="product" required>
                                        <option value="" select hidden>Seleccione</option>
                                        <?php while ($list = mysqli_fetch_assoc($ok)) { ?>
                                            <option value="<?php echo $list["Nombre"] ?>"><?php echo $list["Nombre"] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col">
                                    <label class="form-label">Precio</label>
                                    <select id="listprecios" class="form-control" onselect="calcular()" onchange="calcular()" name="price">
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Panales</label>
                                <div class="col-sm-10 col-md-2">
                                    <input id="cantidad" type="number" class="form-control form-control-sm" name="amount" min="1" max="10" oninput="calcular()" required>
                                </div>
                            </div>
                            <div class="row align-items">
                                <div class="col">
                                    <label class="form-label">Fecha</label>
                                    <input id="fecha" class="form-control" type="date" name="date" min="<?php echo $hoy ?>" max="<?php echo $max ?>" required>
                                </div>
                                <div class="col">
                                    <label class="form-label">Hora</label>
                                    <input id="hora" class="form-control" type="time" min="07:00" max="21:00" name="time" required>
                                </div>
                            </div>
                            <br>
                            <label class="form-label">Valor total</label>
                            <h3><span id="total">$ 0</span></h3>
                        </div>
                        <div class="modal-footer">
                            <button id="gr" type="submit" class="btn btn-success">Reservar</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!--RECETAS-->
    <section id="recetas">
        <h1 class="barrita">RECETAS</h1>
        </div>
        <div class="recetas">
            <div class="receta">
                <img src="/hj/images/receta1.jpg" alt="Receta 1">
                <h1>HUEVOS A LA FLAMENCA</h1>
                <a href="/hj/view/client/recetaA.php" class="re">Ver más</a>
            </div>
            <div class="receta">
                <img src="/hj/images/receta2.jpg" alt="Receta 2">
                <h1>HUEVOS BENEDICTOS</h1>
                <a href="/hj/view/client/recetaB.php" class="re">Ver más</a>
            </div>
            <div class="receta">
                <img src="/hj/images/receta3.jpg" alt="Receta 3">
                <h1>HUEVOS CON PURE DE AGUACATE</h1>
                <a href="/hj/view/client/recetaC.php" class="re">Ver más</a>
            </div>
            <div class="receta">
                <img src="/hj/images/receta4.jpg" alt="Receta 4">
                <h1>HUEVOS TURCOS</h1>
                <a href="/hj/view/client/recetaD.php" class="re">Ver más</a>
            </div>
        </div>
    </section>

    <?php include("../../view/template/footer.php") ?>
    <script src="/hj/js/modal-rsv.js"></script>
    <script src="/hj/js/select.js"></script>
    <script src="../../package/dist/sweetalert2.all.js"></script>
    <script src="../../package/dist/sweetalert2.all.min.js"></script>
    <script type="text/javascript">
        $(function() {
            $('#gr').click(function(e) {
                var valid = this.form.checkValidity();

                if (valid) {
                    var nombre = $('#user_reserv').val();
                    var producto = $('#listproductos').val();
                    var precio = $('#listprecios').val();
                    var cantidad = $('#cantidad').val();
                    var fecha = $('#fecha').val();
                    var hora = $('#hora').val();

                    e.preventDefault();

                    $.ajax({
                        type: 'POST',
                        url: '../../model/create-reservation.php',
                        data: {
                            nombre: nombre,
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
                                title: 'Reserva Guardada',
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