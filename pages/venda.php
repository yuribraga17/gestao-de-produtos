<head>
	<meta charset="UTF-8">
	<title>Marcar Produto Vendido</title>
	<link rel="stylesheet" type="text/css" href="../css/venda.css">
</head>
<body>
	<div class="wrapper">
		<nav class="sidebar">
			<ul>
				<li><a href="../pages/adicionar_remover.php">Adicionar Produto</a></li>
				<li><a href="../pages/atualizar_estoque.php">Atualizar Estoque</a></li>
				<li><a href="../pages/gestao.php">Lista de Produtos</a></li>
			</ul>
		</nav>
		<div class="content">
			<header>
				<h1>Marcar Produto Vendido</h1>
			</header>
			<main>
				<?php
					// Verifica se o formulário foi enviado
					if ($_SERVER["REQUEST_METHOD"] == "POST") {
						// Obtém os dados do formulário
						$produto = $_POST['produto'];
						$quantidade = $_POST['quantidade'];

						// Conexão com o banco de dados
						$conn = mysqli_connect('localhost', 'root', '', 'gestaoprodutos');
						//include '../funcoes/funcoes.php'; // Inclui o arquivo com a função de verificação de autenticação
						//verificar_autenticacao(); // Chama a função para verificar se o usuário já está autenticado

						// Verifica se a conexão foi estabelecida com sucesso
						if(!$conn) {
							die('Erro ao conectar ao banco de dados: ' . mysqli_connect_error());
						}

						// Consulta SQL para selecionar o produto pelo nome
						$sql = "SELECT * FROM produtos WHERE nome = '$produto'";

						// Executa a consulta SQL
						$result = mysqli_query($conn, $sql);

						// Verifica se a consulta SQL foi executada com sucesso
						if(mysqli_num_rows($result) > 0) {
							// Obtém os dados do produto
							$row = mysqli_fetch_assoc($result);
							$id_produto = $row['id'];
							$estoque_atual = $row['quantidade'];

							// Verifica se a quantidade solicitada está disponível em estoque
							if ($quantidade <= $estoque_atual) {
								// Calcula o novo estoque
								$novo_estoque = $estoque_atual - $quantidade;

								// Consulta SQL para atualizar o estoque do produto
								$sql = "UPDATE produtos SET quantidade = $novo_estoque WHERE id = $id_produto";

								// Executa a consulta SQL
								if (mysqli_query($conn, $sql)) {
									// Consulta SQL para inserir a venda na tabela vendas
									$sql = "INSERT INTO vendas (id, quantidade) VALUES ($id_produto, $quantidade)";

									// Executa a consulta SQL
									if (mysqli_query($conn, $sql)) {
										echo "<p>Venda registrada com sucesso!</p>";
									} else {
										echo "<p>Erro ao registrar venda: " . mysqli_error($conn) . "</p>";
									}
								} else {
									echo "<p>Erro ao atualizar estoque: " . mysqli_error($conn) . "</p>";
								}
							} else {
								echo "<p>Não há estoque suficiente para essa venda.</p>";
							}
						} else {
							echo "<p>Produto não encontrado.</p>";
						}

						// Fechar conexão com o banco de dados
						mysqli_close($conn);
					}
					?>
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
					<label for="produto">Produto:</label>
					<input type="text" id="produto" name="produto" required>
					<label for="quantidade">Quantidade:</label>
					<input type="number" id="quantidade" name="quantidade" required>
					<button type="submit">Vender</button>
				</form>
			</main>
		</div>
	</div>
					
</body>
</html>