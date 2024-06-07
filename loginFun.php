<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Funcionário</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<?php include_once 'functions.php'; ?>
    <?php navbarPadrao(); ?>
    <h1>Login - Funcionário</h1>
    <?php
    if(isset($_GET['msgErro'])) {
        echo "<p style='color:red'>{$_GET['msgErro']}</p>";
    }
    ?>
    <form method="POST" action="autenticacaoFuncionario.php">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required><br>

        <input type="submit" value="Entrar">
    </form>
</body>
</html>
