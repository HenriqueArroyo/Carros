<?php
// Configurações do banco de dados
$endereco = 'localhost';
$banco = 'locadora_carros';
$usuario = 'postgres';
$senha = 'postgres';

$msg = '';

// Verifica se o ID do funcionário foi fornecido na URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "ID do funcionário não fornecido.";
    exit;
}

// Capturar o ID do funcionário da URL
$id_funcionario = $_GET['id'];

// Verifica se o formulário de edição foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Coleta os dados do formulário
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $cargo = $_POST['cargo'];
    $data_contratacao = $_POST['data_contratacao'];
    $salario = $_POST['salario'];
    $num_agencia = $_POST['num_agencia'];
    $cidade = $_POST['cidade'];
    $email = $_POST['email'];

    try {
        // Conexão com o banco de dados
        $pdo = new PDO(
            "pgsql:host=$endereco;port=5432;dbname=$banco",
            $usuario,
            $senha,
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );

        // Atualiza os dados do funcionário no banco de dados
        $sql_update = "UPDATE funcionario SET nome = :nome, sobrenome = :sobrenome, cargo = :cargo, data_contratacao = :data_contratacao, salario = :salario, num_agencia = :num_agencia, cidade = :cidade, email = :email WHERE id_funcionario = :id";
        $stmt = $pdo->prepare($sql_update);
        $stmt->execute(['nome' => $nome, 'sobrenome' => $sobrenome, 'cargo' => $cargo, 'data_contratacao' => $data_contratacao, 'salario' => $salario, 'num_agencia' => $num_agencia, 'cidade' => $cidade, 'email' => $email, 'id' => $id_funcionario]);

        // Redireciona para a página de lista de funcionários após a atualização
        header("Location: listaFuncionario.php");
        exit;
    } catch (PDOException $e) {
        $msg = 'Erro ao atualizar funcionário: ' . $e->getMessage();
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

    // Consulta SQL para selecionar o funcionário com o ID fornecido
    $sql_funcionario = "SELECT * FROM funcionario WHERE id_funcionario = :id";
    $stmt = $pdo->prepare($sql_funcionario);
    $stmt->execute(['id' => $id_funcionario]);
    $funcionario = $stmt->fetch(PDO::FETCH_ASSOC);
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
    <title>Editar Funcionário</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<?php include_once 'functions.php'; ?>
    <?php navbarFuncionario(); ?>

    <h1>Editar Funcionário</h1>
    <?php if (!empty($msg)) : ?>
        <p><?php echo $msg; ?></p>
    <?php endif; ?>
    <form method="post">
        <label for="nome">Nome:</label><br>
        <input type="text" id="nome" name="nome" value="<?php echo $funcionario['nome']; ?>"><br>
        <label for="sobrenome">Sobrenome:</label><br>
        <input type="text" id="sobrenome" name="sobrenome" value="<?php echo $funcionario['sobrenome']; ?>"><br>
        <label for="cargo">Cargo:</label><br>
        <input type="text" id="cargo" name="cargo" value="<?php echo $funcionario['cargo']; ?>"><br>
        <label for="data_contratacao">Data de Contratação:</label><br>
        <input type="date" id="data_contratacao" name="data_contratacao" value="<?php echo $funcionario['data_contratacao']; ?>"><br>
        <label for="salario">Salário:</label><br>
        <input type="text" id="salario" name="salario" value="<?php echo $funcionario['salario']; ?>"><br>
        <label for="num_agencia">Número da Agência:</label><br>
        <input type="text" id="num_agencia" name="num_agencia" value="<?php echo $funcionario['num_agencia']; ?>"><br>
        <label for="cidade">Cidade:</label><br>
        <input type="text" id="cidade" name="cidade" value="<?php echo $funcionario['cidade']; ?>"><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" value="<?php echo $funcionario['email']; ?>"><br><br>
        <input type="submit" value="Salvar">
    </form>
</body>
</html>
