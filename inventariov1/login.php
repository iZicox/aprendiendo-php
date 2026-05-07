<?php
require_once "varios.php";
session_start();
$con = conexion();
$usuario = isset($_POST["usuario"]) ? $_POST["usuario"] : "";
$password = isset($_POST["password"]) ? $_POST["password"] : "";
$error = "";

if (!empty($usuario) && !empty($password)) {
    $datos = login($con, $usuario, $password);
    if (is_array($datos) && !empty($datos)) {

        if(isset($_POST["recordar"])){
            guardarCookie($con, $datos["id"]);
        }

        $_SESSION["id"] = $datos["id"];
        $_SESSION["nombre"] = $datos["username"];
        header("Location: index.php");
        exit();
  
    } else {
        $error = "<p>Error: usuario/contraseña no encontrado.</p>";
    }
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

    <?php if (isset($_SESSION["id"])) { ?>

        <h1>Ya estas logeado como <?= $_SESSION["nombre"] ?></h1>
        <p>Necesitas salir para iniciar sesion con un usuario diferente</p>
        <button><a href="index.php">cancelar</a></button>
        <button><a href="logout.php">cerrar sesion</a></button>

    <?php } else { ?>
        <h1>Login</h1>
        <?= $error ?>
        <form action="" method="post">
            <label for="">Usuario: </label>
            <input type="text" name="usuario">
            <br><br>

            <label for="">Contraseña: </label>
            <input type="password" name="password">
            <br><br>

            <label for="">Recordar</label>
            <input type="checkbox" name="recordar" value="1">
            <br><br>

            <input type="submit" value="enviar">
        </form>
        <p>No tienes una cuenta? <a href="registro.php">Registrate aqui</a></p>
    <?php } ?>


</body>

</html>