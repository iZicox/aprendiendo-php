<?php

	session_start();
	
	//validar post
	$user = $_POST['usuario'] ?? '';
	$pass = $_POST['password'] ?? '';

	//guardar cookies
	if(isset($_POST['recodar'])){
		setcookie('usuario',$user,time()+60*2);
		setcookie('password',$pass,time()+60*2);
	} 
	
	//bd usuarios
	$usuarios = 
	[
		[
			"usuario" => "juan",
			"password" => "123"
		],
		[
			"usuario" => "pedro",
			"password" => "admin123"
		],
		[
			"usuario" => "root",
			"password" => "456"
		]
	];
	
	//flag login
	$loginValido = false;
	
	
	//validar usario con el array
	if(isset($user)){
	
		foreach($usuarios as $usuario){
		if(($usuario["usuario"] == $user) &&
			($usuario["password"] == $pass)){
			
			$loginValido = true;
			
			}
		}		
	}
	
	
	
	
	
?>

<html>
	<head></head>
	<body>
		
		<?php
			if(!$loginValido && isset($_POST['usuario'])){
				echo "Login invalido";
			} else {
				$_SESSION['usuario'] = $user;
				$_SESSION['paswordd'] = $pass;
				header("Location: privada.php");
			}
			
		?>
	
		<form method="post">
			<label>Usuario: </label>
			<input type="text" name="usuario"><br>
			
			<label>Contraseña: </label>
			<input type="password" name="password"><br>
			
			<input type="checkbox" name="recordar" value="recordar"> Recordar<br>
			
			<input type="submit">
		</form>
	
	</body>
</html>
