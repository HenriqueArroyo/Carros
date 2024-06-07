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

    // Consulta SQL para selecionar todos os funcionários
    $sql = "SELECT * FROM funcionario";
    $stmt = $pdo->query($sql);
    $funcionarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Falha ao conectar ao banco de dados. <br/>";
    die($e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Funcionários</title>
    <link rel="stylesheet" href="/css/style.css">
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
</head>
<body>
<?php include_once 'functions.php'; ?>
    <?php navbarFuncionario(); ?>
    
    <h1>Lista de Funcionários</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Sobrenome</th>
                <th>Cargo</th>
                <th>Data de Contratação</th>
                <th>Salário</th>
                <th>Agência</th>
                <th>Cidade</th>
                <th>Email</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($funcionarios as $funcionario) : ?>
                <tr>
                    <td><?php echo $funcionario['id_funcionario']; ?></td>
                    <td><?php echo $funcionario['nome']; ?></td>
                    <td><?php echo $funcionario['sobrenome']; ?></td>
                    <td><?php echo $funcionario['cargo']; ?></td>
                    <td><?php echo $funcionario['data_contratacao']; ?></td>
                    <td><?php echo $funcionario['salario']; ?></td>
                    <td><?php echo $funcionario['num_agencia']; ?></td>
                    <td><?php echo $funcionario['cidade']; ?></td>
                    <td><?php echo $funcionario['email']; ?></td>
                    <td>
                        <a href="editar_funcionario.php?id=<?php echo $funcionario['id_funcionario']; ?>">Editar</a>
                        <a href="excluir_funcionario.php?id=<?php echo $funcionario['id_funcionario']; ?>" onclick="return confirm('Tem certeza que deseja excluir este funcionário?')">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
