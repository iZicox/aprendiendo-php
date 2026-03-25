<?php

    // conexion
    $conexion = new PDO("mysql:host=localhost;port=3307;dbname=ejemplosphp","root","");

    
    // verificar si existe post para actualizar
    if(isset($_POST["idViejo"]) && !empty($_POST["idViejo"])){
        $consultaActualizar = "update alumnos set nombre = :nuevo where alumnoid = :idviejo";
        $preparacionActualizar = $conexion->prepare($consultaActualizar);
        $preparacionActualizar->execute(
            array(
                ":nuevo" => $_POST["nuevo"],
                ":idviejo" => $_POST["idViejo"]
            )
        );

        //imprimir la tabla

        $consultaTabla = $conexion->query("select * from alumnos");

        $registro = $consultaTabla->fetchAll(PDO::FETCH_ASSOC);

        $htmlTabla = "";

        $htmlTabla .= '<table border="1">';
        foreach($registro as $fila){
            $htmlTabla .= "<tr>";
            foreach($fila as $ele){
                $htmlTabla .= "<td>".$ele."</td>";
            }
            $htmlTabla .= "</tr>";
        }
        $htmlTabla .= "</table>";

        }

        

        // consulta para los nombres del select
        $consultaNombres = "select alumnoid, nombre from alumnos";
        $preparacionNombres = $conexion->prepare($consultaNombres);
        $preparacionNombres->execute();
        $nombres = $preparacionNombres->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Actualizar registro</h1>
    <form action="" method="post">
        <p>
            <label for="">Nombre antiguo: </label>
            <select name="idViejo" id="">
                <option>-Seleccionar-</option>
                <?php 
                    foreach($nombres as $fila){
                        echo "<option value=\"{$fila['alumnoid']}\">{$fila['nombre']}</option>";
                    }
                ?>
            </select>
        </p>

        <p>
            <label for="">Nuevo nombre: </label>
            <input type="text" name="nuevo">
        </p>

        <input type="submit">
        <input type="reset">
    </form>

    <?php 

        if(isset($_POST["nuevo"])){
            echo $htmlTabla;
            unset($htmlTabla);
        }

    ?>
</body>
</html>