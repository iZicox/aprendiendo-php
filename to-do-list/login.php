<?php
    require_once "varios.php";

  

    if(isset($_SESSION["id_usuario"])){
        echo "ya estas logeado";
        exit;
    }

    $nombre = $_POST["nombre"] ?? "";
    $contrasena = $_POST["contrasena"] ?? "";
    $recordar = isset($_POST["recordar"]);

    if(!empty($nombre) && !empty($contrasena)){
        $usuario = datosLogin($nombre);
        if(is_array($usuario) && $usuario["contrasenna"] === $contrasena){
            $_SESSION["id_usuario"] = $usuario["id_usuario"];
            $_SESSION["nombre"] = $nombre;
            echo("El id en sesion es: " . $usuario["id_usuario"]);
            echo $_SESSION["id_usuario"];
            if($recordar){
                $guardar = guardarCookie($usuario["id_usuario"]);
                echo $guardar ? "se guardo" : "no se guardo";   
            }
            header("Location: index.php");
            exit;
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
    <a href="index.php">Regresar</a>
    <h1>Login</h1>
    <form action="" method="post">
        <label for="">Nombre: </label>
        <input type="text" name="nombre">
        <br><br>
        <label for="">Contraseña: </label>
        <input type="password" name="contrasena">
        <br><br>
        <label for="">Recordar</label>
        <input type="radio" name="recordar">
        <br><br>
        <input type="submit">
        <a href="registro.php">registrarse</a>
    </form>
</body>
</html>