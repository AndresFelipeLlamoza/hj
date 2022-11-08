<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="shortcut icon" href="/hj/images/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="/hj/css/login.css">
    <link rel="stylesheet" href="/hj/css/header.css">
    <script src="/hj/js/validation.js"></script>
    <title>Acceder - Huevos Jireth</title>
</head>

<body>
    <!--NAVBAR-->
    <nav class="navbar navbar-expand-lg fixed-top p-0">
        <div class="container-fluid">
            <a class="navbar-brand" href="/hj/">
                <img src="/hj/images/icon.png" alt="HuevosJireth" height="50" style="margin: 0 5px;">
                <span style="color:red;" class="p-0 m-0">Huevos Jireth</span>
            </a>
        </div>
    </nav>

    <div class="form">
        <!--INICIAR SESION-->
        <form action="/hj/model/read_user.php" method="post" class="login" onsubmit="return login(event)">
            <div class="imgform">
                <img src="/hj/images/pollito1.png" alt="Pollito" class="PollitoFutbol">
            </div>
            <h1>Inicia Sesión</h1>
            <input id="nombre2" type="text" placeholder="Nombre y Apellido" name="user" onkeypress="return sololetras(event)">
            <input id="contraseña2" type="password" placeholder="Contraseña" name="password">
            <button type="submit" class="botonlogin">Acceder</button>
            <a class="olvidaste" href="#">¿Olvidaste tu contraseña?</a>
        </form>
        <!--REGISTRO-->
        <form action="/hj/model/create_user.php" method="post" class="register" onsubmit="return signup(event)">
            <div class="imgform">
                <img src="/hj/images/pollito2.png" alt="Pollito" class="PollitoHuevo">
            </div>
            <h1>Regístrate</h1>
            <input id="nombre1" type="text" placeholder="Nombre y Apellido" name="user" onkeypress="return sololetras(event)">
            <input id="correo1" type="email" placeholder="Correo" name="email">
            <input id="contraseña1" type="password" placeholder="Contraseña" name="password">
            <!-- <div class="terminos">
                <input type="checkbox" required>
                <a href="#">Acepta nuestros términos y condiciones</a>
            </div> -->
            <button type="submit" class="botonregister">Registrarse</button>
        </form>
    </div>

    <!--FOOTER-->
    <?php include("../view/template/footer.php") ?>
</body>

</html>