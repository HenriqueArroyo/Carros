<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Pedidos</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<?php include_once 'functions.php'; ?>
<?php navbarFuncionario(); ?>

<h2>Filtrar Locações</h2>
<form method="GET" action="">
    
    <label for="data_locacao">Data de Locação:</label>
    <input type="date" id="data_locacao" name="data_locacao"><br><br>

    <label for="cliente">Cliente:</label>
    <input type="text" id="cliente" name="cliente"><br><br>

    <input type="submit" value="Filtrar">
</form>

<h2>Lista de Pedidos</h2>
<?php
// Conectar ao banco de dados
try {
    $pdo = new PDO("pgsql:host=localhost;dbname=locadora_carros", "postgres", "postgres");
} catch (PDOException $e) {
    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}

// Preparar a consulta SQL base
$query = "SELECT L.ID_LOCACAO, L.DATA_LOCACAO, L.DATA_DEVOLUCAO, L.VALOR_TOTAL, C.NOME AS NOME_CLIENTE, CR.MODELO AS MODELO_CARRO
          FROM Locacao L
          INNER JOIN cliente C ON L.ID_CLIENTE = C.ID_CLIENTE
          INNER JOIN carro CR ON L.ID_CARRO = CR.ID_CARRO";



if (isset($_GET['data_locacao']) && !empty($_GET['data_locacao'])) {
    $data_locacao = $_GET['data_locacao'];
    $query .= " AND L.DATA_LOCACAO = '$data_locacao'";
}

if (isset($_GET['cliente']) && !empty($_GET['cliente'])) {
    $cliente = $_GET['cliente'];
    $query .= " AND C.NOME LIKE '%$cliente%'";
}

$stmt = $pdo->query($query);

if ($stmt->rowCount() > 0) {
    echo "<table border='1'>
            <tr>
                <th>ID Locação</th>
                <th>Data Locação</th>
                <th>Data Devolução</th>
                <th>Valor Total</th>
                <th>Nome Cliente</th>
                <th>Modelo Carro</th>
                <th></th>
                <th></th>
            </tr>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . $row['id_locacao'] . "</td>";
        echo "<td>" . $row['data_locacao'] . "</td>";
        echo "<td>" . $row['data_devolucao'] . "</td>";
        echo "<td>" . $row['valor_total'] . "</td>";
        echo "<td>" . $row['nome_cliente'] . "</td>";
        echo "<td>" . $row['modelo_carro'] . "</td>";
        echo "<td><a href='editar_locacao.php?id=" . $row['id_locacao'] . "'>Editar</a></td>";
        echo "<td><a href='excluir_locacao.php?id=" . $row['id_locacao'] . "'>Excluir</a></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Não há locações cadastradas.";
}
?>
</body>
</html>
