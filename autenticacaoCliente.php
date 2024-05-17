<?php 
require_once 'conectaBD.php';

if (!empty($_POST)) {
    // Está chegando dados por POST e então posso tentar autenticar o usuário
    // Obter as informações do formulário ($_POST)
    try {
        // Preparar a SQL para buscar o usuário no banco de dados
        $sql = "SELECT * FROM cliente WHERE email = :email AND senha = :senha";
        // Preparar a SQL (pdo)
        $stmt = $pdo->prepare($sql);
        // Definir/organizar os dados p/ SQL
        $dados = array(
            ':email' => $_POST['email'],
            ':senha' => md5($_POST['senha']) // md5 é um padrão de criptografia
        );
        // Executar a SQL (SELECT)
        $stmt->execute($dados);
        // Verificar se encontrou algum registro
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($usuario) {
            // Usuário autenticado com sucesso
            session_start();
            $_SESSION['usuario'] = $usuario;
            header("Location: indexLog.php");
        } else {
            // Usuário não encontrado ou senha incorreta
            header("Location: login.php?msgErro=Email ou senha incorretos.");
        }
    } catch (PDOException $e) {
        //die($e->getMessage());
        header("Location: login.php?msgErro=Falha ao realizar login.");
    }
} else {
    header("Location: login.php?msgErro=Erro de acesso.");
}
die();
?>
