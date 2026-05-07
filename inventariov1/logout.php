<?php
require_once "varios.php";
session_start();
$_SESSION = [];

session_destroy();

setcookie("token","",time()-60*60*24);

header("Location: login.php");
