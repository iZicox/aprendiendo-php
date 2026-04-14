<?php
    $id = $_POST["id"] ?? "";
    $nombreCategoria = $_POST["nombreCategoria"] ?? "";

    if(!empty($id) && !empty($nombreCategoria)){
        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guardar categoria</title>
</head>
<body>
    <h1>Guardar categoria nueva</h1>
    <p>
        <a href="index.php">Regresar</a>
    </p>
    <form action="" method="post">
        <label for="">Identificador: </label>
        <input type="text" name="id">
        <br><br>

        <label for="">Nombre categoria: </label>
        <input type="text" name="nombreCategoria">
        <br><br>

        <input type="submit">
    
    </form>
</body>
</html>