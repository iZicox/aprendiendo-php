<?php
    require_once "varios.php";
    
    $conexion = conectarPDO("localhost","3307","root","","agenda");
    $html = "";
    $personas = selectContactos($conexion);
    $html .= generarTabla(["nombre","apellidos","telefono","categoria"],$personas);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de personas</title>
</head>
<body>
    <h1>Personas</h1>
    <p>
        <a href="index.php">Regresar</a>
    </p>
    <?= $html ?>
</body>
</html>