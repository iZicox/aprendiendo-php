<?php

$conexion = new PDO('mysql:host=localhost;port=3307;dbname=ejemplosphp','root','');
    if(isset($_POST["nombre"]) && isset($_POST["fecha"])){
        
        $consulta = "insert into alumnos(nombre,fechanac) values(:nombre,:fecha)";
    
        $pre = $conexion->prepare($consulta);
    
        $pre->execute(
            array(
                ":nombre" => $_POST["nombre"],
                ":fecha" => $_POST["fecha"]
            )
        );
        
        
        
        
        };
        
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Agregar alumno</h1>
    <form action="" method="post">
        <p>
            <label for="">Nombre: </label>
            <input type="text" name="nombre">
        </p>
        <p>
            <label for="">Fecha nacimiento: </label>
            <input type="date" name="fecha">
        </p>
        <input type="submit" name="" id="">
    </form>

    <?php echo $htmlTabla ?>
</body>
</html>