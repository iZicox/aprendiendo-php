<?php
    require_once  "varios.php";
    session_start();
    $conexion = conectarPDO("localhost","3307","ejemplosphp","root","");
    $cookieIdentificador = isset($fetchCookie["identificador"]) ? $fetchCookie["identificador"] : "";
    $cookieContrasenna = isset($fetchCookie["contrasenna"]) ? $fetchCookie["contrasenna"] : ""; 
    if($_COOKIE && !$_POST){
        // buscar los datos para iniciar sesion con la cookie
        $plantillaBuscarCookie = "select * from usuarios where codigocookie = :idcookie";
        $cookieGuardada = $_COOKIE["recordar"] ?? "";
        $consultaConCookie = $conexion->prepare($plantillaBuscarCookie);
        $consultaConCookie->execute(
            array(
                ":idcookie" => $cookieGuardada
            )
        );
        $fetchCookie = $consultaConCookie->fetch(PDO::FETCH_ASSOC);

    }
    if($_POST){
        $identificador = isset($_POST["identificador"]) ? $_POST["identificador"]   : "";
        $password = isset($_POST["password"])           ? $_POST["password"]        : "";
        $recordar = isset($_POST["recordar"]);
        if(!empty($identificador) && !empty($password)){
            $plantillaConsulta = "select * from usuarios where identificador = :identificador";
            $consultaUsuario = $conexion->prepare($plantillaConsulta);
            $consultaUsuario->execute(
                array(
                    ":identificador" => $_POST["identificador"]
                )
            );

            $datos = $consultaUsuario->fetch();

            if(is_array($datos) && $datos["identificador"] == $identificador){



                if($recordar){

                    $plantillaGuardarCookie = "update usuarios set codigocookie = :cookie where identificador = :identificador";
                    $insertCookie = $conexion->prepare($plantillaGuardarCookie);
                    $cookieId = random_int(1,9999999999999999);
                    setcookie("recordar",$cookieId,time()+(86400*30));
                    $insertCookie->execute(
                        array(
                            ":identificador" => $_POST["identificador"],
                            ":cookie" => $cookieId
                        )
                    );

                }

                $_SESSION["autenticado"] = "T";
                header("Location: index.php");
                exit;

            } else {

                $html = <<<EOF
                    <!DOCTYPE html>
                    <html lang="en">
                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <title>Login</title>
                        <style>
                            .ocultar {
                                display: none;
                            }
                        </style>
                    </head>
                    <body>
                        <h3 class="">Usuario no encontrado</h3>
                        <h1>Login</h1>
                        <form action="" method="post">
                            <p>
                                <label for="">Identificador: </label>
                                <input type="text" name="identificador" value="">
                            </p>
                            <p>
                                <label for="">Contraseña: </label>
                                <input type="password" name="password" value="">
                            </p>
                            <p>
                                <input type="checkbox" name="recordar" value="1"> Recordar
                            </p>
                            <a href="registro.php">Click para registrarse</a>
                            <input type="submit">
                            <input type="reset">
                        </form>
                    </body>
                    </html>
                EOF;
            }
        }
    } else {
        $html = <<<EOF
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Login</title>
                <style>
                    .ocultar {
                        display: none;
                    }
                </style>
            </head>
            <body>
                <h3 class="ocultar">Usuario no encontrado</h3>
                <h1>Login</h1>
                <form action="" method="post">
                    <p>
                        <label for="">Identificador: </label>
                        <input type="text" name="identificador" value="$cookieIdentificador">
                    </p>
                    <p>
                        <label for="">Contraseña: </label>
                        <input type="password" name="password" value="$cookieContrasenna">
                    </p>
                    <p>
                        <input type="checkbox" name="recordar" value="1"> Recordar
                    </p>
                    <a href="registro.php">Click para registrarse</a>
                    <input type="submit">
                    <input type="reset">
                </form>
            </body>
            </html>
        EOF;
    }


    echo $html;
?>
