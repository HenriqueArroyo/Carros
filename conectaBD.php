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
    $pdo->exec($sql_cliente);


    $sql_agencia = "CREATE TABLE IF NOT EXISTS agencia(
        NUM_AGENCIA SERIAL PRIMARY KEY,
    ENDERECO VARCHAR(255) NOT NULL,
    CIDADE VARCHAR(50) NOT NULL,
    CONTATO VARCHAR(14) NOT NULL,
    ESTADO VARCHAR(50) NOT NULL)";

    echo "Tabelas criadas com sucesso!";
} catch (PDOException $e) {
    echo "Falha ao conectar ao banco de dados. <br/>";
    die($e->getMessage());
}
?>