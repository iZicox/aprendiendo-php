<?php

    $ciudad = trim($_POST['ciudad'] ?? '');
   
    if ($ciudad === '') {
        echo "No escribistes nada.";
        exit;
    }

    $ciudad_url = urlencode($ciudad);
    $enlace = "https://www.google.com/search?q=" . $ciudad_url;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* Reset básico */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Fuente y fondo de la página */
        body {
            font-family: Arial, Helvetica, sans-serif;
            line-height: 1.6;
            background-color: #f9f9f9;
            color: #333;
            padding: 2rem;
        }

        /* Título principal */
        h1 {
            font-size: 2.2rem;
            color: #2c3e50;
            margin-bottom: 1rem;
            text-align: center;
        }

        /* Párrafos */
        p {
            margin-bottom: 1rem;
            font-size: 1.1rem;
        }

        /* Texto resaltado (ciudad) */
        strong {
            color: #e74c3c;
        }

        /* Enlace a Google */
        a {
            color: #2980b9;
            text-decoration: none;
            font-weight: bold;
            border-bottom: 2px solid transparent;
            transition: border-color 0.2s, color 0.2s;
        }

        a:hover {
            color: #1abc9c;
            border-bottom-color: #1abc9c;
        }

        /* Contenedor centrado (opcional) */
        body > div {
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

    </style>
</head>
<body>
    <h1>Resultado</h1>

    <p>Tu ciudad favorita es: <strong><?php echo htmlspecialchars($ciudad); ?></strong></p>

    <p>
        Puedes verla en Google aquí:  
        <a href="<?php echo $enlace; ?>" target="_blank">Buscar "<?php echo htmlspecialchars($ciudad); ?>"</a>
    </p>

   


</body>
</html>
