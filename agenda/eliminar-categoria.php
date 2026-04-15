<?php

    require_once "varios.php";
    
    $conexion = conectarPDO("localhost","3307","root","","agenda");
    $id = $_POST["eliminarCategoria"] ?? "";
    $html = "";

    $categorias = selectDatos($conexion,"select nombre, categoria_id from categorias");

    // verifica si la consulta de categorias esta vacia
    if(empty($categorias)){
        // en caso de que este vacia reirigimos a guardar
        header("Location: guardar-categoria.php");
        exit;
    }else{

        // si la consulta tiene datos
        // validamos si existe el post eliminarCategoria que guarda el id de la categoria a eliminar
        // validamos que el post eliminar no exista para mostrar el mensaje de confirmaicon de que si se quiera eliminar
        if(     isset($_POST["eliminarCategoria"]) 
            &&  !empty($_POST["eliminarCategoria"]) 
            &&  !isset($_POST["eliminar"])){
            
            // guardamos el id en un input hidden
            $html = <<<EOF
            <h1>¿Estas seguro de elimar la categoria?</h1>
            <p>Esto puede hacer que contactos se queden sin categoria.</p>
            <form action="" method="post">
                <input type="hidden" name="eliminarCategoria" value="$id">
                <input type="submit" name="eliminar" value="Si">
                <input type="submit" name="eliminar" value="No">
            </form>
            EOF;
            // si el post eliminar existe entramos al else
        } else {
            
            // validamos que el post eliminarCategoria exista y no este vacia 
            // y que el post eliminar no este vacia y sea iguala a "SI"
            // lo que quiere decir que el usuario acepto eliminarla
            if(     (
                        isset($_POST["eliminarCategoria"])  && !empty($_POST["eliminarCategoria"])
                    ) 
                &&  (
                        !empty($_POST["eliminar"])           && $_POST["eliminar"] == "Si"
                    )
                ){
        
                // funcion que ejecuta un eliminar categoria y mostrar un mensaje del resultado
                eliminarCategoria($conexion,$id);
                $html .= "<h3>Categoria eliminada</h3>";
                
            }
        }
    
        // esta condicion permite imprimir la tabla solo cuando el post eliminar sea no 
        // o cuando el post eliminar y eliminarCategoria no existan
        if((!isset($_POST["eliminar"]) 
            && !isset($_POST["eliminarCategoria"])) 
        || ($_POST["eliminar"] ?? "") == "No"){

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
        }
        
    }


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
