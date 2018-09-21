<?php
// Iniciando a sessão; 
session_start();

// Verificando de o usuario está logado
// Se não estiver logado vai para a tela de login

if (isset($_SESSION['id']) && empty($_SESSION['id']) == false) {
	echo "Area restrita...";
} else {
	header("Location: login.php");
}


 ?>