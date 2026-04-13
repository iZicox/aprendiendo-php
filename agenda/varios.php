<?php

function conextion($ip,$port,$user,$pass,$database){
    try {
        $conexion = new PDO("mysql:host=$ip;port=$port;dbname=$database",$user,$pass);
        $conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    
} catch(PDOException $e) {
    die("Error conexión: " . $e->getMessage());
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

function selectContactos($pdo){
    try{
        $consulta = $pdo->prepare("select 
                                        p.nombre, 
                                        p.telefono, 
                                        c.categorianombre,
                                        p.id
                                    from personas p 
                                    inner join categorias c 
                                        on c.categoria_id = p.categoria_id
                                    order by nombre");
        $consulta->execute();
        $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);

    } catch(Exception $e){
        return $e->getMessage();
    }
    return $datos;
}

function eliminarContacto($pdo,$id){
    $consulta = $pdo->prepare("delete from personas where id = ?");
    $consulta->execute([$id]);

}