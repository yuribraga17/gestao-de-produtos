<?php
	// Conecta ao banco de dados
	$conn = mysqli_connect('localhost', 'usuario', 'senha', 'banco_de_dados');

	// Verifica se o formulário foi enviado
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// Obtém os dados do formulário
		$email = $_POST['email'];
		$senha = $_POST['senha'];
		
		// Verifica se o e-mail e a senha estão corretos
		$sql = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
		$resultado = mysqli_query($conn, $sql);

		if (mysqli_num_rows($resultado) == 1) {
			// Redireciona para a página de dashboard
			header("Location: pages/login.php");
			exit();
		} else {
			// Exibe mensagem de erro
			$erro = "E-mail ou senha inválidos.";
		}
	}

	// Fecha a conexão com o banco de dados
	mysqli_close($conn);
?>
