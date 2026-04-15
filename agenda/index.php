<?php 
    require_once "varios.php";
    $conexion = conectarPDO("localhost","3307","root","","agenda");
    
    if(isset($_POST["eliminar"]) && !empty($_POST["eliminar"])){
        eliminarContacto($conexion,$_POST["eliminar"]);
    }
        
    $data = selectContactos($conexion);
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        input,form{
            display: inline-block;
            margin: 0 0.25rem;
        }
        section {
            margin: 1rem 0;
        }
    </style>
</head>
<body>

    <h1>Aplicación Agenda</h1>
    <section>
        <form action="listar-categoria.php" method="post">
            <input type="hidden" name="listarCategoria" value="1">
            <input type="submit" value="Listar Categoria">
        </form>
        <form action="eliminar-categoria.php" method="post">
            <input type="submit" value="Eliminar Categoria">
        </form>
        <form action="ficha-categoria.php" method="post">
            <input type="submit" value="Ficha Categoria">
        </form>
        <form action="guardar-categoria.php" method="post">
            <input type="submit" value="Guardar Categoria">
        </form>
    </section>
    <section>
        <form action="listar-categoria.php" method="post">
            <input type="hidden" name="listarCategoria" value="1">
            <input type="submit" value="Listar Categoria">
        </form>
        <form action="eliminar-categoria.php" method="post">
            <input type="submit" value="Eliminar Categoria">
        </form>
        <form action="ficha-categoria.php" method="post">
            <input type="submit" value="Ficha Categoria">
        </form>
        <form action="guardar-categoria.php" method="post">
            <input type="submit" value="Guardar Categoria">
        </form>
    </section>
</body>
</html>