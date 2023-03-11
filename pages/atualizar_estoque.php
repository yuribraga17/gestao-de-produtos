<?php
include '../funcoes/config.php';
include '../funcoes/funcoes.php'; // Inclui o arquivo com a função de verificação de autenticação
verificar_autenticacao(); // Chama a função para verificar se o usuário já está autenticado
    // Verificar se o formulário foi submetido
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        // Verificar se os campos foram preenchidos
        if(isset($_POST["produto"]) && isset($_POST["quantidade"])) {
            $produto_id = $_POST["produto"];
            $quantidade = $_POST["quantidade"];

            // Selecionar produto
            $sql = "SELECT quantidade FROM produtos WHERE id = '$produto_id'";
            $result = mysqli_query($conn, $sql);

            if(mysqli_num_rows($result) > 0) {
                // Atualizar quantidade
                $row = mysqli_fetch_assoc($result);
                $quantidade_atual = $row["quantidade"];
                $nova_quantidade = $quantidade_atual + $quantidade;

                $sql = "UPDATE produtos SET quantidade = '$nova_quantidade' WHERE id = '$produto_id'";
                mysqli_query($conn, $sql);

                echo "<p>Estoque atualizado com sucesso!</p>";
            } else {
                echo "<p>Produto não encontrado.</p>";
            }
        } else {
            echo "<p>Preencha todos os campos.</p>";
        }
        // Fechar conexão com o banco de dados
        mysqli_close($conn);
    }
?>
       


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Atualizar Estoque</title>
    <link rel="stylesheet" type="text/css" href="../css/attestoque.css">
</head>
<body>
    <div class="container">
        <h1>Atualizar Estoque</h1>
        <form method="post" action="../pages/atualizar_estoque.php">
            <label for="produto">Selecione o Produto:</label>
            <select id="produto" name="produto">
                <?php
                    // Conexão com o banco de dados
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "gestaoprodutos";
                    $conn = mysqli_connect($servername, $username, $password, $dbname);

                    // Selecionar produtos
                    $sql = "SELECT id, nome FROM produtos";
                    $result = mysqli_query($conn, $sql);

                    // Gerar opções de seleção
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='" . $row['id'] . "'>" . $row['nome'] . "</option>";
                    }

                    // Fechar conexão com o banco de dados
                    mysqli_close($conn);
                ?>
            </select>
            <br>
            <label for="quantidade">Quantidade:</label>
            <input type="number" id="quantidade" name="quantidade" min="1">
            <br>
            <input type="submit" value="Adicionar">
        </form>
    </div>
</body>
</html>

