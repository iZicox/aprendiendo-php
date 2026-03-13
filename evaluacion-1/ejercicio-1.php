<?php 


$resultado = "";
$animales = $_POST['animales'] ?? '';


if(!empty($animales)){
	foreach($animales as $animal){
	$resultado = $resultado . "<img src='./img/$animal.png' style='width: 200px; height: 200px;'>";
	
	}
}

?>


<html>
	<head></head>
	<body>
		<h1>¿Que animales quieres ver?</h1>
		<form method="post">
			<input type="checkbox" name="animales[]" value="perro"> Perro
			<input type="checkbox" name="animales[]" value="tiburon"> Tiburón
			<input type="checkbox" name="animales[]" value="leon"> León
			<input type="checkbox" name="animales[]" value="cebra"> Cebra <br>
			<input type="checkbox" name="animales[]" value="elefante"> Elefante
			<input type="checkbox" name="animales[]" value="cisne"> Cisne
			<input type="checkbox" name="animales[]" value="chimpance"> Chimpancé
			<input type="checkbox" name="animales[]" value="oso"> Oso
			
			<br><br>
			
			<input type="submit" value="Mostrar Animales">
			<input type="reset" value="Borrar Formulario">
		</form>
		
		<?php echo $resultado; ?>
		
	</body>
</html>
