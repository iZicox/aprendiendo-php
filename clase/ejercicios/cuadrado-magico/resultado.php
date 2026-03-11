<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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

        table,
        td {
            border: 1px solid;
        }

        td {
            padding: 0.5rem;
        }

        #centro {
            background-color: red;
        }
    </style>
</head>

<body>
    <main>
        <h1>Resultado</h1>




        <?php

        $numero;
        if (isset($_POST["numero"])) {
            if (empty($_POST["numero"])) {
                echo "Hay campos vacios";
            } else {
                $numero = $_POST["numero"];


                if (!is_numeric($numero)) {
                    echo "Error: Debe ser numero<br>";
                } else {


        ?>
                    <table>


                    <?php


                    $caja = array();

                    for ($i = 1; $i <= $numero; $i++) {
                        $caja[$i] = array();
                    }

                    for ($i = 1; $i <= $numero; $i++) {

                        for ($j = 1; $j <= $numero; $j++) {
                            $caja[$i][$j] = $i * $j;
                        }
                    }



                    for ($i = 1; $i <= $numero; $i++) {
                        echo "<tr>";
                        for ($j = 1; $j <= $numero; $j++) {

                            if ($i === $j) {
                                echo '<td id="centro">';
                            } else {
                                echo "<td>";
                            }


                            echo $caja[$i][$j];
                            echo "</td>";
                        }
                        echo "</tr>";
                    }
                }
                    ?>
                    </table>
            <?php
            }
        } else {
            echo "Error: El valor no existe";
        }
            ?>

    </main>
</body>

</html>