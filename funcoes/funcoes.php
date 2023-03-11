<?php
session_start(); // Inicia a sessão

function verificar_autenticacao() {
    if(isset($_SESSION['id_usuario'])) { // Verifica se o usuário está logado
        header('Location: pages/registro.php'); // Redireciona para a página restrita
        exit();
    }
}
