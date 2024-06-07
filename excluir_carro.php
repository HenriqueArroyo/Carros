<?php
// Verificar se o ID do carro foi fornecido na URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "ID do carro não fornecido.";
    exit;
}

// Capturar o ID do carro da URL
$id_carro = $_GET['id'];

// Excluir o carro do banco de dados
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

    // Excluir o carro usando uma instrução SQL preparada
    $sql_excluir_carro = "DELETE FROM carro WHERE id_carro = :id";
    $stmt = $pdo->prepare($sql_excluir_carro);
    $stmt->bindParam(':id', $id_carro);
    $stmt->execute();

    // Redirecionar para listaCarros.php após a exclusão
    header("Location: listaCarro.php");
    exit;
} catch (PDOException $e) {
    echo "Falha ao conectar ao banco de dados. <br/>";
    die($e->getMessage());
}
?>
