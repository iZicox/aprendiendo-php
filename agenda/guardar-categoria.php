<?php
    require_once "varios.php";
    $conexion = conectarPDO("localhost","3307","root","","agenda");
    $id = isset($_POST["id"]) ? $_POST["id"] : "";
    $nombreCategoria = isset($_POST["nombreCategoria"]) ? $_POST["nombreCategoria"] : "";
    $descripcionCategoria = isset($_POST["descripcionCategoria"]) ? $_POST["descripcionCategoria"] : "";
    $html = "";

    $options = "";
    $categorias = selectCategorias($conexion);
    foreach($categorias as $cat){
        $options .= "<option value=\"".$cat["categoria_id"]."\">".$cat["nombre"]."</option>";
    }

    $identificadores = selectDatos($conexion, "select categoria_id from categorias");
    $idValido = true;
    foreach($identificadores as $fila){   
        if(in_array($id,$fila)){
            $idValido = false;
        }
    }
    if(!$idValido){
        $html .= "<h3>El identificador esta ocupado.</h3>";
        $id = "";
    }
        
    if(!empty($nombreCategoria) && !empty($descripcionCategoria)){
        if(empty($id)){
            //insert
            insertCategoria($conexion,[$id,$nombreCategoria,$descripcionCategoria]);
            $html .= "<h1>Categoria insertada</h1>";
        }else{
            //update
            updateCategoria($conexion,[$nombreCategoria,$descripcionCategoria,$id]);
            $html .= "<h1>Categoria actualizada</h1>";
        }


    } else{
        $html .= <<<EOF
        <form action="" method="post">
            <label for="">Identificador: </label>
            <select name="id" id="">
                <option value="" selected>Ninguna (Crea)</option>
                $options
            </select>
            <br><br>
    
            <label for="">Nombre categoria: </label>
            <input type="text" name="nombreCategoria">
            <br><br>
    
            <label for="">Descripcion categoria: </label>
            <input type="text" name="descripcionCategoria">
            <br><br>
    
            <input type="submit">
        
        </form>
        EOF;
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guardar categoria</title>
</head>
<body>
    <h1>Guardar categoria nueva</h1>
    <p>
        <a href="index.php">Regresar</a>
    </p>

    <?= $html ?>

</body>
</html>
