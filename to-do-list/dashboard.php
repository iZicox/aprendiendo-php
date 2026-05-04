<?php
    require_once "varios.php";

    if(!isset($_SESSION["id_usuario"])){
        echo "no esta autenticado";
        exit;
    }

    try{

        if(isset($_POST["completar"]) && !empty($_POST["completar"])){
            completarTarea($_POST["completar"]);
        }
    
        if(isset($_POST["eliminar"]) && !empty($_POST["eliminar"])){
            eliminarTarea($_POST["eliminar"]);
        }

        if(isset($_POST["idTarea"]) && isset($_POST["descripcionNota"]) && !empty($_POST["idTarea"])){
            //editar
            editarTarea($_POST["idTarea"],$_POST["descripcionNota"]);
        }
    
        if(empty($_POST["idTarea"]) && !empty($_POST["descripcionNota"])){
            //crear
            insertarTarea($_POST["descripcionNota"],$_SESSION["id_usuario"]);
        }
    }catch(PDOException $e){
        die($e->getMessage());
    }

    $datos = notasPorId($_SESSION["id_usuario"]);

    $opciones = "";
    foreach($datos as $fila){
        $id = $fila["id_tarea"];
        $descripcion = $fila["descripcion"];
        $opciones .= "<option value=".$id.">".$descripcion."</option>";
        
    }

    $tabla = "";
    if(!empty($datos)){
        $tabla .= "<table border=\"1\"";
        $tabla .= "<tr><th>descripcion</th><th>completada</th><th>accion</th></tr>";
        foreach($datos as $fila){
            $tabla .= "<tr>";
            $i = 0;
            foreach($fila as $campo){
                if($i == 2){
                    $tabla .= "<td>";
                    $tabla .= <<<EOF
                    <form action="" method="post">
                        <input type="hidden" name="completar" value="$campo">
                        <input type="submit" value="completar">
                    </form>
                    <form action="" method="post">
                        <input type="hidden" name="eliminar" value="$campo">
                        <input type="submit" value="eliminar">
                    </form>
                    EOF;
                    $tabla .= "</td>";
                }else{
    
                    $tabla .= "<td>".$campo."</td>";
                }
                $i++;
            }
            $tabla .= "</tr>";
        }
        $tabla .= "</table>";
    }else{
        $tabla = "sin tareas";
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
    <h1>Dashboard</h1>
    <a href="index.php">Regresar</a>
    <form action="" method="post">
        <label for="">Nota: </label>
        <select name="idTarea" id="">
            <option value="">--Crear--</option>
            <?= $opciones ?>
        </select>
        <br><br>

        <label for="">Descripcion: </label>
        <input type="text" name="descripcionNota">
        <br><br>

        <input type="submit">
    </form>

    <br><br>
    <?= $tabla ?>
</body>
</html>

