<?php
// Conexão com o banco de dados
try {
    $pdo = new PDO("pgsql:host=localhost;dbname=locadora_carros", "postgres", "postgres");
} catch (PDOException $e) {
    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Coleta os dados do formulário
    $cliente_id = $_POST['cliente_id'];
    $carro_id = $_POST['carro_id'];
    $data_locacao = $_POST['data_locacao'];
    $data_devolucao = $_POST['data_devolucao'];

    // Consulta o preço do carro
    $sql_preco_carro = "SELECT PRECO FROM Carro WHERE ID_CARRO = :carro_id";
    $stmt_preco_carro = $pdo->prepare($sql_preco_carro);
    $stmt_preco_carro->bindParam(':carro_id', $carro_id);
    $stmt_preco_carro->execute();
    $preco_carro = $stmt_preco_carro->fetchColumn();

    // Calcula o número de dias de locação
    $data_inicio = new DateTime($data_locacao);
    $data_fim = new DateTime($data_devolucao);
    $diferenca = $data_inicio->diff($data_fim);
    $dias_locacao = $diferenca->days;

    // Calcula o valor total do aluguel
    $valor_total = $dias_locacao * $preco_carro;

    // Insere os dados na tabela de locação
    $sql = "INSERT INTO Locacao (ID_CLIENTE, ID_CARRO, DATA_LOCACAO, DATA_DEVOLUCAO, VALOR_TOTAL) VALUES (:cliente_id, :carro_id, :data_locacao, :data_devolucao, :valor_total)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':cliente_id', $cliente_id);
    $stmt->bindParam(':carro_id', $carro_id);
    $stmt->bindParam(':data_locacao', $data_locacao);
    $stmt->bindParam(':data_devolucao', $data_devolucao);
    $stmt->bindParam(':valor_total', $valor_total);
    $stmt->execute();

    // Redireciona para uma página de confirmação
    header("Location: indexLog.php");
    exit();
}

// Consulta os carros disponíveis
$sql_carros = "SELECT * FROM Carro WHERE DISPONIBILIDADE = 'Disponível'";
$stmt_carros = $pdo->query($sql_carros);
$carros = $stmt_carros->fetchAll(PDO::FETCH_ASSOC);

// Consulta os clientes
$sql_clientes = "SELECT * FROM Cliente";
$stmt_clientes = $pdo->query($sql_clientes);
$clientes = $stmt_clientes->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alugar Carro</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<?php include_once 'functions.php'; ?>
    <?php navbarLogado(); ?>
    <h1>Alugar Carro</h1>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="cliente_id">Cliente:</label>
        <select name="cliente_id" id="cliente_id">
            <?php foreach ($clientes as $cliente): ?>
                <option value="<?php echo $cliente['id_cliente']; ?>"><?php echo $cliente['nome'] . ' ' . $cliente['sobrenome']; ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <label for="carro_id">Carro:</label>
        <select name="carro_id" id="carro_id">
            <?php foreach ($carros as $carro): ?>
                <option value="<?php echo $carro['id_carro']; ?>"><?php echo $carro['modelo'] . ' - ' . $carro['placa']; ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <label for="data_locacao">Data de Locação:</label>
        <input type="date" name="data_locacao" id="data_locacao" required><br><br>

        <label for="data_devolucao">Data de Devolução:</label>
        <input type="date" name="data_devolucao" id="data_devolucao" required><br><br>

        <input type="submit" value="Alugar">
    </form>
</body>
</html>
