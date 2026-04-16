<?php

    require_once "varios.php";
    
    $conexion = conectarPDO("localhost","3307","root","","agenda");
    $id = $_POST["eliminarPersona"] ?? "";
    $html = "";

    $personas = selectDatos($conexion,"select nombre, apellidos, telefono, id from personas");

    // verifica si la consulta de categorias esta vacia
    if(empty($personas)){
        // en caso de que este vacia reirigimos a guardar
        header("Location: guardar-persona.php");
        exit;
    }else{

        // si la consulta tiene datos
        // validamos si existe el post eliminarPersona que guarda el id de la categoria a eliminar
        // validamos que el post eliminar no exista para mostrar el mensaje de confirmaicon de que si se quiera eliminar
        if(     isset($_POST["eliminarPersona"]) 
            &&  !empty($_POST["eliminarPersona"]) 
            &&  !isset($_POST["eliminar"])){
            
            // guardamos el id en un input hidden
            $html = <<<EOF
            <h1>¿Estas seguro de elimar la persona?</h1>
            
            <form action="" method="post">
                <input type="hidden" name="eliminarPersona" value="$id">
                <input type="submit" name="eliminar" value="Si">
                <input type="submit" name="eliminar" value="No">
            </form>
            EOF;
            // si el post eliminar existe entramos al else
        } else {
            
            // validamos que el post eliminarPersona exista y no este vacia 
            // y que el post eliminar no este vacia y sea iguala a "SI"
            // lo que quiere decir que el usuario acepto eliminarla
            if(     (
                        isset($_POST["eliminarPersona"])  && !empty($_POST["eliminarPersona"])
                    ) 
                &&  (
                        !empty($_POST["eliminar"])           && $_POST["eliminar"] == "Si"
                    )
                ){
        
                // funcion que ejecuta un eliminar categoria y mostrar un mensaje del resultado
                eliminarContacto($conexion,$id);
                $html .= "<h3>Persona eliminada</h3>";
                
            }
        }
    
        // esta condicion permite imprimir la tabla solo cuando el post eliminar sea no 
        // o cuando el post eliminar y eliminarPersona no existan
        if((!isset($_POST["eliminar"]) 
            && !isset($_POST["eliminarPersona"])) 
        || ($_POST["eliminar"] ?? "") == "No"){

            $html .= "<table border=\"1\">";
            // nombre, apellidos, telefono, id
            $html .= "<tr> <th>Nombre</th> <th>apellidos</th> <th>telefono</th> <th>Eliminar</th> </tr>";
            foreach($personas as $fila){
                $html .= "<tr>";
                $i = 0;
                foreach($fila as $dato){
                    if($i == 3){
                        $html .= <<<EOF
                        <td>
                        <form action="" method="post">
                        <input type="hidden" name="eliminarPersona" value="$dato">
                        <input type="submit" value="Si">
                        </form>
                        </td>
                        EOF;
                    }else{
                        $html .= "<td>".$dato."</td>";
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
