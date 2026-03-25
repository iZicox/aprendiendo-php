<?php
    // importamos el codigo que nos permite conectarnos a la base de datos
    require_once "pdo.php";

    // validamos si tenemos el post de nombre, email y contraseña
    // para validar si el formulario fue enviado
    if ( isset($_POST['name']) && isset($_POST['email'])
        && isset($_POST['password'])) {

        // luego creamos la consulta para insertar un nuevo usuario en la base de datos
        // los : indican que es el campo donde se reciben los datos del usuario
        $sql = "INSERT INTO users (name, email, password)
                VALUES (:name, :email, :password)";

        // cuando recibamos el formulario mostramos la sintaxis del insert
        echo("<pre>\n".$sql."\n</pre>\n");

        // metodo para preparar la consulta en PDO
        $stmt = $pdo->prepare($sql);

        // ejecutamos la consulta
        $stmt->execute(array(
            ':name' => $_POST['name'],
            ':email' => $_POST['email'],
            ':password' => $_POST['password']));
    }
?>

<html>
    <head></head>
    <body>

        <p>Add A New User</p>

        <form method="post">

            <p>
                Nombre:
                <input type="text" name="name" size="40">
            </p>
            <p>
                Email:
                <input type="text" name="email">
            </p>
            <p>
                Password:
                <input type="password" name="password">
            </p>
            <p>
                <input type="submit" value="Add New"/>
            </p>
            </p>
        </form>
    </body>
</html>