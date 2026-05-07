<?php

require_once "varios.php";

session_start();

$id = isset($_POST["idProducto"]) ? $_POST["idProducto"] : "";
echo $id;
if(empty($id)){
    header("Location: index.php");
    exit();
}

$con = conexion();

$producto = selectProductoPorId($con, $id);

if(isset($_POST["actualizar"])){

    $nombre=""; $cantidad=""; $precio=""; $idCategoria="";

    if(!isset($_POST["nombre"]) || empty($_POST["nombre"])){
        $nombre = $producto["nombre"];
    }else{
        $nombre = $_POST["nombre"];
    }

    if(!isset($_POST["cantidad"]) || empty($_POST["cantidad"])){
        $cantidad = $producto["cantidad"];
    }else{
        $cantidad = $_POST["cantidad"];
    }

    if(!isset($_POST["precio"]) || empty($_POST["precio"])){
        $precio = $producto["precio"];
    }else{
        $precio = $_POST["precio"];
    }

    if(!isset($_POST["idCategoria"]) || empty($_POST["idCategoria"])){
        $idCategoria = $producto["id_categoria"];
    }else{
        $idCategoria = $_POST["idCategoria"];
    }

    actualizarProducto($con, $nombre, $cantidad, $precio, $idCategoria, $id);

    header("Location: index.php");
    exit();
}


$categorias = listarCategorias($con);

$opcionesCategoria = "";



foreach($categorias as $fila){
    if($fila["id"] == $producto["id_categoria"]){
        $opcionesCategoria .= <<< EOF
            <option value="{$fila["id"]}" selected>{$fila["nombre"]}</option>
        EOF;
    }else{
        $opcionesCategoria .= <<< EOF
            <option value="{$fila["id"]}">{$fila["nombre"]}</option>
        EOF;
        
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
    <form action="" method="post">

        <input type="hidden" name="idProducto" value="<?= $id ?>">
        <input type="hidden" name="actualizar" value="1">

        <label for="">Nombre: </label>
        <input type="text" value="<?= $producto["nombre"] ?>" name="nombre">
        <br><br>

        <label for="">Cantidad: </label>
        <input type="text" value="<?= $producto["cantidad"] ?>" name="cantidad">
        <br><br>

        <label for="">Precio: </label>
        <input type="text" value="<?= $producto["precio"] ?>" name="precio">
        <br><br>

        <label for="">Categoria: </label>
        <select name="idCategoria" id="">
            <option value="">--elegir--</option>
            <?= $opcionesCategoria ?>
        </select>
        <br><br>

        <input type="submit">

    </form>
</body>
</html>