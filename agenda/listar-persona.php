<?php
require_once "varios.php";

$conexion = conectarPDO("localhost", "3307", "root", "", "agenda");
$html = "";
$personas = selectContactosId($conexion);

$html .= "<table border=\"1\">";
$html .= "<tr><th>Nombre</th><th>Apellidos</th><th>Telefonos</th><th>Categoria</th><th>Accion</th></tr>";
foreach ($personas as $fila) {
    $html .= "<tr>";
    $i = 0;
    foreach ($fila as $dato) {
        if ($i == 4) {
            $html .= <<<EOF
                <td>
                    <form action="guardar-persona.php" method="get">
                        <input type="hidden" name="id" value="$dato">
                        <input type="submit" value="editar">
                    </form>
                </td>
                EOF;
        } else {
            $html .= "<td>" . $dato . "</td>";
        }
        $i++;
    }
    $html .= "</tr>";
}
$html .= "</table>";

//$html .= generarTabla(["nombre","apellidos","telefono","categoria"],$personas);
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
    <form action="guardar-persona.php" method="get">
        <input type="hidden" name="id" value="">
        <input type="submit" value="Crear nuevo">
    </form>
    <?= $html ?>

</body>

</html>