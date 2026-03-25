<?php

    if($_POST){
        $conexion = new PDO("mysql:host=localhost;port=3307;dbname=ejemplosphp","root","");

        $consulta = "select * from alumnos where fechanac between :inicio and :final";

        $preparacion = $conexion->prepare($consulta);

        $preparacion->execute(
            array(
                ":inicio" => $_POST["inicio"],
                ":final" => $_POST["final"]
            )
        );

        $filas = $preparacion->fetchAll(PDO::FETCH_ASSOC);

        $tabla = "";

        $tabla .= "<table border=\"1\">";
        foreach($filas as $fila){
            $tabla .= "<tr>";
            foreach($fila as $ele){
                $tabla .= "<td>".$ele."</td>";
            }
            $tabla .= "</tr>";
        }
        $tabla .= "</table>";
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
    <h1>Consulta rango de fecha</h1>
    <form action="" method="post">


        <label for="">Fecha inicial: </label>
        <input type="date" name="inicio">
        <br>

        <label for="">Fecha final: </label>
        <input type="date" name="final">
        <br>

        <input type="submit">
    </form>

    <?php 
        if(!empty($tabla)){
            
            echo "<h2>Resultado</h2>";
            echo $tabla;
        }

    
    ?>
</body>
</html>