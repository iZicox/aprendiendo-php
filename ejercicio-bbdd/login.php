<?php
    require_once  "varios.php";
    session_start();
    $conexion = conectarPDO("localhost","3307","ejemplosphp","root","");
    if($_COOKIE && !$_POST){
        $cookie = $_COOKIE;
    }
    if($_POST){
        $cookie = "el post le gana la al cookie";
        $identificador = $_POST["identificador"] ? $_POST["identificador"] : "";
        $password = $_POST["password"] ? $_POST["password"] : "";
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

            if(is_array($datos)){
                if($datos["identificador"] == $identificador){

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
                    header("Location: index.php");
                    exit;
                }
            } else{
               $invalido = "invalido"; 
            }
            
        } 
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        .invalido {
            display: none;
        }
    </style>
</head>
<body>
    <h3 class="<?= print_r(isset($invalido) ? $invalido : "") ?>">Usuario invalido</h3>
    <h1>Login</h1>
    <form action="" method="post">
        <p>
            <label for="">Identificador: </label>
            <input type="text" name="identificador">
        </p>
        <p>
            <label for="">Contraseña: </label>
            <input type="password" name="password">
        </p>
        <p>
            <input type="checkbox" name="recordar" value="1"> Recordar
        </p>
        <input type="submit">
        <input type="reset">
    </form>
    <pre>
        <?=  print_r($cookie); ?>
       
    </pre>
</body>
</html>