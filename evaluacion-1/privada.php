<?php
session_start();

if(isset($_SESSION['usuario'])){
	echo "<a href='login.php'>Log in</a>";
	
}