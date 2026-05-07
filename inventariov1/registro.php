<?php 
    require_once "varios.php";

    session_start();

    if(isset($_SESSION["id"])){
        header("Location: index.php"); 
        exit();
    }

    $con = conexion();
    $registro = false;
    $usuario = isset($_POST["usuario"]) ? $_POST["usuario"] : "";
    $password = isset($_POST["password"]) ? $_POST["password"] : "";

    $error = "";

    if(!empty($usuario) && !empty($password)){
        if(registro($con, $usuario, $password)){
            $registro = true;
        } else {
            $error = "<p>Error en el registro: El usuario ya existe</p>";
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

    <?php if(!$registro){ ?>
    <h1>Registro</h1>
    <?= $error ?>
    <form action="" method="post">
        <label for="">Usuario: </label>
        <input type="text" name="usuario">
        <br><br>

        <label for="">Contrasena: </label>
        <input type="password" name="password">
        <br><br>

        <input type="submit" value="enviar">
    </form>
    <p>Ya tienes una cuenta? <a href="login.php">Inicia sesion aqui</a></p>

    <?php }else{ ?>

    <h1>Registro exitoso</h1>
    <p>Ya puedes <a href="login.php">Iniciar sesion</a></p>

    <?php } ?>


</body>
</html>