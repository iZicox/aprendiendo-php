<?php

    echo "<pre>\n";
    //conexion con la base de datos
    /**
     * CONEXION CON LA BASE DE DATOS
     * 
     * Identifica la IP y puerto
     * El nombre de la base de datos
     * Nombre del usuario
     * Clave del usuario
     */
    $pdo = new PDO('mysql:host=localhost;port=3310;dbname=misc','fred','zap');
    // CREACION DE LA CONSULTA
    $smt = $pdo->query("select * from users");
    print_r($smt);
    $rows = $smt->fetchAll(PDO::FETCH_ASSOC);
    print_r($rows);
    echo "</pre>\n";