<?php
// Configurações do banco de dados
$endereco_db = 'localhost';
$banco_db = 'locadora_carros';
$usuario_db = 'postgres';
$senha_db = 'postgres';
$msg = '';

// Verifica se o ID do cliente foi fornecido na URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "ID do cliente não fornecido.";
    exit;
}

// Capturar o ID do cliente da URL
$id_cliente = $_GET['id'];

// Verifica se o formulário de edição foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Coleta os dados do formulário
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $endereco_form = $_POST['endereco'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];

    try {
        // Conexão com o banco de dados
        $pdo = new PDO(
            "pgsql:host=$endereco_db;port=5432;dbname=$banco_db",
            $usuario_db,
            $senha_db,
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );

        // Atualiza os dados do cliente no banco de dados
        $sql_update = "UPDATE cliente SET nome = :nome, sobrenome = :sobrenome, endereco = :endereco, cidade = :cidade, estado = :estado, email = :email, telefone = :telefone WHERE id_cliente = :id";
        $stmt = $pdo->prepare($sql_update);
        $stmt->execute(['nome' => $nome, 'sobrenome' => $sobrenome, 'endereco' => $endereco_form, 'cidade' => $cidade, 'estado' => $estado, 'email' => $email, 'telefone' => $telefone, 'id' => $id_cliente]);

        // Redireciona para listaCliente.php após a atualização
        header("Location: listaCliente.php");
        exit;
    } catch (PDOException $e) {
        $msg = 'Erro ao atualizar cliente: ' . $e->getMessage();
    }
}

try {
    // Conexão com o banco de dados
    $pdo = new PDO(
        "pgsql:host=$endereco_db;port=5432;dbname=$banco_db",
        $usuario_db,
        $senha_db,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    // Consulta SQL para selecionar o cliente com o ID fornecido
    $sql_cliente = "SELECT * FROM cliente WHERE id_cliente = :id";
    $stmt = $pdo->prepare($sql_cliente);
    $stmt->execute(['id' => $id_cliente]);
    $cliente = $stmt->fetch(PDO::FETCH_ASSOC);
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
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<?php include_once 'functions.php'; ?>
    <?php navbarFuncionario(); ?>

    <h1>Editar Cliente</h1>
    <?php if (!empty($msg)) : ?>
        <p><?php echo $msg; ?></p>
    <?php endif; ?>
    <form method="post">
        <label for="nome">Nome:</label><br>
        <input type="text" id="nome" name="nome" value="<?php echo $cliente['nome']; ?>"><br>
        <label for="sobrenome">Sobrenome:</label><br>
        <input type="text" id="sobrenome" name="sobrenome" value="<?php echo $cliente['sobrenome']; ?>"><br>
        <label for="endereco">Endereço:</label><br>
        <input type="text" id="endereco" name="endereco" value="<?php echo $cliente['endereco']; ?>"><br>
        <label for="cidade">Cidade:</label><br>
        <input type="text" id="cidade" name="cidade" value="<?php echo $cliente['cidade']; ?>"><br>
        <label for="estado">Estado:</label><br>
        <input type="text" id="estado" name="estado" value="<?php echo $cliente['estado']; ?>"><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" value="<?php echo $cliente['email']; ?>"><br>
        <label for="telefone">Telefone:</label><br>
        <input type="text" id="telefone" name="telefone" value="<?php echo $cliente['telefone']; ?>"><br><br>
        <input type="submit" value="Salvar">
    </form>
</body>
</html>
