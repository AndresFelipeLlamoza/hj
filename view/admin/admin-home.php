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
    <link rel="stylesheet" href="/hj/css/dshbadmin.css">
    <link rel="shortcut icon" href="/hj/images/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../../package/dist/sweetalert2.min.css">
    <title>Panel de Control | Huevos Jireth</title>
</head>

<body>
    <nav class="sidebar close">
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

        <div class="menu-bar">
            <div class="menu">
                <ul class="menu-links">
                    <li class="nav-link cerdo">
                        <a href="/hj/view/admin/admin-home.php">
                            <i class='bx bxs-home icon'></i>
                            <span class="text nav-text">Principal</span>
                        </a>
                    </li>
                    <li class="nav-link cerdo">
                        <a href="/hj/view/admin/admin-clients.php">
                            <i class='bx bxs-user icon'></i>
                            <span class="text nav-text">Clientes</span>
                        </a>
                    </li>
                    <li class="nav-link cerdo">
                        <a href="/hj/view/admin/admin-reservs.php">
                            <i class='bx bxs-bookmark-minus icon'></i>
                            <span class="text nav-text">Reservas</span>
                        </a>
                    </li>
                    <li class="nav-link cerdo">
                        <a href="/hj/view/admin/admin-products.php">
                            <i class='bx bxs-box icon'></i>
                            <span class="text nav-text">Productos</span>
                        </a>
                    </li>
                    <li class="nav-link cerdo">
                        <a href="/hj/view/admin/admin-messages.php">
                            <i class='bx bxs-envelope icon'></i>
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
        <br>
        <h2 class="title-header">Estadísticas</h2>
        <hr>
        <br>
        <!--GRAFICAS-->
        <div class="card-body">
            <div class="row">
                <div class="col-lg-4">
                    <h3 class="title-header">Reservas Realizadas</h3>
                    <canvas id="graficopie" width="400px" height="400px"></canvas>
                </div>
                <div class="col-lg-4">
                    <h3 class="title-header">Cantidades Reservadas</h3>
                    <canvas id="graficobarhorizontal" width="400" height="400"></canvas>
                </div>
                <div class="col-lg-4">
                    <h3 class="title-header">Ganancias Totales</h3>
                    <canvas id="graficobar" width="400" height="400"></canvas>
                </div>
            </div>
        </div>
        <br><br>
        <!--CONSULTAS-->
        <h2 id="querys" class="title-header">Consultas y Reportes</h2>
        <hr>
        <form method="get">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label"><b>Fecha Inicio</b></label>
                        <input id="desde" class="form-control" type="date" name="fecha_inicio" value="<?php if (isset($_GET['fecha_inicio'])) {echo $_GET['fecha_inicio'];} ?>" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label"><b>Fecha Fin</b></label>
                        <input id="hasta" class="form-control" type="date" name="fecha_fin" value="<?php if (isset($_GET['fecha_fin'])) {echo $_GET['fecha_fin'];} ?>" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label"><b>Tipo de producto</b></label>
                        <select id="producto" class="form-select" name="producto" required>
                            <option value="" selected hidden>Seleccione</option>
                            <option value="Huevos Pequeños">Huevos Pequeños</option>
                            <option value="Huevos Medianos">Huevos Medianos</option>
                            <option value="Huevos Triple A">Huevos Triple A</option>
                            <option value="Huevos Doble Yema">Huevos Doble Yema</option>
                            <?php if(isset($_GET['producto'])) {
                                echo "<option value='$_GET[producto]' selected>$_GET[producto]</option>";
                            }else{
                                
                            } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label"><b></b></label><br>
                        <button class="btn btn-primary" type="submit" style="transform: translateY(20%);">Buscar</button>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label"><b></b></label><br>
                        <a href="/hj/view/admin/admin-home.php">
                            <button class="btn btn-success" type="button"><i class='bx bxs-brush'></i> Limpiar</button>
                        </a>
                    </div>
                </div>
            </div>
        </form>
        <br>
        <div class="table-responsive">
            <table class="table table-bordered border-dark table-hover">
                <thead class="table-dark">
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
                    <?php if (isset($_GET['fecha_inicio']) && isset($_GET['fecha_fin']) && isset($_GET['producto'])) {
                        $from = $_GET['fecha_inicio'];
                        $to = $_GET['fecha_fin'];
                        $pro = $_GET['producto'];

                        $query = mysqli_query($conx, "SELECT * FROM reservas WHERE Fecha BETWEEN '$from' AND '$to' AND Estado='Retirado' AND Producto='$pro'");

                        //////////////////////////////////////////////////
                        $count1 = mysqli_query($conx, "SELECT COUNT(*) AS conteo FROM reservas WHERE Fecha BETWEEN '$from' AND '$to' AND Estado='Retirado' AND Producto='$pro'");
                        $ok1 = mysqli_fetch_assoc($count1);
                        $count2 = mysqli_query($conx, "SELECT SUM(Cantidad) AS cantidad FROM reservas WHERE Fecha BETWEEN '$from' AND '$to' AND Estado='Retirado' AND Producto='$pro'");
                        $ok2 = mysqli_fetch_assoc($count2);
                        $count3 = mysqli_query($conx, "SELECT SUM(Total) AS ganancia FROM reservas WHERE Fecha BETWEEN '$from' AND '$to' AND Estado='Retirado' AND Producto='$pro'");
                        $ok3 = mysqli_fetch_assoc($count3);
                        $count4 = mysqli_query($conx, "SELECT Cliente AS persona, COUNT(Cliente) AS maximo FROM reservas WHERE Fecha BETWEEN '$from' AND '$to' AND Estado='Retirado' AND Producto='$pro' GROUP BY Cliente HAVING maximo=COUNT(Cliente) ORDER BY maximo DESC LIMIT 1");
                        $ok4 = mysqli_fetch_assoc($count4);
                        $ok5 = mysqli_query($conx, "SELECT Producto AS producto FROM reservas WHERE Fecha BETWEEN '$from' AND '$to' AND Estado='Retirado' AND Producto='$pro'");
                        $ok5 = mysqli_fetch_assoc($ok5);
                        //////////////////////////////////////////////////

                        if (mysqli_num_rows($query) > 0) {
                            foreach ($query as $fila) {
                    ?>
                                <tr>
                                    <td><?php echo $fila["Cliente"] ?></td>
                                    <td><?php echo $fila["Producto"] ?></td>
                                    <td>$<?php echo $fila["Precio"] ?></td>
                                    <td><?php echo $fila["Cantidad"] ?></td>
                                    <td>$<?php echo $fila["Total"] ?></td>
                                    <td><?php echo $fila["Fecha"] ?></td>
                                    <td><?php echo $fila["Hora"] ?></td>
                                    <td><?php echo $fila["Estado"] ?></td>
                                </tr>
                            <?php
                            }
                        } else {
                            ?>
                            <tr>
                                <td rowspan="8">
                                    <?php echo 'No se encontraron resultados'; ?>
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>

                </tbody>
            </table>
            <p><b>Tipo de producto:</b> <?php if (isset($ok5)) {echo $ok5['producto'];} {echo '';} ?></p>
            <p><b>Reservas retiradas:</b> <?php if (isset($ok1)) {echo $ok1['conteo'];} else {echo '';} ?></p>
            <p><b>Panales vendidos:</b> <?php if (isset($ok2)) {echo $ok2['cantidad'];} else {echo '';} ?></p>
            <p><b>Ganacias totales:</b> <?php if (isset($ok3)) {echo '$',$ok3['ganancia'];} else {echo '';} ?></p>
            <p><b>Cliente regular:</b> <?php if (isset($ok4)) {echo $ok4['persona'];} else {echo '';} ?></p>
            <a class="btn btn-danger" onclick="reportePDF()"><i class='bx bxs-file-pdf'></i> Exportar PDF</a>
        </div>
        <hr>
        <br>
        <section id="clients">
            <h2 class="title-header">Búsqueda por cliente</h2>
            <br>
            <form method="get">
                <div class="row g-3 align-items-center">
                    <div class="col-auto">
                        <input class="form-control" type="text" name="cliente" id="rcliente" value="<?php if (isset($_GET['cliente'])) {echo $_GET['cliente'];} ?>" required>
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-primary" type="submit">Buscar</button>
                    </div>
                </div>
            </form>
            <br>
            <div class="table-responsive">
                <table class="table table-bordered table-hover border-dark">
                    <thead class="table-dark">
                        <tr>
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
                        <?php if (isset($_GET['cliente'])) {
                            $client = $_GET['cliente'];
                            $sql = mysqli_query($conx, "SELECT * FROM reservas WHERE Cliente='$client' AND Estado!='Vigente'");

                            //////////////////////////////////////////////////
                            $sql1 = mysqli_query($conx, "SELECT COUNT(*) AS exitosas FROM reservas WHERE Cliente='$client' AND Estado='Retirado'");
                            $zxc1 = mysqli_fetch_assoc($sql1);
                            $sql2 = mysqli_query($conx, "SELECT COUNT(*) AS canceladas FROM reservas WHERE Cliente='$client' AND Estado='Cancelado'");
                            $zxc2 = mysqli_fetch_assoc($sql2);
                            $sql3 = mysqli_query($conx, "SELECT Producto AS producto, COUNT(Producto) AS mas FROM reservas WHERE Cliente='$client' GROUP BY Producto HAVING mas=(COUNT(Producto)) ORDER BY mas DESC LIMIT 1");
                            $zxc3 = mysqli_fetch_assoc($sql3);
                            //////////////////////////////////////////////////

                            if (mysqli_num_rows($sql) > 0) {
                                foreach ($sql as $dato) {
                                    ?>
                                    <tr>
                                        <td><?php echo $dato["Producto"] ?></td>
                                        <td>$<?php echo $dato["Precio"] ?></td>
                                        <td><?php echo $dato["Cantidad"] ?></td>
                                        <td>$<?php echo $dato["Total"] ?></td>
                                        <td><?php echo $dato["Fecha"] ?></td>
                                        <td><?php echo $dato["Hora"] ?></td>
                                        <td><?php echo $dato["Estado"] ?></td>
                                    </tr>
                                <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td rowspan="7">
                                        <?php echo 'No se encontró al cliente ',$client; ?>
                                    </td>
                                </tr>
                        <?php
                            }
                        } ?>
                    </tbody>
                </table>
                <p><b>Reservas retiradas:</b> <?php if (isset($zxc1)) {echo $zxc1['exitosas'];} else {echo '';} ?></p>
                <p><b>Reservas canceladas:</b> <?php if (isset($zxc2)) {echo $zxc2['canceladas'];} else {echo '';} ?></p>
                <p><b>Producto más solicitado:</b> <?php if (isset($zxc3)) {echo $zxc3['producto'];} else {echo '';} ?></p>
            </div>
        </section>
        <br>
    </section>

    <script src="/hj/js/menu.js"></script>
    <!--ScriptChart-->
    <script>
        function reportePDF() {
            var desde = $('#desde').val();
            var hasta = $('#hasta').val();
            var prod = $('#producto').val();

            if(desde==="" && hasta==="" && prod===""){
                swal.fire({
                    position: 'center',
                    icon: 'warning',
                    title: 'Defina el rango de fecha y seleccione un tipo de producto',
                    howConfirmButton: true,
                });
                return false;
            }

            window.open('/hj/model/reportreserv.php?desde='+desde+'&hasta='+hasta+'&producto='+prod)
        }
    </script>
    <script src="../../package/dist/sweetalert2.all.js"></script>
    <script src="../../package/dist/sweetalert2.all.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script>
        CargarDatosGraficaBar();
        CargarDatosGraficaBarHorizontal();
        CargarDatosGraficaPie();

        function CargarDatosGraficaPie() {
            $.ajax({
                url: '../../controller/controlador_grafico_mas.php',
                type: 'POST'
            }).done(function(resp) {
                if (resp.length > 0) {
                    var titulo = [];
                    var cantidad = [];
                    var data = JSON.parse(resp);
                    for (var i = 0; i < data.length; i++) {
                        titulo.push(data[i][0]);
                        cantidad.push(data[i][1]);
                    }
                    CrearGrafico1(titulo, cantidad, 'pie', 'Precio', 'graficopie');
                }
            })
        }

        function CargarDatosGraficaBarHorizontal() {
            $.ajax({
                url: '../../controller/controlador_grafico_can.php',
                type: 'POST'
            }).done(function(resp) {
                if (resp.length > 0) {
                    var titulo = [];
                    var cantidad = [];
                    var data = JSON.parse(resp);
                    for (var i = 0; i < data.length; i++) {
                        titulo.push(data[i][0]);
                        cantidad.push(data[i][1]);
                    }
                    CrearGrafico2(titulo, cantidad, 'horizontalBar', 'Unidades', 'graficobarhorizontal');
                }
            })
        }

        function CargarDatosGraficaBar() {
            $.ajax({
                url: '../../controller/controlador_grafico.php',
                type: 'POST'
            }).done(function(resp) {
                if (resp.length > 0) {
                    var titulo = [];
                    var cantidad = [];
                    var data = JSON.parse(resp);
                    for (var i = 0; i < data.length; i++) {
                        titulo.push(data[i][0]);
                        cantidad.push(data[i][1]);
                    }
                    CrearGrafico(titulo, cantidad, 'bar', 'Ganancias', 'graficobar');
                }
            })
        }

        function CrearGrafico1(titulo, cantidad, tipo, emcabezado, id) {
            const ctx = document.getElementById(id);
            const myChart = new Chart(ctx, {
                type: tipo,
                data: {
                    labels: titulo,
                    datasets: [{
                        label: emcabezado,
                        data: cantidad,
                        backgroundColor: [
                            'rgba(205, 13, 231, 0.2)',
                            'rgba(231, 122, 13, 0.2)',
                            'rgba(49, 13, 231, 0.2)',
                            'rgba(13, 231, 17, 0.2)',
                        ],
                        borderColor: [
                            'rgba(205, 13, 231)',
                            'rgba(231, 122, 13)',
                            'rgba(49, 13, 231)',
                            'rgba(13, 231, 17)',

                        ],
                        borderWidth: 1,
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        function CrearGrafico2(titulo, cantidad, tipo, emcabezado, id) {
            const ctx = document.getElementById(id);
            const myChart = new Chart(ctx, {
                type: tipo,
                data: {
                    labels: titulo,
                    datasets: [{
                        label: emcabezado,
                        data: cantidad,
                        backgroundColor: [
                            'rgba(205, 13, 231, 0.2)',
                            'rgba(231, 122, 13, 0.2)',
                            'rgba(49, 13, 231, 0.2)',
                            'rgba(13, 231, 17, 0.2)',
                        ],
                        borderColor: [
                            'rgba(205, 13, 231)',
                            'rgba(231, 122, 13)',
                            'rgba(49, 13, 231)',
                            'rgba(13, 231, 17)',

                        ],
                        borderWidth: 1,
                    }]
                },
                options: {
                    locale: 'en-CO',
                    scales: {
                        yAxes: [{
                            ticks: {
                                precision: 0,
                                beginAtZero: true,
                            }
                        }],
                        xAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }],
                    }
                }
            });

        }

        function CrearGrafico(titulo, cantidad, tipo, emcabezado, id) {
            const ctx = document.getElementById(id);
            const myChart = new Chart(ctx, {
                type: tipo,
                data: {
                    labels: titulo,
                    datasets: [{
                        label: emcabezado,
                        data: cantidad,
                        backgroundColor: [
                            'rgba(205, 13, 231, 0.2)',
                            'rgba(231, 122, 13, 0.2)',
                            'rgba(49, 13, 231, 0.2)',
                            'rgba(13, 231, 17, 0.2)',
                        ],
                        borderColor: [
                            'rgba(205, 13, 231)',
                            'rgba(231, 122, 13)',
                            'rgba(49, 13, 231)',
                            'rgba(13, 231, 17)',

                        ],
                        borderWidth: 1,
                    }]
                },
                options: {
                    locale: 'en-CO',
                    scales: {
                        yAxes: [{
                            ticks: {
                                callback: (value, index, values) => {
                                    return new Intl.NumberFormat('en-CO', {
                                        style: 'currency',
                                        currency: 'COP',
                                        maximumSignificantDigits: 3
                                    }).format(value);
                                },
                                precision: 0,
                                beginAtZero: true,
                            }
                        }],
                        xAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }],
                    }
                }
            });

        }
    </script>
</body>

</html>