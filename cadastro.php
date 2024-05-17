<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Cliente</title>
</head>
<body>
    <h1>Cadastro de Cliente</h1>
    <form method="POST" action="processa_cadastro.php">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br>

        <label for="sobrenome">Sobrenome:</label>
        <input type="text" id="sobrenome" name="sobrenome" required><br>

        <label for="endereco">Endereço:</label>
        <input type="text" id="endereco" name="endereco" required><br>

        <label for="cidade">Cidade:</label>
        <input type="text" id="cidade" name="cidade" required><br>

        <label for="estado">Estado:</label>
        <input type="text" id="estado" name="estado" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="telefone">Telefone:</label>
        <input type="tel" id="telefone" name="telefone"><br>

        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha">

        <input type="submit" value="Cadastrar">
    </form>
</body>
</html>
