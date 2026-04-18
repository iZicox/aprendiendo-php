<?php 
require_once "varios.php";
$conexion = conectarPDO("localhost","3307","root","","agenda");
$id = $_POST["id"] ?? "";
$nombre = $_POST["nombre"] ?? "";
$apellidos = $_POST["apellidos"] ?? "";
$telefono = $_POST["telefono"] ?? "";
$categoria = $_POST["categoria"] ?? "";



if(isset($id) && is_numeric($id)){
    // update
    $campos = [
        $nombre,$apellidos,$telefono,$categoria,$id
    ];
    $result = selectPersonalizado($conexion,"update personas 
                                            set nombre = ?, 
                                            apellidos = ?, 
                                            telefono = ?, 
                                            categoria_id = ? 
                                    where id = ?",$campos);
}else{
    // insert
    $campos = [
        $nombre,$apellidos,$telefono,$categoria
    ];
    selectPersonalizado($conexion,"insert into personas values(default,?,?,?,?)",$campos);
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
    <?= print_r($_POST) ?>
    <hr>
    <?= print_r($_GET) ?>
    <h1><?= isset($id) && is_numeric($id) ? "Contacto actualizado" : "Contacto creado" ?></h1>
    <p>
        <a href="index.php">Regresar</a>
    </p>
</body>
</html>