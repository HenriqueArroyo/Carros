<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/cadastroCliente.css">
    <title>Cadastro de Cliente</title>
</head>
<body>

    <form method="POST" action="processa_cadastro.php">
        <h1>Cadastro Cliente</h1>
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
        <input type="tel" id="phone_with_ddd" name="telefone"><br>

        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha">

        <input type="submit" value="Cadastrar">

        <a href="loginFun.php">Acesso para Funcionários</a>
    </form>
    

    <a href="index.php"><button id="voltar"  type="submit">Voltar</button></a>

<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js" integrity="sha512-0XDfGxFliYJPFrideYOoxdgNIvrwGTLnmK20xZbCAvPfLGQMzHUsaqZK8ZoH+luXGRxTrS46+Aq400nCnAT0/w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $('#phone_with_ddd').mask('(00) 0000-0000');
</script>

</body>
</html>
