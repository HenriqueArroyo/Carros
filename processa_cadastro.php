<?php 
require_once 'conectaBD.php';

if (!empty($_POST)) {
    // Está chegando dados por POST e então posso tentar inserir no banco
    // Obter as informações do formulário ($_POST)
    try {
        // Preparar as informações
        // Montar a SQL (pgsql)
        $sql = "INSERT INTO cliente (nome, sobrenome, endereco, cidade, estado, email, telefone, senha) VALUES (:nome, :sobrenome, :endereco, :cidade, :estado, :email, :telefone, :senha)";
        // Preparar a SQL (pdo)
        $stmt = $pdo->prepare($sql);
        // Definir/organizar os dados p/ SQL
        $dados = array(
            ':nome' => $_POST['nome'],
            ':sobrenome' => $_POST['sobrenome'],
            ':endereco' => $_POST['endereco'],
            ':cidade' => $_POST['cidade'],
            ':estado' => $_POST['estado'],
            ':email' => $_POST['email'],
            ':telefone' => $_POST['telefone'],
            ':senha' => md5($_POST['senha']) //md5 é um padrão de criptografia
        );
        // Tentar Executar a SQL (INSERT)
        // Realizar a inserção das informações no BD (com o PHP)
        if ($stmt->execute($dados)) {
            header("Location: index.php?msgSucesso=Cadastro realizado com sucesso!");
        }
    } catch (PDOException $e) {
        //die($e->getMessage());
        header("Location: index.php?msgErro=Falha ao cadastrar...");
    }
} else {
    header("Location: index.php?msgErro=Erro de acesso.");
}
die();
// Redirecionar para a página inicial (login) c/ mensagem erro/sucesso
?>
