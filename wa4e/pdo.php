<?php

    //conexion con la base de datos
    /**
     * CONEXION CON LA BASE DE DATOS
     * 
     * Identifica la IP y puerto
     * El nombre de la base de datos
     * Nombre del usuario
     * Clave del usuario
     */
    try{
        $pdo = new PDO('mysql:host=localhost;port=3310;dbname=misc','fred','zap');
        echo "Conexion correcta";
    }catch(PDOException $e){
        echo $e->getMessage() . "<br>";
        echo "Error en la conexion";
    }

    