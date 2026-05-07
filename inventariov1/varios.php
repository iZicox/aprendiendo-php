<?php

function conexion(): PDO{
    $user = "root";
    $pass = "";
    $db = "inventariov1";
    $ip = "localhost";
    $port = "3307";
    try{
        $pdo = new PDO("mysql:host=$ip;port=$port;dbname=$db",$user,$pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        throw $e;
    }
}

function registro (PDO $pdo, string $usuario, string $password): bool {
    if(!usuarioExiste($pdo, $usuario)){
        $query = "insert into usuarios values(default,?,?)";
        $pstmt = $pdo->prepare($query);
        return $pstmt->execute([$usuario,$password]);
    }
    return false;
}

function usuarioExiste(PDO $pdo, string $usuario): bool {
    $query = "select * from usuarios where username = ?";
    $pstmt = $pdo->prepare($query);
    $pstmt->execute([$usuario]);
    return $pstmt->rowCount() > 0;
}

function login(PDO $pdo, string $usuario, string $password): array|string{
    try{
        $query = "select * from usuarios where username = ? and password = ?";
        $pstmt = $pdo->prepare($query);
        $pstmt->execute([$usuario, $password]);
        return $pstmt->fetch(PDO::FETCH_ASSOC);
    }catch(PDOException $e){
        return "";
    }
    
}

function guardarCookie(PDO $pdo, int $id){
    $token = random_bytes(32);
    $query = "update usuarios set cookie = ? where id = ?";
    $pstmt = $pdo->prepare($query);
    $pstmt->execute([$token,$id]);
    setcookie("token",$token,time()+60*60*24*30);
}


function listaProductos (PDO $pdo){
    $query = "select 
                    p.id as id_producto, 
                    p.nombre, 
                    p.cantidad, 
                    p.precio, 
                    c.id as id_categoria ,
                    c.nombre as categoria, 
                    p.fecha_creacion 
                from productos p 
                join categorias c 
                    on c.id = p.categoria_id;";
    $pstmt = $pdo->prepare($query);
    $pstmt->execute();
    return $pstmt->fetchAll(PDO::FETCH_ASSOC);
}

function listaProductosBuscar (PDO $pdo, $string){
    $query = "select 
                    p.id as id_producto, 
                    p.nombre, 
                    p.cantidad, 
                    p.precio, 
                    c.id as id_categoria ,
                    c.nombre as categoria, 
                    p.fecha_creacion 
                from productos p 
                join categorias c 
                    on c.id = p.categoria_id
                where p.nombre like ? or c.nombre like ?;";
    $pstmt = $pdo->prepare($query);
    $parametro = "%".$string."%";
    $pstmt->execute([$parametro,$parametro]);
    return $pstmt->fetchAll(PDO::FETCH_ASSOC);
}

function eliminarProducto(PDO $pdo, int $id){
    $query = "delete from productos where id = ?";
    $pstmt = $pdo->prepare($query);
    return $pstmt->execute([$id]);
}

function selectProductoPorId(PDO $pdo, int $id){
    $query = "select 
                    p.id as id_producto, 
                    p.nombre, 
                    p.cantidad,
                     p.precio, 
                     c.id as id_categoria ,
                     c.nombre as categoria, 
                     p.fecha_creacion 
                from productos p 
                join categorias c 
                    on c.id = p.categoria_id where p.id = ?";
    $pstmt = $pdo->prepare($query);
    $pstmt->execute([$id]);
    return $pstmt->fetch(PDO::FETCH_ASSOC);
}
/**
 * +--------------------+---------------+------+-----+---------------------+----------------+
*| Field              | Type          | Null | Key | Default             | Extra          |
*+--------------------+---------------+------+-----+---------------------+----------------+
*| id                 | int(11)       | NO   | PRI | NULL                | auto_increment |
*| nombre             | varchar(255)  | NO   |     | NULL                |                |
*| cantidad           | int(11)       | NO   |     | 0                   |                |
*| precio             | decimal(10,2) | NO   |     | NULL                |                |
*| fecha_creacion     | datetime      | YES  |     | current_timestamp() |                |
*| categoria_id       | int(11)       | YES  | MUL | NULL                |                |
*| fecha_modificacion | datetime      | YES  |     | NULL                |                |
*+--------------------+---------------+------+-----+---------------------+----------------+
 */

function actualizarProducto(PDO $pdo, $nombre, $cantidad, $precio, $idCategoria, $idProducto){
    try{
        $query = "update productos 
                    set nombre = ?,
                        cantidad = ?,
                        precio = ?,
                        categoria_id = ?,
                        fecha_modificacion = sysdate()
                    where id = ?";
        $pstmt = $pdo->prepare($query);
        return $pstmt->execute([$nombre,(int)$cantidad,(float)$precio,(int)$idCategoria,(int)$idProducto]);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    

}


function listarCategorias(PDO $pdo){
    $query = "select * from categorias";
    $pstmt = $pdo->prepare($query);
    $pstmt->execute();
    return $pstmt->fetchAll(PDO::FETCH_ASSOC);
}