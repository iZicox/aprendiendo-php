<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form action="index.php" method="post">
        <p>
            <label for="">Usuario: </label>
            <input type="text" name="usuario">
        </p>
        <p>
            <label for="">Contraseña: </label>
            <input type="password" name="contraseña">
        </p>
        <p>
            <input type="checkbox" value="recordar"> Recordar
        </p>
        <input type="submit">
        <input type="reset">
    </form>
</body>
</html>