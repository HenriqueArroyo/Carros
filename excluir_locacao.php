<?php
// Verificar se o ID da locação foi fornecido
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "ID da locação não fornecido.";
    exit;
}

// Conectar ao banco de dados
try {
    $pdo = new PDO("pgsql:host=localhost;dbname=locadora_carros", "postgres", "postgres");
} catch (PDOException $e) {
    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}

// Recuperar o ID da locação da URL
$id_locacao = $_GET['id'];

// Verificar se a locação existe
$query = "SELECT * FROM Locacao WHERE ID_LOCACAO = :id_locacao";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':id_locacao', $id_locacao);
$stmt->execute();

if ($stmt->rowCount() == 0) {
    echo "Locação não encontrada.";
    exit;
}

// Excluir a locação do banco de dados
$query = "DELETE FROM Locacao WHERE ID_LOCACAO = :id_locacao";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':id_locacao', $id_locacao);

if ($stmt->execute()) {
    echo "Locação excluída com sucesso.";
    header('location: listaPedidos.php');
} else {
    echo "Erro ao excluir a locação.";
}
?>
