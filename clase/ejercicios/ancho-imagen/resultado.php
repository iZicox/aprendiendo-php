<?php

    $url_imagen = $_POST["enlace"];
    $valor_ancho = $_POST["ancho"];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <style>
        body {
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        div {
            display: flex;
            flex-direction: column;
            align-items: center;
            max-width: 550px;
            max-height: 500px;
            padding: 1rem;
            border-radius: 1rem;
            background-color: #2C497F;
            overflow: hidden;
        }

        h3 {
            font-size: 3rem;
            text-align: center;
            color: white;
        }
        
        img {
            width: <?= $valor_ancho ?>px;
            border-radius: 0.5rem;
        }

    </style>

</head>
<body>
    <div>
        <h3>Imagen de tamaño <?= $valor_ancho ?> </h3>
        <img src="<?= $url_imagen ?>" alt="">
    </div>
</body>
</html>
