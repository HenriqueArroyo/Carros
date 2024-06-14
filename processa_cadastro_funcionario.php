<?php
// Configurações do banco de dados
$endereco = 'localhost';
$banco = 'locadora_carros';
$usuario = 'postgres';
$senha = 'postgres';

try {
    // Conexão com o banco de dados
    $pdo = new PDO(
        "pgsql:host=$endereco;port=5432;dbname=$banco",
        $usuario,
        $senha,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    // Dados do formulário
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $cargo = $_POST['cargo'];
    $data_contratacao = $_POST['data_contratacao'];
    $salario = $_POST['salario'];
    $num_agencia = $_POST['num_agencia'];
    $cidade = $_POST['cidade'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Preparar e executar a consulta SQL para inserir o funcionário
    $stmt = $pdo->prepare("INSERT INTO funcionario (nome, sobrenome, cargo, data_contratacao, salario, num_agencia, cidade, email, senha) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$nome, $sobrenome, $cargo, $data_contratacao, $salario, $num_agencia, $cidade, $email, $senha]);

    // Redirecionar para uma página de sucesso
    header("Location: indexFun.php");
    exit();
} catch (PDOException $e) {
    // Se houver algum erro, exibir uma mensagem de erro
    echo "Erro ao cadastrar o funcionário: " . $e->getMessage();
}
?>
