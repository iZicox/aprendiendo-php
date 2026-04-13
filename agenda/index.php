<?php 
    require_once "varios.php";
    $conexion = conextion("localhost","3307","root","","agenda");
    
    if(isset($_POST["eliminar"]) && !empty($_POST["eliminar"])){
        eliminarContacto($conexion,$_POST["eliminar"]);
    }
        
    $data = selectContactos($conexion);
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <h1>Agenda</h1>
    <button>Listar categorias</button>
    <button>Elminar categorias</button>
    <button>Crear categorias</button>
    <button>Actualizar categorias</button>
    <ul>
    <section>
        <?php 
        if(is_array($data) && !empty($data)){
            $filas = ["nombre","telefono","categoria"];
            echo "<table border=\"1\">";
            echo "<tr><td>nombre</td><td>telefono</td><td>categoria</td><td>accion</td></tr>";
            for($i = 0; $i < sizeof($data); $i++){
                echo "<tr>";
                $j = 0;
                foreach($data[$i] as $fila){
                    if($j == 3){
                        echo "<td>";
                        $html = <<<EOF
                        <form action="" method="post">
                            <input type="hidden" name="eliminar" value="$fila">
                            <input type="submit" value="eliminar">
                        </form>
                        EOF;
                        echo $html;
                        echo "</td>";
                    }else{
                        echo "<td>";
                        echo $fila;
                        echo "</td>";
                    }
                    $j++;                 
                    
                }
                echo "</tr>";
            }
            echo "</table>";

        } else {
            echo "<h3>No hay datos</h3>";
        }
        
        ?>
    </section>
    
</body>
</html>