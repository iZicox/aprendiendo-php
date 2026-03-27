// pagina para eliminar la session y las cookies
<?php
session_start();
session_destroy();
//unset($_SESSION["autenticado"]);
setcookie("recordar","",time()-(86400*30));


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="index.php">Inicio</a>
    <a href="login.php">Iniciar sesion</a>
    <a href="registro.php">registrarse</a>
</body>
</html>
