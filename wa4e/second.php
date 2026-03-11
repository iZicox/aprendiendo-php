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
    $pdo = new PDO('mysql:host=localhost;port=3310;dbname=misc','fred','zap');
    // CREACION DE LA CONSULTA
    $smt = $pdo->query("select * from users");

    $rows = $smt->fetchAll(PDO::FETCH_ASSOC);

    echo "<table border=\"1\">" . "\n";

    foreach($rows as $row){
        $i = 0;
        echo "<tr>";
        foreach($row as $item){
            if($i === 0){
                $i++;
                continue;
            }
            echo "<td>";
            echo $item;
            echo "</td>";
        }
        echo "</tr>";
    }
  