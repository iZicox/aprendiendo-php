<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Editar contacto</title>
    </head>
<body>
    
<?php

    require_once "varios.php";

    $htmlSalida = "";
    
    $conexion = conectarPDO("localhost","3307","root","","agenda");
    
    $categorias = selectDatos($conexion,"select * from categorias");

    $idContacto = $_POST["editar"] ?? "";

    if(isset($idContacto) && !empty($idContacto)){
        $htmlSalida = <<<EOF
        EOF;
    }


?>
    <h1>Editar contacto</h1>
    <form action="" method="post">
        <input type="hidden" name="id" value="<?= $idContacto ?>">
        <label for="">Nombre: </label>
        <input type="text" name="nombre">
        <br><br>

        <label for="">Apellidos: </label>
        <input type="text" name="apellidos">
        <br><br>

        <label for="">Telefono: </label>
        <input type="text" name="telefono">
        <br><br>

        <label for="">Categoria: </label>
        <select name="categoria" id="">
            <?php 
                if(is_array($categorias) && !empty($categorias)){
                    foreach($categorias as $cat){
                        echo "<option value=".$cat["categoria_id"].">".$cat["categorianombre"]."</option>";

                    }
                }
            ?>   
        </select>
    </form>
</body>
</html>