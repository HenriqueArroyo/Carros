<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatórios da Locadora</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<?php include_once 'functions.php'; ?>
<?php navbarFuncionario(); ?>

<?php
$endereco = 'localhost';
$banco = 'locadora_carros';
$usuario = 'postgres';
$senha = 'postgres';

try {
    // Conexão com o banco de dados
    $pdo = new PDO("pgsql:host=$endereco;dbname=$banco", $usuario, $senha);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Encontre o cliente que mais alugou veículos
    $sql_cliente_mais_alugou = "SELECT c.nome, COUNT(l.id_locacao) as total_locacoes
                                FROM cliente c
                                LEFT JOIN locacao l ON c.id_cliente = l.id_cliente
                                GROUP BY c.nome
                                ORDER BY total_locacoes DESC
                                LIMIT 1";
    $stmt = $pdo->query($sql_cliente_mais_alugou);
    $cliente_mais_alugou = $stmt->fetch(PDO::FETCH_ASSOC);

    echo "<h3>Cliente que mais alugou veículos:</h3>";
    if ($cliente_mais_alugou) {
        echo "Nome: " . $cliente_mais_alugou['nome'] . "<br>";
        echo "Total de Locações: " . $cliente_mais_alugou['total_locacoes'] . "<br>";
    } else {
        echo "Nenhum cliente encontrado.";
    }

    // Calcule a receita total da locadora em um determinado período
    $sql_receita_total = "SELECT SUM(valor_total) as receita_total
                          FROM locacao";
    $stmt = $pdo->query($sql_receita_total);
    $receita_total = $stmt->fetch(PDO::FETCH_ASSOC);

    echo "<h3>Receita total da locadora:</h3>";
    if ($receita_total) {
        echo "Receita Total: R$ " . $receita_total['receita_total'];
    } else {
        echo "Nenhuma receita encontrada.";
    }

    // Identifique os carros que nunca foram alugados
    $sql_carros_nunca_alugados = "SELECT *
                                   FROM carro c
                                   LEFT JOIN locacao l ON c.id_carro = l.id_carro
                                   WHERE l.id_locacao IS NULL";
    $stmt = $pdo->query($sql_carros_nunca_alugados);
    $carros_nunca_alugados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<h3>Carros que nunca foram alugados:</h3>";
    if ($carros_nunca_alugados) {
        echo "<ul>";
        foreach ($carros_nunca_alugados as $carro) {
            echo "<li>" . $carro['modelo'] . " (" . $carro['marca'] . ")</li>";
        }
        echo "</ul>";
    } else {
        echo "Todos os carros foram alugados.";
    }

    $sql_clientes_multi_aluguel = "SELECT c.nome, COUNT(DISTINCT l.id_carro) as total_carros_alugados
    FROM cliente c
    INNER JOIN locacao l ON c.id_cliente = l.id_cliente
    GROUP BY c.nome
    HAVING COUNT(DISTINCT l.id_carro) > 1";
$stmt = $pdo->query($sql_clientes_multi_aluguel);
$clientes_multi_aluguel = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<h3>Clientes que alugaram mais de um carro:</h3>";
if ($clientes_multi_aluguel) {
echo "<ul>";
foreach ($clientes_multi_aluguel as $cliente) {
echo "<li>" . $cliente['nome'] . " (Total de Carros Alugados: " . $cliente['total_carros_alugados'] . ")</li>";
}
echo "</ul>";
} else {
echo "Nenhum cliente alugou mais de um carro.";
}


} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>
</body>
</html>
