<?php
    require_once "varios.php";
   
    $conexion = conectarPDO("localhost","3307","root","","agenda");
    $personas = selectContactos($conexion);
    $options = "";
    if(empty($personas)){
        header("Location: guardar-categoria.php");
        exit;
    }else{
        foreach($personas as $fila){
            $options .= "<option value=\"".$fila["id"]."\">".$fila["nombre"]." - ".$fila["apellidos"]." - ".$fila["telefono"]."</option>";
        }
        $tabla = "";
        if(isset($_POST["persona"]) && !empty($_POST["persona"])){
            $id = $_POST["persona"];
            $datos = selectPersonalizado($conexion,"select nombre, apellidos, telefono from personas where id = ?",[$id]);
            
            if(!empty($datos)){
                
                $tabla = generarTabla(["nombre","apellidos","telefono"],$datos);
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
    <h1>Ficha persona</h1>
    <p>
        <a href="index.php">Regresar</a>
    </p>
    <form action="" method="post">
        <label for="">Persona</label>
        <select name="persona" id="">
            <option value="" selected>--Selecciona--</option>
            <?= $options ?>
        </select>
        <input type="submit">
    </form>
    <br>
    <?= $tabla ?>
</body>
</html>