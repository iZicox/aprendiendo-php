<?php
    require_once "varios.php";
    // $ip,$port,$user,$pass,$database
    $conexion = conectarPDO("localhost","3307","root","","agenda");
    $categorias = selectCategorias($conexion);
    $options = "";
    if(empty($categorias)){
        header("Location: guardar-categoria.php");
        exit;
    }else{
        foreach($categorias as $cat){
            $options .= "<option value=\"".$cat["categoria_id"]."\">".$cat["nombre"]."</option>";
        }
        $tabla = "";
        if(isset($_POST["categoria"]) && !empty($_POST["categoria"])){
            $id = $_POST["categoria"];
            $datos = selectPersonalizado($conexion,"select nombre, descripcion from categorias where categoria_id = ?",[$id]);
            
            if(!empty($datos)){
                
                $tabla = generarTabla(["nombre","descripcion"],$datos);
            }
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
    <h1>Ficha categoria</h1>
    <p>
        <a href="index.php">Regresar</a>
    </p>
    <form action="" method="post">
        <label for="">Categoria</label>
        <select name="categoria" id="">
            <option value="" selected>--Selecciona--</option>
            <?= $options ?>
        </select>
        <input type="submit">
    </form>
    <br>
    <?= $tabla ?>
</body>
</html>