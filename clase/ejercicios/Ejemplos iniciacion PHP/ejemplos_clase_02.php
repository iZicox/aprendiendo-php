<?php
 // Ejemplo de constante
 define("NUM_DPTO", 18);
?>

<html>
<head>
</head>
<body>
<?php

 // Ejemplo de uso de constante
 echo "Hay " . NUM_DPTO . " departamentos.";
	
 // Tipos de variables
 
 $var = 4;
 $var = 1.25;
 $var = "hola";
 $var = true;
 $var = null;
 
 
 // Uso de variable que no está definida
 
 echo 45 + $noexiste;
 echo "Adiós";
 
 
 // Funciones de variables
 echo "Hola<br>";
 echo("Hola<br>");
 
 $var = 3.14;
 var_dump($var);
 var_dump("texto");
 
 $var = true;
 echo gettype($var);
 
 if(isset($variable))
	 echo "existe";
 else
	 echo "no existe";
 
 
 // Operador \ en cadenas
 
 echo "<img src=\"img_girl.jpg\">";
 echo '$USD 200<br>';
 echo "\$USD 200";
 

?>
</body>
</html>