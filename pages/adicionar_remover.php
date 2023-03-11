<?php
include '../funcoes/config.php';   
include '../funcoes/funcoes.php'; // Inclui o arquivo com a função de verificação de autenticação
verificar_autenticacao(); // Chama a função para verificar se o usuário já está autenticado   
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    
    // Verifica se houve um post para adicionar um produto
    if(isset($_POST['add_produto'])) {
        $nome = $_POST['nome'];
        $descricao = $_POST['descricao'];
        $preco = $_POST['preco'];
        $quantidade = $_POST['quantidade'];
        
        // Insere o produto no banco de dados
        $sql = "INSERT INTO produtos (nome, descricao, preco, quantidade) VALUES ('$nome', '$descricao', '$preco', '$quantidade')";
        mysqli_query($conn, $sql);
    } 

    // Verifica se houve um post para remover um produto
    if(isset($_POST['remover_produto'])) {
        $id = $_POST['id'];
        
        // Remove o produto do banco de dados
        $sql = "DELETE FROM produtos WHERE id='$id'";
        mysqli_query($conn, $sql);
    }
?>

<html>
<head>
    <title>Gestão de Vendas</title>
    <link rel="stylesheet" href="../css/addrem.css">
</head>
<body>
    <div class="container">
        <h1>Gestão de Vendas</h1>
        <form method="post">
            Nome: <input type="text" name="nome"><br>
            Descrição: <input type="text" name="descricao"><br>
            Preço: <input type="text" name="preco"><br>
            Quantidade: <input type="text" name="quantidade"><br>
            <input type="submit" name="add_produto" value="Adicionar">
        </form>
        
        <hr>
        
        <h1>Remover produto</h1>
        <form method="post">
            ID: <input type="text" name="id"><br>
            <input type="submit" name="remover_produto" value="Remover">
        </form>
        
        <?php
            $sql = "SELECT * FROM produtos";
            $result = mysqli_query($conn, $sql);

            if(mysqli_num_rows($result) > 0) {
                echo "<hr><h1>Produtos</h1>";
                echo "<table>";
                echo "<tr><th>ID</th><th>Nome</th><th>Descrição</th><th>Preço</th><th>Quantidade</th></tr>";
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr><td>" . $row["id"] . "</td><td>" . $row["nome"] . "</td><td>" . $row["descricao"] . "</td><td>" . $row["preco"] . "</td><td>" . $row["quantidade"] . "</td></tr>";
                }
                echo "</table>";
            }
            
            mysqli_close($conn);
        ?>
    </div>
</body>
</html>

