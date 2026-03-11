<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100vw;
            height: 100vh;
            
        }

        main {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 1rem;
        }

        h1 {
            font-size: 3rem;
        }

        p {
            font-size: 2rem;
        }
</style>
<body>
    <main>
        <h1>Resultado</h1>
        <div>
            <p>


<?php
    $temp;
    $a_convertir;
    
    function convertirTemp ($temp, $a_convertir){
        
    
        if($a_convertir == "celcius"){
            return round(($temp - 32) * (5/6),2) . " C°";
        }
    
        return round(($temp * (9/5)) + 32,2) . " F°";
    }
    
    if(isset($_POST["temp"]) && isset($_POST["a_convertir"])){
        if(empty($_POST["temp"]) && empty($_POST["a_convertir"])){
            echo "Hay campos vacios";
        } else {
            $temp = $_POST["temp"];
            $a_convertir = $_POST["a_convertir"];

            if (!is_numeric($temp)){
                echo "Error: La temperatura debe ser numero<br>";   
            }

            echo "La temperatura a convertida es de: " . convertirTemp($temp, $a_convertir);
        }
    } else {
        echo "Error: El valor no existe";
    }

    ?>


            </p>
        </div>
    </main>
</body>
</html>