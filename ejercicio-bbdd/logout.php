<?php
// pagina para eliminar la session y las cookies
require_once "varios.php";
session_start();
$_SESSION = [];
// limpiar la cookie de la BD
if (isset($_COOKIE["recordar"])) {
    $conexion = conectarPDO("localhost","3307","ejemplosphp","root","");
    $consulta = "UPDATE usuarios SET codigocookie = NULL WHERE codigocookie = :cookie";
    $prep = $conexion->prepare($consulta);
    $prep->execute(
        array(
            ":cookie" => $_COOKIE["recordar"] ?? ""
            )    
        );
}
setcookie("recordar","",time()-(86400*30));
session_destroy();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <ul>
        <li>
            <a href="index.php">Inicio</a>

        </li>
        <li>

            <a href="login.php">Iniciar sesion</a>
        </li>
        <li>

            <a href="registro.php">registrarse</a>
        </li>
    </ul>
</body>
</html>
