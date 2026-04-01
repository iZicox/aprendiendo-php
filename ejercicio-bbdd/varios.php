<?php

// funciones de utilidad
function conectarPDO($ip,$puerto,$dbname,$user,$pass):PDO {
    $pdo = new PDO("mysql:host=$ip;port=$puerto;dbname=$dbname",$user,$pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
}

function fetchUsuarioCookie($cookieId){
    $conexion = conectarPDO("localhost","3307","ejemplosphp","root","");
    $consulta = "select * from usuarios where codigocookie = :codigocookie";
    $pre = $conexion->prepare($consulta);
    $pre->execute(
        [
            ":codigocookie" => $cookieId
        ]
    );
    $datos = $pre->fetch(PDO::FETCH_ASSOC);
    return $datos;
}

function insertUsuario($conexion,$identificador,$nombre,$apellidos,$contrasenna):void {
    // consulta del insert
            $plantillaRegistro = "insert into usuarios(identificador,nombre,apellidos,contrasenna) values(:identificador,:nombre,:apellidos,:contrasenna)";

            // creando la consulta y agregandole los datos del post
            $insert = $conexion->prepare($plantillaRegistro);
            $insert->execute(
                array(
                    ":identificador" => $identificador,
                    ":nombre" => $nombre,
                    ":apellidos" => $apellidos,
                    ":contrasenna" => $contrasenna
                )
            );
}
