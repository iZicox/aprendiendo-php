<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Registro</title>
</head>

<?php

    require_once "varios.php";
    // inicio session
    session_start();
    $html = "";
    $conexion = conectarPDO("localhost","3307","ejemplosphp","root","");

    // valida si existe el post
    $identificador = isset($_POST["identificador"]) ? $_POST["identificador"] : "";
    $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : "";
    $apellidos = isset($_POST["apellidos"]) ? $_POST["apellidos"] : "";
    $contrasenna = isset($_POST["contrasenna"]) ? $_POST["contrasenna"] : "";

    // validar si todas las variables estan vacias
    $datosVacios =
                    empty($identificador)   &&
                    empty($nombre)          &&
                    empty($apellidos)       &&
                    empty($contrasenna);

    // si no estan vacias entra a este if
    if(!$datosVacios){

        // revisar que no exista un identificador igual
        $plantillaIdentificador = "select 'T' from usuarios where identificador = :identificador";
        $consultaIdentificador = $conexion->prepare($plantillaIdentificador);
        $consultaIdentificador->execute(
            array(
                ":identificador" => $identificador
            )
        );
        // fetch de la consulta para guardar el resultado en un array
        $fila = $consultaIdentificador->fetch(PDO::FETCH_ASSOC);
        // primero verificar si existe el array para que no de error al acceder a algun valor del mismo
        // Si existe verificar que el valor sea "T" que significa que el usuario y existe
        if( isset($fila["T"]) && $fila["T"] === "T"){
            $html = <<<EOF
                <body>
                    <h1>Usuario ya existe.</h1>
                    <a href="login.php">Login</a> - 
                    <a href="registro.php">Registrar</a>
                </body>
            EOF;
        }else{ // si el ususario no existe proceder a insertarlo en la base de datos
            insertUsuario($conexion,$identificador,$nombre,$apellidos,$contrasenna);
            // pagina a mostrar
            $html = <<<EOF
                <body>
                    <h1>Usuario registrado.</h1>
                    <a href="login.php">Login</a> - 
                    <a href="registro.php">Registrar otro</a>
                </body>
            EOF;

        }

    } else { // cuando no se halla enviado el post mostrar el formulario
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

<?php
echo $html;
?>


</html>
