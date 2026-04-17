<?php
    require_once "varios.php";
    $conexion = conectarPDO("localhost","3307","root","","agenda");
    
    $nuevo = true;
    $html = "";

    if(isset($_GET["id"]) && is_numeric($_GET["id"])){
        // update
        $id = $_GET["id"];
        $nuevo = false;
        $datosPersona = selectPersonalizado($conexion,"select 
                                                            p.id as id
                                                            p.nombre as nombre, 
                                                            p.apellidos as apellidos,
                                                            p.telefono as telefono, 
                                                            c.nombre as categoria
                                                        from personas p 
                                                        left join categorias c 
                                                            on c.categoria_id = p.categoria_id
                                                        where p.id = ?",[$id]);
    }

    print_r($datosPersona);

    if($nuevo){

    }else{
        
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
    <form action="procesar-persona.php" method="post">
        <label for="">Nombre: </label>
        <input type="text" name="nombre">
        <br><br>

        <label for="">Apellidos: </label>
        <input type="text" name="apellidos">
        <br><br>

        <label for="">Telefono</label>
        <input type="text" name="telefono">

        <select name="categoria" id="">
            <option value=""></option>
        </select>

    </form>
</body>
</html>