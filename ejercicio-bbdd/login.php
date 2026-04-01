<?php
    require_once  "varios.php";
    session_start();
    // establecer conexion PDO
    $conexion = conectarPDO("localhost","3307","ejemplosphp","root","");
    // inicializar variables
    $cookieIdentificador = "";
    $cookieContrasenna = "";
    // verificar si existe la session y no este vacia 
    if(isset($_SESSION["autenticado"]) && $_SESSION["autenticado"] == "T"){

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
                    <h1>Ya estas logeado</h1>
                    <a href="logout.php">Logout</a>
                        - 
                    <a href="index.php">Inicio</a>
                </body>
                </html>
            EOF;
    }else{


        // si el post existe
        if($_POST){
            // guardar los datos del post
            $identificador = isset($_POST["identificador"]) ? $_POST["identificador"]   : "";
            $password = isset($_POST["password"])           ? $_POST["password"]        : "";
            $recordar = isset($_POST["recordar"]);
            // verificar si el usuario ya existe en la base de datos
            if(!empty($identificador) && !empty($password)){
                $plantillaConsulta = "select * from usuarios where identificador = :identificador";
                $consultaUsuario = $conexion->prepare($plantillaConsulta);
                $consultaUsuario->execute(
                    array(
                        ":identificador" => $_POST["identificador"] ?? ""
                    )
                );
    
                $datos = $consultaUsuario->fetch();
    
                // si datos se ejecuto correctamente y el identificador es igual
                if(is_array($datos) 
                    && $datos["identificador"] == $identificador
                    && $datos["contrasenna"] == $password){
                    // si recordar existe actualizar el id de cookie para este usuario
                    if($recordar){
    
                        $plantillaGuardarCookie = "update usuarios set codigocookie = :cookie where identificador = :identificador";
                        $insertCookie = $conexion->prepare($plantillaGuardarCookie);
                        $cookieId = random_int(1,9999999999999999);
                        setcookie("recordar",$cookieId,time()+(5*60));
                        $insertCookie->execute(
                            array(
                                ":identificador" => $_POST["identificador"],
                                ":cookie" => $cookieId
                            )
                        );
    
                    }
    
                    // guardar la sesion autenticado y redirigir a index.php
                    $_SESSION["autenticado"] = "T";
                    header("Location: index.php");
                    exit;
    
                } else { // si la consulta fallo porque el usuario no existe en la base de datos
    
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
                                 - 
                                <a href="index.php">Inicio</a>
                                <br><br>
                                <input type="submit">
                                <input type="reset">
                            </form>
                        </body>
                        </html>
                    EOF;
                }
            }
        } else { // si no existe post buscar cookie para rellenar el formulario
            // hacer una consulta a ver si existe la cookie
            $revisarCookie = "select * from usuarios where codigocookie = :cookie";
            $prep = $conexion->prepare($revisarCookie);            
            $prep->execute(
                array(
                    ":cookie" => $_COOKIE["recordar"] ?? ""
                )
            );
            $filaCookie = $prep->fetch(PDO::FETCH_ASSOC);
            // si todo esta bien guardar los valores de usuario
            $cookieIdentificador = is_array($filaCookie) ? $filaCookie["identificador"] : "";
            $cookieContrasenna = is_array($filaCookie) ? $filaCookie["contrasenna"] : "";


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
                         - 
                        <a href="index.php">Inicio</a>
                        <br><br>
                        <input type="submit">
                        <input type="reset">
                    </form>
                </body>
                </html>
            EOF;
        }
    }


    echo $html;
?>
