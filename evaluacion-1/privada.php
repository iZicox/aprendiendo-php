<?php
session_start();

if(isset($_SESSION['usuario'])){
	echo "<a href='logout.php'>Log out</a>";
	echo "Informacion privada";
} else {
	echo "Usuario no autenticado";
	echo "<a href='login.php'>Log in</a>";
}