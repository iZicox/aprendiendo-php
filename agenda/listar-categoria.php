<?php
    require_once "varios.php";
    
    $conexion = conectarPDO("localhost","3307","root","","agenda");
    $html = "";
    $categorias = selectDatos($conexion,"select categorianombre from categorias");
    $html .= "<table border=\"1\">";
    $html .= "<tr><th>Categorias</th></tr>";
    foreach($categorias as $cat){
        $html .= "<tr>";
        foreach($cat as $dato){
            $html .= "<td>".$dato."</td>";
        }
        $html .= "</tr>";
    }
    $html .= "</table>";

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