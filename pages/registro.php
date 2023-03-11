<?php
// Conexão com o banco de dados
include '../funcoes/config.php';

// Verifica se a conexão foi estabelecida com sucesso
if (!$conn) {
	die('Erro ao conectar ao banco de dados: ' . mysqli_connect_error());
}

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// Obtém os valores dos campos do formulário
	$nome = mysqli_real_escape_string($conn, $_POST['nome']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$senha = mysqli_real_escape_string($conn, $_POST['senha']);
	$confirmar_senha = mysqli_real_escape_string($conn, $_POST['confirmar_senha']);

	// Verifica se a senha e a confirmação de senha são iguais
	if ($senha != $confirmar_senha) {
		echo 'As senhas não são iguais';
		exit;
	}

	// Consulta SQL para verificar se o e-mail já está registrado
	$sql = "SELECT id FROM usuarios WHERE email = '$email'";

	// Executa a consulta SQL
	$result = mysqli_query($conn, $sql);

	// Verifica se o e-mail já está registrado
	if (mysqli_num_rows($result) > 0) {
		echo 'Este e-mail já está registrado';
		exit;
	}

	// Hash da senha
	$senha_hash = password_hash($senha, PASSWORD_DEFAULT);

	// Consulta SQL para inserir o novo usuário no banco de dados
	$sql = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$senha_hash')";

	// Executa a consulta SQL
	if (mysqli_query($conn, $sql)) {
		echo 'Usuário registrado com sucesso';
	} else {
		echo 'Erro ao registrar o usuário: ' . mysqli_error($conn);
	}
}

// Fechar conexão com o banco de dados
mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Registrar - Sistema de Pedidos</title>
	<link rel="stylesheet" type="text/css" href="../css/registro.css">
</head>
<body>
	<div class="container">
		<header>
			<h1>Registrar</h1>
		</header>
		<main>
			<form action="../pages/registro.php" method="post">
				<label for="nome">Nome:</label>
				<input type="text" id="nome" name="nome" required>
                <label for="email">E-mail:</label>
			<input type="email" id="email" name="email" required>

			<label for="senha">Senha:</label>
			<input type="password" id="senha" name="senha" required>

			<label for="confirmar_senha">Confirmar senha:</label>
			<input type="password" id="confirmar_senha" name="confirmar_senha" required>

			<input type="submit" value="Registrar">
		</form>
		<p>Já tem uma conta? <a href="../pages/login.php">Faça login aqui</a></p>
	</main>
</div>
</body>
</html>
