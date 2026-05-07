<?php
require_once "varios.php";

session_start();

$usuario = $_SESSION["nombre"];
$con = conexion();
$tablaProductos = ""; 

if(isset($_SESSION["id"])){

    $listaProductos = null;
    if(isset($_POST["buscar"]) && !empty($_POST["buscar"])){
        $listaProductos = listaProductosBuscar($con,$_POST["buscar"]);
    }else{
        $listaProductos = listaProductos($con);
    }


    $tabla = "";

    if(empty($listaProductos)){
        $tabla .= "Sin datos";
    }else{
        $tabla .= "<table border=\"1\">";
        $tabla .= "<tr>";
        $tabla .= "<th>ID</th>";
        $tabla .= "<th>PRODUCTO</th>";
        $tabla .= "<th>CANTIDAD</th>";
        $tabla .= "<th>PRECIO</th>";
        $tabla .= "<th>CATEGORIA</th>";
        $tabla .= "<th>CREADO</th>";
        $tabla .= "<th>ACCIONES</th>";
        $tabla .= "</tr>";
        foreach($listaProductos as $fila){
    
            $botonEliminar = <<<EOF
            <form action="eliminar-producto.php" method="post">
                <input type="hidden" value="{$fila["id_producto"]}" name="idProducto">
                <input type="submit" value="eliminar">
            </form>
            EOF;
    
            $botonEditar = <<<EOF
            <form action="editar-producto.php" method="post">
                <input type="hidden" value="{$fila["id_producto"]}" name="idProducto">
                <input type="submit" value="editar">
            </form>
            EOF;
    
            $tabla .= "<tr>";
            $tabla .= "<td>".$fila["id_producto"]."</td>";
            $tabla .= "<td>".$fila["nombre"]."</td>";
            $tabla .= "<td>".$fila["cantidad"]."</td>";
            $tabla .= "<td>".$fila["precio"]."</td>";
            $tabla .= "<td>".$fila["categoria"]."</td>";
            $tabla .= "<td>".$fila["fecha_creacion"]."</td>";
            $tabla .= "<td>".$botonEliminar.$botonEditar."</td>";
            $tabla .= "</tr>";
        }
        $tabla .= "</table>";
    }
    echo "bien";
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
    <?php if (isset($_SESSION["id"])) { ?>
        <h1>Bienvenido <?= $usuario ?></h1>

        <p><a href="logout.php">Cerrar sesion</a></p>
        <form action="" method="post">
            <input type="search" name="buscar" placeholder="buscar producto o categoria">
            <input type="submit" value="buscar">
        </form>
        <?= $tabla ?>
    <?php } else { ?>
        <h1>Usuario no autenticado</h1>
        <p><a href="login.php">Inicia sesion</a> o <a href="registro.php">Crea un usuario</a></p>
    <?php } ?>
</body>

</html>

