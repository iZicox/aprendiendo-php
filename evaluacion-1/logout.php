<?php


session_start();

if(isset($_SESSION['usuario'])){
	session_destroy();
	setcookie('recordar','',time()-3600);
	header("Location: index.php");
}