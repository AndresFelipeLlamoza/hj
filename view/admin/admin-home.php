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
        <h2 class="title-header">Estadísticas</h2>
        <hr>
        <br>
        <div>
            <a class="btn btn-info" href="/hj/model/reportreserv.php" target="_blank">Generar reporte</a>
        </div>
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
    </section>

    <script src="/hj/js/menu.js"></script>
    <!--ScriptChart-->
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