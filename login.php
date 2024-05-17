<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <?php
    if(isset($_GET['msgSucesso'])) {
        echo "<p style='color:green'>{$_GET['msgSucesso']}</p>";
    } elseif(isset($_GET['msgErro'])) {
        echo "<p style='color:red'>{$_GET['msgErro']}</p>";
    }
    ?>
    <form method="POST" action="autenticacaoCliente.php">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required><br>

        <input type="submit" value="Entrar">
    </form>
</body>
</html>
