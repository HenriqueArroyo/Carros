<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Funcionário</title>
</head>
<body>
    <h1>Cadastro de Funcionário</h1>
    <form method="POST" action="processa_cadastro_funcionario.php">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br>

        <label for="sobrenome">Sobrenome:</label>
        <input type="text" id="sobrenome" name="sobrenome" required><br>

        <label for="cargo">Cargo:</label>
        <input type="text" id="cargo" name="cargo" required><br>

        <label for="data_contratacao">Data de Contratação:</label>
        <input type="date" id="data_contratacao" name="data_contratacao" required><br>

        <label for="salario">Salário:</label>
        <input type="number" id="salario" name="salario" step="0.01" required><br>

        <label for="num_agencia">Número da Agência:</label>
        <input type="number" id="num_agencia" name="num_agencia" required><br>

        <label for="cidade">Cidade:</label>
        <input type="text" id="cidade" name="cidade" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha" required><br>

        <input type="submit" value="Cadastrar">
    </form>
</body>
</html>
