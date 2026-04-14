<?php
    require_once "varios.php";
    $conexion = conectarPDO("localhost","3307","root","","agenda");

    $categorias = selectDatos($conexion,"select categorianombre, categoria_id from categorias");
    $selectHtml = "";
    foreach($categorias as $cat){
        $selectHtml .= "<option value=\"".$cat["categoria_id"]."\">".$cat["categorianombre"]."</option>";
    }

    $idCategoria = $_POST["categoria"] ?? "";
    $personasCategoria = "";
    if(isset($idCategoria) && !empty($idCategoria)){
        if($idCategoria == "null"){
            $personasCategoria = selectDatos($conexion,"select 
                                                                p.nombre, 
                                                                p.telefono, 
                                                                c.categorianombre
                                                            from personas p 
                                                            left join categorias c 
                                                                on c.categoria_id = p.categoria_id
                                                            where p.categoria_id is null
                                                            order by p.nombre");
        }else{
            $personasCategoria = selectPersonalizadop($conexion,"select 
                                                                p.nombre, 
                                                                p.telefono, 
                                                                c.categorianombre
                                                            from personas p 
                                                            join categorias c 
                                                                on c.categoria_id = p.categoria_id
                                                            where p.categoria_id = ?
                                                            order by p.nombre",Array($idCategoria));
        }

        $tabla = "";
        if(empty($personasCategoria)){
            $tabla .= "<h3>No hay contactos en esta categoria</h3>";
        } else {
            $tabla .= "<table border=\"1\">";
            $tabla .= "<tr><th>nombre</th><th>telefono</th><th>categoria</th></tr>";
            foreach($personasCategoria as $persona){
                $tabla .= "<tr>";
                $i = 0;
                foreach($persona as $col){
                    if($i == 2 && $col == null){
                        $tabla .= "<td>Sin categoria</td>";
                    }else{
                        $tabla .= "<td>".$col."</td>";
                    }
                    $i++;
                }
                $tabla .= "</tr>";
            }
            $tabla .= "</table>";
            $tabla = !empty($tabla) ? $tabla : "";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ficha Categoria</title>
</head>
<body>
    <p>
        <a href="index.php">Regresar</a>
    </p>
    <form action="" method="post">
        <label for="">Categoria: </label>
        <select name="categoria" id="">
            <option value="" selected>--Seleccionar--</option>
            <option value="null">Sin categoria</option>
            <?= $selectHtml ?>
        </select>
        <input type="submit" value="enviar">
    </form>
    <?= $tabla ?? "" ?>
</body>
</html>