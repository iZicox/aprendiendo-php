<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Registro</title>
</head>

<?php

    require_once "varios.php";

    session_start();
    $html = "";
    // function conectarPDO($ip,$puerto,$dbname,$user,$pass):PDO
    $conexion = conectarPDO("localhost","3307","ejemplosphp","root","");

    $identificador = isset($_POST["identificador"]) ? isset($_POST["identificador"]) : "";
    $nombre = isset($_POST["nombre"]) ? isset($_POST["nombre"]) : "";
    $apellidos = isset($_POST["apellidos"]) ? isset($_POST["apellidos"]) : "";
    $contrasenna = isset($_POST["contrasenna"]) ? isset($_POST["contrasenna"]) : "";

    if(
        !empty($identificador)   &&
        !empty($nombre)          &&
        !empty($apellidos)       &&
        !empty($contrasenna)){

        $plantillaRegistro = "insert into usuarios(identificador,nombre,apellidos,contrasenna) values(:identificador,:nombre,:apellidos,:contrasenna)";

        $insert = $conexion->prepate($plantillaRegistro);
        $insert->execute(
            array(
                ":identificador" => $_POST[""],
                ":nombre" => $_POST[""],
                ":apellidos" => $_POST[""],
                ":contrasenna" => $_POST[""]
            )
        );
        $html = <<<EOF
            <body>
                <h1>Usuario registrado.</h1>
            </body>
        EOF;
    } else {
        $html = <<<EOF
            <body>
                <h1>Registrar usuario</h1>
                <form action="" method="post">
                    <p>
                        <label for="name">Identificador: </label>
                        <input type="text" name="identificador">
                    </p>
                    <p>
                        <label for="name">Nombre: </label>
                        <input type="text" name="nombre">
                    </p>
                    <p>
                        <label for="name">Apellidos: </label>
                        <input type="text" name="apellidos">
                    </p>
                    <p>
                        <label for="name">Contraseña: </label>
                        <input type="password" name="contrasenna">
                    </p>
                    <input type="submit">
                </form>
            </body>
        EOF;
    }


?>

<?= echo $html ?>

</html>
