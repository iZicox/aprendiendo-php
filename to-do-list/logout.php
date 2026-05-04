<?php
require_once "varios.php";
$_SESSION = [];
session_destroy();

foreach($_COOKIE as $nombre => $valor){
    setcookie($nombre, "", time()-3600);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="index.php">index</a>
</body>
</html>
