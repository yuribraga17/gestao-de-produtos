<?php
// Incluir o arquivo de conexão
include '../funcoes/config.php';
include '../funcoes/funcoes.php'; // Inclui o arquivo com a função de verificação de autenticação
verificar_autenticacao(); // Chama a função para verificar se o usuário já está autenticado
// Consulta SQL para selecionar todos os produtos e a quantidade
$sql = "SELECT nome, quantidade FROM produtos";

// Executa a consulta SQL
$result = mysqli_query($conn, $sql);

// Verifica se a consulta SQL foi executada com sucesso
if (mysqli_num_rows($result) > 0) {
    // Início da tabela de produtos e quantidade
    echo "<table class='product-table'>";
    echo "<thead><tr><th>Produto</th><th>Quantidade</th></tr></thead>";
    echo "<tbody>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>".$row['nome']."</td><td>".$row['quantidade']."</td></tr>";
    }
    // Fim da tabela de produtos e quantidade
    echo "</tbody>";
    echo "</table>";
} else {
    // Caso não existam produtos cadastrados
    echo "Não existem produtos cadastrados.";
}

// Fechar conexão com o banco de dados
mysqli_close($conn);
?>
