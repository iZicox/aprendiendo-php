<?php

	session_start();

	//validar post
	$user = $_POST['usuario'] ?? ($_COOKIE['usuario'] ?? '');
	$pass = $_POST['password'] ?? ($_COOKIE['password'] ?? '');

	//guardar cookies
	if(isset($_POST['recordar'])){
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
			if(isset($_POST['usuario'])){
				if($loginValido){
					$_SESSION['usuario'] = $user;
					$_SESSION['pasword'] = $pass;
					header("Location: privada.php");exit;
				} else {
					echo "Login invalido";
				}
			}
			
		?>
	
		<form method="post">
			<label>Usuario: </label>
			<input type="text" name="usuario" value="<?php echo $user ?>"><br>
			
			<label>Contraseña: </label>
			<input type="password" name="password" value="<?php echo $pass ?>"><br>
			
			<input type="checkbox" name="recordar" value="recordar"> Recordar<br>
			
			<input type="submit">
		</form>
	
	</body>
</html>
