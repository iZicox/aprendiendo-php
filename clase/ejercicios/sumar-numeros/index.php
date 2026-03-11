<?php

/*pide dos numeros
los suma
comprobar que los ha pasado
metodo get
comprobar que son numeros is_numeric*/

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100vw;
            height: 100vh;
        }

        main {
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 2rem;
            width: 30rem;
            height: 30rem;
            background-color: #d4a373;
            border-radius: 2.5rem;
            padding: 2rem;
            box-shadow: 5px 5px 30px 2px #78583771;
        }

        main > h3:nth-of-type(1) {
            font-size: 3rem;
            text-align: center;
        }

        main div > label {
            font-size: 1.2rem;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1rem;
        }

        form > div:nth-of-type(1), form > div:nth-of-type(2) {
            display: flex;
            gap: 0.5rem;
        }
        
        input[type="number"] {
            border: none;
            border-radius: 2rem;
            background-color: #fefae0;
            text-align: center;
            appearance: textfield;
            -webkit-appearance: none;
            -moz-appearance: textfield;

        
        }

        input[type="submit"] {
            margin-top: 1.5rem;
            border: none;
            background-color: #fefae0;
            width: 50%;
            border-radius: 1rem;
            padding: 0.7rem;
            width: 8rem;
            box-shadow: 0 5px 15px 2px #00000056;
            font-weight: 800;
        }

    </style>
</head>
<body>
    <main>

        <h3>Suma dos numeros</h3>
        <form action="resultado.php" method="get">
            <div>
                <label for="">Ingresa el primer numero:</label>
                <input type="number" name="primero">
            </div>
            <div>
                <label for="">Ingresa el segundo numero:</label>
                <input type="number" name="segundo">
            </div>
            <input type="submit" value="Enviar">
        </form>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>