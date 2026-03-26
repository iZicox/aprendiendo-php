<?php

// funciones de utilidad
function conectarPDO($ip,$puerto,$dbname,$user,$pass):PDO {
    return new PDO("mysql:host=$ip;port=$puerto;dbname=$dbname",$user,$pass);
}

