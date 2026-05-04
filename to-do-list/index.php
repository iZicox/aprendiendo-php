<?php
    require_once "varios.php";
    $logueado = isset($_SESSION["id_usuario"]);

    $nombreUsuario = "";

    if($logueado){
        $nombreUsuario = $_SESSION["nombre"];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <br><br>
    <h1>Aplicacion agenda <?= $logueado ? ("de " . $nombreUsuario) : "" ?> </h1>
    <button><a href="login.php">Login</a></button>
    <button><a href="registro.php">Registro</a></button>
    <?php if($logueado){ ?>
    <button><a href="dashboard.php">Area privada</a></button>
    <button><a href="logout.php">Log out</a></button>
    <?php } ?>
</body>
</html>