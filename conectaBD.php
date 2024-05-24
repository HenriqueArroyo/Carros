<?php
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

    // Criação da tabela cliente
    $sql_cliente = "CREATE TABLE IF NOT EXISTS cliente (
    ID_CLIENTE SERIAL PRIMARY KEY,
    NOME VARCHAR(100) NOT NULL,
    SOBRENOME VARCHAR(50) NOT NULL,
    ENDERECO VARCHAR(255) NOT NULL,
    CIDADE VARCHAR(50) NOT NULL,
    ESTADO VARCHAR(50) NOT NULL,
    EMAIL VARCHAR(255) NOT NULL,
    TELEFONE VARCHAR(14),
    SENHA VARCHAR(255)
    )";
    $pdo->exec($sql_cliente);

    $sql_carros = "CREATE TABLE IF NOT EXISTS carro (
         ID_CARRO SERIAL PRIMARY KEY,
    ANO INT NOT NULL,
    PLACA INT NOT NULL,
    MODELO VARCHAR(30) NOT NULL,
    TIPO VARCHAR(100) NOT NULL,
    MARCA VARCHAR(50) NOT NULL,
    DISPONIBILIDADE VARCHAR(20) NOT NULL
        )";
    $pdo->exec($sql_carros);


    $sql_agencia = "CREATE TABLE IF NOT EXISTS agencia(
    NUM_AGENCIA SERIAL PRIMARY KEY,
    ENDERECO VARCHAR(255) NOT NULL,
    CIDADE VARCHAR(50) NOT NULL,
    CONTATO VARCHAR(14) NOT NULL,
    ESTADO VARCHAR(50) NOT NULL)";
    $pdo->exec($sql_agencia);


    $sql_inserir_agencias = "INSERT INTO agencia (ENDERECO, CIDADE, CONTATO, ESTADO) VALUES
    ('Rua Carlos Gomes, 123', 'Limeira', '(19) 1234-5678', 'São Paulo'),
    ('Rua da Luz, 456', 'Piracicaba', '(19) 9876-5432', 'São Paulo')";
    $pdo->exec($sql_inserir_agencias);






    $sql_funcionario = "CREATE TABLE IF NOT EXISTS funcionario(
    ID_FUNCIONARIO SERIAL PRIMARY KEY,
    NOME VARCHAR(50) NOT NULL,
    SOBRENOME VARCHAR(50),
    CARGO VARCHAR(50),
    DATA_CONTRATACAO DATE NOT NULL,
    SALARIO NUMERIC,
    NUM_AGENCIA INT,
    CIDADE VARCHAR(50) NOT NULL,
    EMAIL VARCHAR(255) NOT NULL,
    SENHA VARCHAR(255),
    FOREIGN KEY(NUM_AGENCIA) REFERENCES Agencia (NUM_AGENCIA))
    ";
    $pdo->exec($sql_funcionario);
     
     // Inserção de um usuário padrão
     $nome_padrao = "Admin";
     $sobrenome_padrao = "Admin";
     $cargo_padrao = "Administrador";
     $data_contratacao_padrao = date('Y-m-d');
     $salario_padrao = 5000.00;
     $num_agencia_padrao = 1; // Supondo que o id da agência padrão seja 1
     $cidade_padrao = "Cidade";
     $email_padrao = "admin@example.com";
     $senha_padrao = password_hash("admin123", PASSWORD_DEFAULT); // Senha padrão criptografada
 
     $stmt = $pdo->prepare("INSERT INTO funcionario (nome, sobrenome, cargo, data_contratacao, salario, num_agencia, cidade, email, senha) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
     $stmt->execute([$nome_padrao, $sobrenome_padrao, $cargo_padrao, $data_contratacao_padrao, $salario_padrao, $num_agencia_padrao, $cidade_padrao, $email_padrao, $senha_padrao]);


    echo "Tabelas criadas com sucesso!";
} catch (PDOException $e) {
    echo "Falha ao conectar ao banco de dados. <br/>";
    die($e->getMessage());
}
?>