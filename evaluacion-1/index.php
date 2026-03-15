<?php


session_start();
if(isset($_SESSION['usuario'])){

	echo "<a href='privada.php'>Zona privada</a> <br><br>";
	echo "<a href='logout.php'>Log out</a>";
} else {
	echo "<a href='login.php'>Log in</a>";
}