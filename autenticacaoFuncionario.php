<?php
require_once 'conectaBD.php';
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

    // Verifica se os campos foram submetidos
    if(isset($_POST['email']) && isset($_POST['senha'])) {
        // Consulta SQL para verificar as credenciais
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $stmt = $pdo->prepare("SELECT * FROM funcionario WHERE email = ?");
        $stmt->execute([$email]);
        $funcionario = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verifica se o funcionário existe e se a senha está correta
        if($funcionario && password_verify($senha, $funcionario['senha'])) {
            // Autenticação bem-sucedida
            session_start();
            $_SESSION['id_funcionario'] = $funcionario['id_funcionario'];
            $_SESSION['nome_funcionario'] = $funcionario['nome'];
            $_SESSION['cargo_funcionario'] = $funcionario['cargo'];
            // Redireciona para a página inicial do funcionário
            header("Location: indexFun.php");
            exit();
        } else {
            // Autenticação falhou - redireciona de volta para a página de login com mensagem de erro
            header("Location: indexFun.php");
            exit();
        }
    } else {
        // Se os campos não foram submetidos, redireciona para a página de login
        header("Location: indexFun.php");
        exit();
    }
} catch (PDOException $e) {
    echo "Falha ao conectar ao banco de dados. <br/>";
    die($e->getMessage());
}
?>
