<?php

function conectarPDO($ip,$port,$user,$pass,$database){
    try {
        $conexion = new PDO("mysql:host=$ip;port=$port;dbname=$database",$user,$pass);
        $conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        return "Error conexión: " . $e->getMessage();
    }
    return $conexion;
}

function selectCategorias($pdo){
    try{
        $consulta = $pdo->prepare("select * from categorias");
        $consulta->execute();
        $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);

    } catch(Exception $e){
        echo $e->getMessage();
    }
    return $datos;
}

function selectContactosConId($pdo){
    try{
        $consulta = $pdo->prepare("select 
                                        p.id as id
                                        p.nombre as nombre, 
                                        p.apellidos as apellidos,
                                        p.telefono as telefono, 
                                        c.nombre as categoria
                                    from personas p 
                                    left join categorias c 
                                        on c.categoria_id = p.categoria_id
                                    order by p.nombre");
        $consulta->execute();
        $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);

    } catch(Exception $e){
        return $e->getMessage();
    }
    return $datos;
}
function selectContactos($pdo){
    try{
        $consulta = $pdo->prepare("select 
                                        p.nombre as nombre, 
                                        p.apellidos as apellidos,
                                        p.telefono as telefono, 
                                        c.nombre as categoria
                                    from personas p 
                                    left join categorias c 
                                        on c.categoria_id = p.categoria_id
                                    order by p.nombre");
        $consulta->execute();
        $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);

    } catch(Exception $e){
        return $e->getMessage();
    }
    return $datos;
}

function selectContactosId($pdo){
    try{
        $consulta = $pdo->prepare("select 
                                        p.nombre as nombre, 
                                        p.apellidos as apellidos,
                                        p.telefono as telefono, 
                                        c.nombre as categoria,
                                        p.id as id
                                    from personas p 
                                    left join categorias c 
                                        on c.categoria_id = p.categoria_id
                                    order by p.nombre");
        $consulta->execute();
        $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);

    } catch(Exception $e){
        return $e->getMessage();
    }
    return $datos;
}

function selectPersonalizado($pdo,$query,$campos){
    try{
        $consulta = $pdo->prepare($query);
        $consulta->execute($campos);
        $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);

    } catch(PDOException $e){
        return $e->getMessage();
    }
    return $datos;
}

function selectDatos($pdo,$query){
    try{
        $consulta = $pdo->prepare($query);
        $consulta->execute();
        $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e){
        return $e->getMessage();
    }
    return $datos;
}

function eliminarContacto($pdo,$id){
    $consulta = $pdo->prepare("delete from personas where id = ?");
    $consulta->execute([$id]);

}

function eliminarCategoria($pdo,$id){
    
        $consultaPersonas = $pdo->prepare("update personas set categoria_id = null where categoria_id = ?");
        $consultaPersonas->execute([$id]);

        $consulta = $pdo->prepare("delete from categorias where categoria_id = ?");
        $consulta->execute([$id]);
}


function insertCategoria($pdo,$campos){
    try{
        $query = $pdo->prepare("insert into categorias values(?,?,?)");
        $query->execute($campos);
        return null;
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}

function updateCategoria($pdo,$datos){
    try{
     
        $query = $pdo->prepare("update categorias set nombre = ?, descripcion = ? where categoria_id = ?");
        $query->execute($datos);
        return null;
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}

/**
 * Generador de tabla
 * 
 * @param array $titulos array de titulos
 * @param array #datos array de los datos de la query
 */
function generarTabla($titulos,$datos){
    $resultado = "";
    $resultado .= "<table border=\"1\">";
    // titulos
    $resultado .= "<tr>";
    foreach($titulos as $titulo){
        $resultado .= "<th>".$titulo."</th>";
    }
    $resultado .= "</tr>";
    // contenido
    foreach($datos as $fila){

        $resultado .= "<tr>";
        foreach($fila as $dato){
            $resultado .= "<td>".$dato."</td>";
        }
        $resultado .= "</tr>";
    }
    $resultado .= "</table>";

    return $resultado;
    
}