<?php



if(!isset($_POST)){
    $htmlSalida = <<<EOF
    <h1>Busqueda en la tabla Alumnos</h1>
    <form action="" method="post">
    <label forname="LIKE">Parametro de busqueda</label>
    <input type="text" name="LIKE">
    <input type="submit" value="buscar">
    </form>
    EOF;
    } else {
        $patron = "%" . $_REQUEST['LIKE'] . "%";
        
        unset($_REQUEST);
        
        try{
            
            $conexion = new PDO("mysql:host=localhost;port=3307;dbname=ejemplosphp;charset=utf8","root", "");

            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $consulta = "select * from alumnos where nombre like :patron";
            $alumnos = $conexion->prepare($consulta);

            $alumnos->execute([":patron"] -> $patron);

            if($alumnos == false){
                print_r("\t<p>Error en la consulta: <b>" . $conexion->errorInfo()[2] . "</b>\n");
            } else {
                echo "<table border=\"1\">";
                foreach($alumnos as $alumno) {
                    echo "<tr>";
                    foreach($alumno as $ele){
                        echo "<td>" . $ele . "</td>";   
                    }
                    echo "<tr>";
                }
                echo "</table>";
            }
    } catch(Exception $e ){
        echo $e->getMessage();
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
</body>
</html>