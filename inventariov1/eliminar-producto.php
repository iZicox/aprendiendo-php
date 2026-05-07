<?php
require_once "varios.php";
session_start();

$id = isset($_POST["idProducto"]) ?  $_POST["idProducto"] : "";

if(empty($id)){
    header("Location: index.php");
    exit();
}

$con = conexion();
$confirmar = isset($_POST["confirmar"]) ? $_POST["confirmar"] : "";

if(!empty($confirmar)){
    if($confirmar == "Si"){
        eliminarProducto($con, $id);
    }

    header("Location: index.php");
    exit();
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
    <h1>Seguro que quieres eliminar el producto ?</h1>
    <form action="" method="post">
        <input type="hidden" value="<?= $id ?>" name="idProducto">
        <input type="submit" value="Si" name="confirmar">
        <input type="submit" value="No" name="confirmar">
    </form>

</body>
</html>
