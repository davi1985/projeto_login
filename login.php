<?php
//Iniciando sessão; 
session_start();
//Verificando dados de login no data-base;
if (isset($_POST['email']) && empty($_POST['email']) == false) {
	$email = addslashes($_POST['email']);
	$senha = md5(addslashes($_POST['senha']));

	//Metodo PDO de conexção com o data-base;
	$dsn = "mysql:dbname=blog;host=localhost";
	$dbuser = "root";
	$dbpass = "";

	try {
		$db = new POD($dsn,$dbuser,$dbpass);
		
		//Verificando se há dados disponiveis no data-base;
		$sql = $db->query("SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'");
		
		//Se houver algum dado igual ao informado pelo usuario ele vai permitir o acesso;
		if($sql->rowCount() > 0) {
			$dado = $sql->fetch();
			print_r($dado);

			$_SESSION['id'] = $dado['id'];
			header("Location: index.php");
		}	
	} 
	//Se a conexão falhar vai aparecer a mensagem de erro;
	catch (PDOException $e) {
		echo "Falhou".$e->getMessage();	
	}	
}
 ?>
<style>
	.login {
		margin: 0 auto;
		background: #ccc;
		text-align: center;
		padding: 100px;
		width: 75%;
		font-family: sans-serif;
		color: #555;
	}
	input {
		padding: 5px;
		border: none;
		margin: 5px;
		text-align: center;
		width: 250px;
		border-radius: 5px;	

	}
	input[type=submit] {
		padding: 10px;
		width:150px;
		background: #abc;
	}
	input[type=submit]:hover {
		background: #abc555;
	}
</style>
<div class="login">
	<h2>PÁGINA DE LOGIN</h2>

	<form method="POST">

		Email:<br>
		<input type="email" name="email"><br><br>
		Senha:<br>
		<input type="password" name="senha"><br><br>

		<input type="submit" value="Entrar">

	</form>
</div>
