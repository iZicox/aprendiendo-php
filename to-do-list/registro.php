<?php
    require_once "varios.php";

    
    $nombre = $_POST["nombre"] ?? "";
    $contrasena = $_POST["contrasena"] ?? "";
    $confirmar = $_POST["confirmarContrasena"] ?? "";

    $mensaje = "";

    if(!empty($nombre) && !empty($contrasena) && !empty($confirmar)){
        if(!nombreExiste($nombre)){
            if($contrasena === $confirmar){
                insertarRegistro($nombre,$contrasena);
                header("Location: login.php");
                exit;
            }else{
                $mensaje = "Las contrasenas no coinciden";
            }
        }else{
            $mensaje = "El nombre ya esta en la base de datos";
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
    <?= print_r($mensaje,true) . "<br>"?>
    <a href="index.php">Regresar</a>
    <h1>Registro</h1>
    <form action="" method="post">
        <label for="">Nombre: </label>
        <input type="text" name="nombre" id="" required>
        <br><br>

        <label for="">Contraseña: </label>
        <input type="password" name="contrasena" required>
        <br><br>

        <label for="">Repetir Contraseña: </label>
        <input type="password" name="confirmarContrasena" required>
        <br><br>

        <input type="submit">
        <a href="login.php">Login</a>

    </form>
</body>
</html>