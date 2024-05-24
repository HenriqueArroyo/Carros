<?php
// Verifica se o ID do cliente foi passado via GET
if (!isset($_GET['id'])) {
    header("Location: listar_clientes.php"); // Redireciona para a página de listagem de clientes
    exit();
}

// Configurações do banco de dados
$endereco = 'localhost';
$banco = 'locadora_carros';
$usuario = 'postgres';
$senha = 'postgres';

// Obtém o ID do cliente da URL
$cliente_id = $_GET['id'];

// Variável para armazenar mensagens de sucesso ou erro após a edição
$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Dados do formulário
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $endereco = $_POST['endereco'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];

    try {
        // Conexão com o banco de dados
        $pdo = new PDO(
            "pgsql:host=$endereco;port=5432;dbname=$banco",
            $usuario,
            $senha,
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );

        // Atualiza os dados do cliente no banco de dados
        $sql_update = "UPDATE cliente SET NOME = :nome, SOBRENOME = :sobrenome, ENDERECO = :endereco, CIDADE = :cidade, ESTADO = :estado, EMAIL = :email, TELEFONE = :telefone WHERE ID_CLIENTE = :id";
        $stmt = $pdo->prepare($sql_update);
        $stmt->execute(['nome' => $nome, 'sobrenome' => $sobrenome, 'endereco' => $endereco, 'cidade' => $cidade, 'estado' => $estado, 'email' => $email, 'telefone' => $telefone, 'id' => $cliente_id]);

        // Define mensagem de sucesso
        $msg = 'Dados do cliente atualizados com sucesso.';
    } catch (PDOException $e) {
        // Caso ocorra algum erro
        $msg = 'Erro ao atualizar dados do cliente: ' . $e->getMessage();
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

    // Consulta SQL para selecionar os dados do cliente com o ID fornecido
    $sql = "SELECT * FROM cliente WHERE ID_CLIENTE = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $cliente_id]);
    $cliente = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifica se o cliente existe
    if (!$cliente) {
        // Caso o cliente não exista, redireciona para a página de listagem de clientes
        header("Location: listar_clientes.php");
        exit();
    }
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
    <title>Editar Cliente</title>
</head>
<body>
    <h1>Editar Cliente</h1>
    <?php if (!empty($msg)) : ?>
        <p><?php echo $msg; ?></p>
    <?php endif; ?>
    <form method="POST">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="<?php echo $cliente['nome']; ?>" required><br>

        <label for="sobrenome">Sobrenome:</label>
        <input type="text" id="sobrenome" name="sobrenome" value="<?php echo $cliente['sobrenome']; ?>" required><br>

        <label for="endereco">Endereço:</label>
        <input type="text" id="endereco" name="endereco" value="<?php echo $cliente['endereco']; ?>" required><br>

        <label for="cidade">Cidade:</label>
        <input type="text" id="cidade" name="cidade" value="<?php echo $cliente['cidade']; ?>" required><br>

        <label for="estado">Estado:</label>
        <input type="text" id="estado" name="estado" value="<?php echo $cliente['estado']; ?>" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $cliente['email']; ?>" required><br>

        <label for="telefone">Telefone:</label>
        <input type="tel" id="telefone" name="telefone" value="<?php echo $cliente['telefone']; ?>"><br>

        <input type="submit" value="Atualizar">
    </form>
</body>
</html>
