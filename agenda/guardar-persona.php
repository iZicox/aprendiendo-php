<?php
    require_once "varios.php";
    $conexion = conectarPDO("localhost","3307","root","","agenda");
    $categorias = selectCategorias($conexion);
    $nuevo = true;
    $html = "";

    if(isset($_GET["id"]) && is_numeric($_GET["id"])){
        // update
        $id = $_GET["id"];
        $nuevo = false;
        $datosPersona = selectPersonalizado($conexion,"select 
                                                            p.id as id,
                                                            p.nombre as nombre, 
                                                            p.apellidos as apellidos,
                                                            p.telefono as telefono, 
                                                            c.categoria_id as categoria_id,
                                                            c.nombre as categoria
                                                        from personas p 
                                                        left join categorias c 
                                                            on c.categoria_id = p.categoria_id
                                                        where p.id = ?",[$id])[0];
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
    <h1><?= $nuevo ? "Crear " : "Actualizar " ?>Contacto</h1>
    <p>
        <a href="index.php">Regresar</a>
    </p>
    <form action="procesar-persona.php" method="post">

        <input type="hidden" name="id" value="<?= $nuevo ? "" : $datosPersona["id"] ?>">

        <label for="">Nombre: </label>
        <input type="text" name="nombre" value="<?= $nuevo ? "" : $datosPersona["nombre"] ?>">
        <br><br>

        <label for="">Apellidos: </label>
        <input type="text" name="apellidos" value="<?= $nuevo ? "" : $datosPersona["apellidos"] ?>">
        <br><br>

        <label for="">Telefono</label>
        <input type="text" name="telefono" value="<?= $nuevo ? "" : $datosPersona["telefono"] ?>">
        <br><br>

        <label for="">Categoria: </label>
        <select name="categoria" id="">
        <?php 
        if($nuevo){
            echo "<option value=\"\" selected>--Seleccionar--</option>";
            foreach($categorias as $cat){ 
                echo "<option value=\"".$cat["categoria_id"]."\">".$cat["nombre"]."</option>";
            }
        }else{
            foreach($categorias as $cat){
                if($cat["categoria_id"] == $datosPersona["categoria_id"]){
                     echo "<option value=\"".$cat["categoria_id"]."\" selected>".$cat["nombre"]."</option>";
                }else{
                    echo "<option value=\"".$cat["categoria_id"]."\">".$cat["nombre"]."</option>";
                }
            }
        }
        
        ?>
            
        </select>
        <br><br>

        <input type="submit" value="<?= $nuevo ? "Crear" : "Actualizar" ?>">

    </form>
</body>
</html>