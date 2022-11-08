<?php
include ("../model/conexion.php");
session_start();
if(!isset($_SESSION['usuario'])){
    echo "<script>alert('Debes iniciar sesion');location='/hj/view/login.php';</script>";
    session_destroy();
    die();
}
$id=$_GET["id"];
$rsv="SELECT * FROM reservas WHERE idReserva='$id'";
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
    <script>
        $(document).ready(function(){
				$("#listproductos").change(function () {
					$("#listproductos option:selected").each(function () {
						idrsv = $(this).val();
						$.post("/hj/php/get_precio.php", { idrsv: idrsv }, function(data){
							$("#listprecios").html(data);
						});            
					});
				})
			})
    </script>
    <title>Editar reserva | Huevos Jireth</title>
</head>
<body>
    <div class="main">
        <div class="sidebar">
            <center><a href="/hj/view/user.php"><img src="/hj/images/logo.png" id="logo"></a></center>
            <ul>
                <li>
                    <a href="/hj/view/user-home.php">
                        <i class='bx bxs-bookmark-minus' title="Principal"></i>
                        <span class="item">Reservas</span>
                    </a>
                </li>
                <li>
                    <a href="/hj/view/user-pqrs.php">
                        <i class='bx bxs-message-dots' title="Clientes"></i>
                        <span class="item">PQRS</span>
                    </a>
                </li>
                <li>
                    <a href="/hj/view//template/personaldata.php">
                    <i class='bx bxs-envelope'></i>
                        <span class="item">Cambiar Correo</span>
                    </a>
                </li>
                <li>
                    <a href="/hj/view//template/personalContra.php">
                    <i class='bx bx-key' ></i>
                        <span class="item">Cambiar Clave</span>
                    </a>
                </li>
                <li>
                    <a href="/hj/view/user.php">
                        <i class='bx bxs-home' title="Principal"></i>
                        <span class="item">Volver a inicio</span>
                    </a>
                </li>
            </ul>
        </div>

        <!--NAVBAR-->
        <div class="content">
            <div class="navbar">
                <div class="n1">
                    <i class='bx bx-menu' id="btn-menu"></i>
                    <h2>EDITAR RESERVA</h2>
                </div>
                <div class="n2">
                    <h4><?php echo $_SESSION['usuario']?></h4>
                    <a href="/hj/model/close_session.php">
                        <i class='bx bx-log-in' title="Cerrar Sesión"></i>
                    </a>
                </div>
            </div>

            <!--TICKET-->
            <div style="padding: 2% ;">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form action="/hj/model/updtreserv.php" method="post">
                        <div class="modal-body">
                            <center><input type=hidden id="user_reserv" value="<?php echo $row['Cliente']?>" readonly name="usuario"></center>
                            <label class="form-label">Escoje tu producto</label>
                            <select id="listproductos" name="product" class="form-select">
                                <?php $ok=mysqli_query($conx,$rsv);
                                while($zz=mysqli_fetch_assoc($ok)) { ?>
                                <option value="<?php echo $zz["Producto"]?>"><?php echo $zz["Producto"]?></option>
                                <?php } ?>
                            </select>
                            <br>
                            <label class="form-label">Precio</label>
                            <select id="listprecios" onselect="calcular()" name="price" class="form-control">
                                <?php $ok=mysqli_query($conx,$rsv);
                                while($zz=mysqli_fetch_assoc($ok)) { ?>
                                <option value="<?php echo $zz["Precio"]?>"><?php echo $zz["Precio"]?></option>
                                <?php } ?>
                            </select>
                            <br>
                            <label class="form-label">Panales</label>
                            <input id="cantidad" type="number" name="amount" min="1" max="5" pattern="^[1-5]" oninput="calcular()" style="outline: none;">
                            <br><br>
                            <label class="form-label">Valor total</label>
                            <br>
                            <b><p>$<span id="total"></span></p></b>
                        </div>
                        <div class="modal-footer justify-content-start">
                            <button type="submit" class="btn btn-success">Reservar</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><a class="cancelarboton" href="/hj/view/user-home.php">Cancelar</a></button>
                        </div>
                    </form>
                </div>
            </div>
            </div>
        </div>
    </div>

    <script src="/hj/js/menu.js"></script>
    <script src="/hj/js/select.js"></script>
</body>
</html>
