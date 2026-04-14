<?php

    require_once "varios.php";
    
    $conexion = conectarPDO("localhost","3307","root","","agenda");
    $id = $_POST["eliminarCategoria"] ?? "";
    if(isset($_POST["eliminarCategoria"]) && !empty($_POST["eliminarCategoria"]) && !isset($_POST["eliminar"])){
        
        $html = <<<EOF
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
        </head>
        <body>
            
            <h1>¿Estas seguro de elimar la categoria?</h1>
            <p>Esto puede hacer que contactos se queden sin categoria.</p>
            <form action="" method="post">
                <input type="hidden" name="eliminarCategoria" value="$id">
                <input type="submit" name="eliminar" value="Si">
                <input type="submit" name="eliminar" value="No">
            </form>
        </body>
        </html>
        EOF;
        echo "post eliminarCategoria: " . $_POST["eliminarCategoria"];
        echo $html;
        exit;
    } 

    if(     (
                isset($_POST["eliminarCategoria"])  && !empty($_POST["eliminarCategoria"])
            ) 
        &&  (
                !empty($_POST["eliminar"])           && $_POST["eliminar"] == "Si"
            )
        ){

        
        eliminarCategoria($conexion,$id);
        
    }

    $html = "";
    $categorias = selectDatos($conexion,"select categorianombre, categoria_id from categorias");
    $html .= "<table border=\"1\">";
    $html .= "<tr><th>Categorias</th><th>Eliminar</th></tr>";
    foreach($categorias as $cat){
        $html .= "<tr>";
        $i = 0;
        foreach($cat as $dato){
            if($i == 0){
                $html .= "<td>".$dato."</td>";
            }else{
                $html .= <<<EOF
                <td>
                <form action="" method="post">
                    <input type="hidden" name="eliminarCategoria" value="$dato">
                    <input type="submit" value="Si">
                </form>
                </td>
                EOF;
            }
            $i++;
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
    <title>Eliminar categoria</title>
</head>
<body>
    <h1>Eliminar categorias</h1>
    <p>
        <a href="index.php">Regresar</a>
    </p>
    <?= $html ?>
</body>
</html>
