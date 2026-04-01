<?php

// pagina privada que si el usuario no esta logeado oculta el contenido privado y solo muestra el link al login
// si el usuario esta logeado muestra el contenido privado
// inicio sesion
session_start();
require_once "varios.php";
// si la session esta vacia y existe una cookie
if(empty($_SESSION["autenticado"])){
    if(isset($_COOKIE["recordar"])){
        // extraer el usuario con la cookie actual en la base de datos
        $usuario = fetchUsuarioCookie($_COOKIE["recordar"] ?? "");
        if(isset($usuario) && !empty($usuario)){
            $_SESSION["autenticado"] = "T";
            $disable = "disable";
        }

    }
}
// revisar si la session existe y si tiene el valor de "T" el usuario esta logueado
if(!empty($_SESSION["autenticado"]) && $_SESSION["autenticado"] == "T"){
    $disable = "disable";
}else{ // usuario no logeado
    $disable = "";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body{
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 5rem;
            height: 100vh;
        }
        .img {
            width: 20rem;
            height: 15rem;
            background-color: red;
        }
        body section:nth-of-type(2){
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
            gap: 1rem;
        }
        h1{
            font-size: 4rem;
        }
        .block {
            width: 100vw;
            height: 100vh;
            background: rgb(0,0,0,0.6);
            backdrop-filter: blur(20px);
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .block > * {
            font-size: 3rem;
            color: white;
            font-weight: 500;
        }

        .disable {
            display: none;
        }
    </style>
</head>
<body>
    <section>
        <h1>Contenido privado</h1>
        <a href="logout.php">Log out</a>
    </section>
    <section>
        <div class="img">

        </div>
        <div class="img">

        </div>
        <div class="img">

        </div>
        <div class="img">

        </div>
        <div class="img">

        </div>
        <div class="img">

        </div>
        <div class="img">

        </div>
        <div class="img">

        </div>

    </section>

    <!-- dependiendo si el usuario esta logeado o no se mostrara este div que bloquea la vista privada -->
    <div class="block <?= $disable ?>">
        <p>Usuario no autenticado</p>
        <a href="login.php">Click para iniciar sesion</a>
        <a href="registro.php">Click para registrarse</a>
    </div>
</body>
</html>
