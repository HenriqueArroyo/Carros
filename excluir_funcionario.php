<?php
// Configurações do banco de dados
$endereco = 'localhost';
$banco = 'locadora_carros';
$usuario = 'postgres';
$senha = 'postgres';

$msg = '';

// Verifica se o ID do funcionário foi fornecido na URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "ID do funcionário não fornecido.";
    exit;
}

// Captura o ID do funcionário da URL
$id_funcionario = $_GET['id'];

try {
    // Conexão com o banco de dados
    $pdo = new PDO(
        "pgsql:host=$endereco;port=5432;dbname=$banco",
        $usuario,
        $senha,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    // Exclui o funcionário com o ID fornecido
    $sql_delete = "DELETE FROM funcionario WHERE id_funcionario = :id";
    $stmt = $pdo->prepare($sql_delete);
    $stmt->execute(['id' => $id_funcionario]);

    // Redireciona para a página de lista de funcionários após a exclusão
    header("Location: listaFuncionario.php");
    exit;
} catch (PDOException $e) {
    echo 'Erro ao excluir funcionário: ' . $e->getMessage();
}
?>
