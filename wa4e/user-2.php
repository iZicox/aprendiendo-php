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
    
    // creamos una consulta para mostrar todos los elementos de la tabla
    // el $pdo funciona proque importamos el codigo de pdo.php con la linea del "require_once"
    $query = $pdo->query("select name, email from users");

    // sacamos las filas en array
    $rows = $query->fetchAll(PDO::FETCH_ASSOC);

?>

<html>
    <head></head>
    <body>
        <?php
        // aqui con el $rows anterior creamos la tabla
            echo "<table border=\"1\"";
            foreach($rows as $row){
                echo "<tr>";
                foreach($row as $ele){
                    echo "<td>".$ele."</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        ?>

        <p>Add A New User</p>

        <form method="post">

            <p>
                Name:
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