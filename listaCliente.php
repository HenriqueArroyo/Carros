<?php
// Configurações do banco de dados
$endereco = 'localhost';
$banco = 'locadora_carros';
$usuario = 'postgres';
$senha = 'postgres';

$msg = '';

// Verifica se foi solicitada a exclusão de um cliente
if (isset($_GET['delete'])) {
    $cliente_id = $_GET['delete'];
    
    try {
        // Exclui o cliente com o ID fornecido
        $sql_delete = "DELETE FROM cliente WHERE id_cliente = :id";
        $stmt = $pdo->prepare($sql_delete);
        $stmt->execute(['id' => $cliente_id]);
        
        // Define mensagem de sucesso
        $msg = 'Cliente excluído com sucesso.';
    } catch (PDOException $e) {
        // Caso ocorra algum erro
        $msg = 'Erro ao excluir cliente: ' . $e->getMessage();
    }
}

try {
    // Conexão com o banco de dados
    $pdo = new PDO(
        "pgsql:host=$endereco;port=5432;dbname=$banco",
        $usuario,
        $senha,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    // Consulta SQL para selecionar todos os clientes
    $sql = "SELECT * FROM cliente";
    $stmt = $pdo->query($sql);
    $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <title>Lista de Clientes</title>
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
<nav>
        <img id="logo" src="/img/SENAI-CAR-sem-fundo.png" alt="Logo">
        <div class="link">
         <a href="/index.php" id="registrar">Sair</a>
         
        </div>
    </nav>
    <div class="nav2">
        <a href="">Pedidos</a>
        <a href="/listaCliente.php">Clientes</a>
        <a href="">Funcionarios</a>
        <a href="">Carros</a>
    </div>
    <h1>Lista de Clientes</h1>
    <?php if (!empty($msg)) : ?>
        <p><?php echo $msg; ?></p>
    <?php endif; ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Sobrenome</th>
                <th>Endereço</th>
                <th>Cidade</th>
                <th>Estado</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clientes as $cliente) : ?>
                <tr>
                    <td><?php echo $cliente['id_cliente']; ?></td>
                    <td><?php echo $cliente['nome']; ?></td>
                    <td><?php echo $cliente['sobrenome']; ?></td>
                    <td><?php echo $cliente['endereco']; ?></td>
                    <td><?php echo $cliente['cidade']; ?></td>
                    <td><?php echo $cliente['estado']; ?></td>
                    <td><?php echo $cliente['email']; ?></td>
                    <td><?php echo $cliente['telefone']; ?></td>
                    <td>
                        <a href="editar_cliente.php?id=<?php echo $cliente['id_cliente']; ?>">Editar</a>
                        <a href="?delete=<?php echo $cliente['id_cliente']; ?>" onclick="return confirm('Tem certeza que deseja excluir este cliente?')">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
