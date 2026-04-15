<?php
    require_once "varios.php";
    
    $conexion = conectarPDO("localhost","3307","root","","agenda");
    $html = "";
    $categorias = selectDatos($conexion,"select nombre from categorias");
    $html .= generarTabla(["categoria"],$categorias);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de categorias</title>
</head>
<body>
    <h1>Categorias</h1>
    <p>
        <a href="index.php">Regresar</a>
    </p>
    <?= $html ?>
</body>
</html>