<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Carros</title>
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

<h2>Lista de Carros</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Ano</th>
        <th>Placa</th>
        <th>Modelo</th>
        <th>Tipo</th>
        <th>Marca</th>
        <th>Disponibilidade</th>
        <th>Preço</th>
        <th>Ações</th> <!-- Nova coluna para as ações -->
    </tr>
    <?php
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

        // Consulta para obter a lista de carros
        $sql_carros = "SELECT * FROM carro";
        $stmt = $pdo->query($sql_carros);

        // Loop através dos resultados e exibição em uma tabela
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $row['id_carro'] . "</td>";
            echo "<td>" . $row['ano'] . "</td>";
            echo "<td>" . $row['placa'] . "</td>";
            echo "<td>" . $row['modelo'] . "</td>";
            echo "<td>" . $row['tipo'] . "</td>";
            echo "<td>" . $row['marca'] . "</td>";
            echo "<td>" . $row['disponibilidade'] . "</td>";
            echo "<td>" . $row['preco'] . "</td>";
            echo "<td>";
            // Adicionando links para as páginas de edição e exclusão
            echo "<a href='editar_carro.php?id=" . $row['id_carro'] . "'>Editar</a> | ";
            echo "<a href='excluir_carro.php?id=" . $row['id_carro'] . "'>Excluir</a>";
            echo "</td>";
            echo "</tr>";
        }
    } catch (PDOException $e) {
        echo "Falha ao conectar ao banco de dados. <br/>";
        die($e->getMessage());
    }
    ?>
</table>
</body>
</html>
