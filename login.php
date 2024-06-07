<?php 
require 'conectaBD.php'; ?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/loginCliente.css">
    <title>Login</title>
</head>
<body>
    <?php
    if(isset($_GET['msgSucesso'])) {
        echo "<p style='color:green'>{$_GET['msgSucesso']}</p>";
    } elseif(isset($_GET['msgErro'])) {
        echo "<p style='color:red'>{$_GET['msgErro']}</p>";
    }
    ?>
    <form method="POST" action="autenticacaoCliente.php">
    <h1>Login</h1>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required><br>

        <input type="submit" value="Entrar">
        <a href="loginFun.php">Acesso para Funcionários.</a>
    </form>

    <a href="index.php"><button id="voltar" type="submit">Voltar</button></a>
</body>
</html>
