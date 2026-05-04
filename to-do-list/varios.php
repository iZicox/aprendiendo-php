<?php

session_start();



function conexion(){
    $user = "root";
    $pass = "";
    $db = "todo";
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

if(isset($_COOKIE["token"]) && !empty($_COOKIE["token"])){
    try{
        $pdo = conexion();
        $pstmt = $pdo->prepare("select id_usuario, nombre from usuarios where cookie = ?");
        $pstmt->execute([$_COOKIE["token"]]);
        $datos = $pstmt->fetch(PDO::FETCH_ASSOC);
        if(!isset($_SESSION["id_usuario"]) || empty($_SESSION["id_usuario"])){
            $_SESSION["id_usuario"] = $datos["id_usuario"];
            $_SESSION["nombre"] = $datos["nombre"];
        }
    }catch(PDOException $e){
        die($e->getMessage());
    }
   
}

function insertarRegistro(string $nombre,string $contrasena):bool{
    try{
        $pdo = conexion();
        $query = "insert into usuarios (nombre, contrasenna) values (?,?)";
        $pstmt = $pdo->prepare($query);
        $resultado = $pstmt->execute([$nombre,$contrasena]);
        return $resultado;
    }catch(PDOException $e){
        return false;
    }
    
}

function insertarTarea(string $contenido, string $usuario):bool{
    try{
        echo "/ entro a la funcion";
        $pdo = conexion();
        $query = "insert into tareas (descripcion,id_usuario) values (?,?)";
        $pstmt = $pdo->prepare($query);
        $resultado = $pstmt->execute([$contenido,$usuario]);
        echo "/ tarea insertada";
        return $resultado;
    }catch(PDOException $e){
        return false;
    }
    
}

function nombreExiste(string $nombre):bool{
    $pdo = conexion();
    $query = "select * from usuarios where upper(nombre) = upper(?)";
    $pstmt = $pdo->prepare($query);
    $pstmt->execute([$nombre]);
    return $pstmt->fetchColumn() > 0;
}

function datosLogin(string $nombre):array|false{
    $pdo = conexion();
    $query = "select id_usuario, contrasenna from usuarios where upper(nombre) = upper(?)";
    $pstmt = $pdo->prepare($query);
    $pstmt->execute([$nombre]);
    return $pstmt->fetch(PDO::FETCH_ASSOC);
}

function guardarCookie(string $id):bool{
    $pdo = conexion();
    $token = bin2hex(random_bytes(32));
    $query = "update usuarios set cookie = ? where id_usuario = ?";
    $pstmt = $pdo->prepare($query);
    setcookie("token",$token,time() + 60*60*24);
    return $pstmt->execute([$token,$id]);
}

function datoUsuario (int $id){
    $pdo = conexion();
    $query = "select nombre from usuarios where id_usuario = ?";
    $pstmt = $pdo->prepare($query);
    $pstmt->execute([$id]);
    return $pstmt->fetch(PDO::FETCH_ASSOC);
}

function notasPorId(int $id){
    $pdo = conexion();
    $query = "select descripcion, completada, id_tarea from tareas where id_usuario = ?";
    $pstmt = $pdo->prepare($query);
    $pstmt->execute([$id]);
    return $pstmt->fetchAll(PDO::FETCH_ASSOC);
}

function completarTarea(int $id){
    $pdo = conexion();
    $query = "update tareas set completada = '1' where id_tarea = ?";
    $pstmt = $pdo->prepare($query);
    $pstmt->execute([$id]);
}

function editarTarea(string $id,string $descripcion):bool{
    $pdo = conexion();
    $query = "update tareas set descripcion = ? where id_tarea = ?";
    $pstmt = $pdo->prepare($query);
    return $pstmt->execute([$descripcion,$id]);
}

function eliminarTarea(int $id){
    $pdo = conexion();
    $query = "delete from tareas where id_tarea = ?";
    $pstmt = $pdo->prepare($query);
    $pstmt->execute([$id]);
}