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
        }

        body {
            height: 100vh;   
            display: flex;
            justify-content: center;
            align-items: center; 
        }

        div {
            width: 20rem;
            height: 10rem;
            background-color: #d4a373;
            border-radius: 2rem;
            padding: 1rem;
            box-shadow: 0px 10px 30px 15px #00000027;

            display: flex;
            align-items: center;
            justify-content: center;
        }

        h3 {
            font-size: 3rem;
            color: #fefae0;
        }
    </style>
</head>
<body>
    <div>
        <h3>
            <?php

                $numero_1 = $_GET['primero'];
                $numero_2 = $_GET['segundo'];

                //verificar si esta vacio
                if (empty($numero_1) || empty($numero_2)) {
                    echo "Esta vacio";
                    exit;
                }

                // validar si son numeros
                if(!(is_numeric($numero_1) || is_numeric($numero_2))){
                    echo "El valor no es un numero";
                    exit;
                }

                echo $numero_1 . " + " . $numero_2 . " = " . ($numero_1 + $numero_2);
                    
           
            ?>
        </h3>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>