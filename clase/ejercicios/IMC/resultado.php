<?php
    $flag = false;
    $altura;
    $peso;
    
    if(isset($_POST["altura"]) && isset($_POST["peso"])){
        if(empty($_POST["altura"]) && empty($_POST["peso"])){
            echo "Hay campos vacios";
        } else {
            $altura = $_POST["altura"];
            $peso = $_POST["peso"];

            if (is_numeric($altura) && is_numeric($peso)){
                if($altura <= 0 || $peso <= 0){
                    echo "Ningun valor puede ser igual o menos que cero<br>";
                } else {
                    $flag = true;
                }
            } else {
                echo "Error: Los valores deben ser numeros<br>";
            }

        }
    } else {
        echo "Error: El valor no existe";
    }

    function IMC ($peso, $altura){
        return intval($peso / ($altura**2));
    }
   
    if($flag){
        echo "El IMC es: " . IMC($peso, $altura);
    }
   

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <style>
     

        
    </style>

</head>
<body>
    <main>
        <h1></h1>
    </main>
</body>
</html>
