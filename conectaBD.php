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

    $sql_check_clientes = "SELECT COUNT(*) FROM cliente";
    $stmt_check_clientes = $pdo->query($sql_check_clientes);
    $clientes_existe = $stmt_check_clientes->fetchColumn();

    if ($clientes_existe == 0) {
        // Inserção de clientes padrão
        $sql_inserir_clientes = "INSERT INTO cliente (NOME, SOBRENOME, ENDERECO, CIDADE, ESTADO, EMAIL, TELEFONE, SENHA) VALUES
        ('Maria', 'Silva', 'Rua das Flores, 123', 'São Paulo', 'São Paulo', 'maria@example.com', '(11) 9876-5432', '" . password_hash("senha123", PASSWORD_DEFAULT) . "'),
        ('João', 'Santos', 'Avenida das Palmeiras, 456', 'Rio de Janeiro', 'Rio de Janeiro', 'joao@example.com', '(21) 1234-5678', '" . password_hash("senha456", PASSWORD_DEFAULT) . "'),
        ('Ana', 'Oliveira', 'Travessa dos Pinheiros, 789', 'Belo Horizonte', 'Minas Gerais', 'ana@example.com', '(31) 3698-1357', '" . password_hash("senha789", PASSWORD_DEFAULT) . "'),
        ('Pedro', 'Ferreira', 'Rua dos Cedros, 321', 'Curitiba', 'Paraná', 'pedro@example.com', '(41) 8523-7412', '" . password_hash("senha321", PASSWORD_DEFAULT) . "'),
        ('Luciana', 'Ribeiro', 'Avenida dos Ipês, 654', 'Porto Alegre', 'Rio Grande do Sul', 'luciana@example.com', '(51) 2468-1478', '" . password_hash("senha654", PASSWORD_DEFAULT) . "'),
        ('Carlos', 'Silveira', 'Rua das Pedras, 987', 'São Paulo', 'São Paulo', 'carlos@example.com', '(11) 7654-3210', '" . password_hash("senha987", PASSWORD_DEFAULT) . "'),
        ('Fernanda', 'Oliveira', 'Avenida das Árvores, 234', 'Rio de Janeiro', 'Rio de Janeiro', 'fernanda@example.com', '(21) 5678-9012', '" . password_hash("senha234", PASSWORD_DEFAULT) . "'),
        ('Rafael', 'Santos', 'Travessa das Flores, 876', 'Belo Horizonte', 'Minas Gerais', 'rafael@example.com', '(31) 2468-9753', '" . password_hash("senha876", PASSWORD_DEFAULT) . "'),
        ('Mariana', 'Ferreira', 'Rua das Palmeiras, 543', 'Curitiba', 'Paraná', 'mariana@example.com', '(41) 3698-0246', '" . password_hash("senha543", PASSWORD_DEFAULT) . "'),
        ('Gabriel', 'Souza', 'Avenida dos Cedros, 210', 'Porto Alegre', 'Rio Grande do Sul', 'gabriel@example.com', '(51) 1357-8024', '" . password_hash("senha210", PASSWORD_DEFAULT) . "'),
        ('Laura', 'Carvalho', 'Rua dos Ipês, 345', 'São Paulo', 'São Paulo', 'laura@example.com', '(11) 8024-5678', '" . password_hash("senha345", PASSWORD_DEFAULT) . "'),
        ('Guilherme', 'Almeida', 'Avenida das Pedras, 678', 'Rio de Janeiro', 'Rio de Janeiro', 'guilherme@example.com', '(21) 0246-7890', '" . password_hash("senha678", PASSWORD_DEFAULT) . "'),
        ('Juliana', 'Lima', 'Travessa das Árvores, 123', 'Belo Horizonte', 'Minas Gerais', 'juliana@example.com', '(31) 5678-9024', '" . password_hash("senha123", PASSWORD_DEFAULT) . "'),
        ('Rodrigo', 'Martins', 'Rua das Flores, 432', 'Curitiba', 'Paraná', 'rodrigo@example.com', '(41) 8024-6789', '" . password_hash("senha432", PASSWORD_DEFAULT) . "'),
        ('Camila', 'Sousa', 'Avenida dos Palmeiras, 987', 'Porto Alegre', 'Rio Grande do Sul', 'camila@example.com', '(51) 5678-9012', '" . password_hash("senha987", PASSWORD_DEFAULT) . "'),
        ('Marcelo', 'Lopes', 'Rua dos Cedros, 678', 'São Paulo', 'São Paulo', 'marcelo@example.com', '(11) 0246-7890', '" . password_hash("senha678", PASSWORD_DEFAULT) . "'),
        ('Amanda', 'Rocha', 'Avenida das Flores, 345', 'Rio de Janeiro', 'Rio de Janeiro', 'amanda@example.com', '(21) 5678-9024', '" . password_hash("senha345", PASSWORD_DEFAULT) . "'),
        ('Diego', 'Pereira', 'Travessa dos Ipês, 432', 'Belo Horizonte', 'Minas Gerais', 'diego@example.com', '(31) 8024-6789', '" . password_hash("senha432", PASSWORD_DEFAULT) . "'),
        ('Fernanda', 'Gomes', 'Rua das Palmeiras, 987', 'Curitiba', 'Paraná', 'fernanda@example.com', '(41) 5678-9012', '" . password_hash("senha987", PASSWORD_DEFAULT) . "'),
        ('Thiago', 'Santana', 'Avenida dos Cedros, 654', 'Porto Alegre', 'Rio Grande do Sul', 'thiago@example.com', '(51) 0246-7890', '" . password_hash("senha654", PASSWORD_DEFAULT) . "'),
        ('Patricia', 'Oliveira', 'Rua das Flores, 789', 'São Paulo', 'São Paulo', 'patricia@example.com', '(11) 9024-5678', '" . password_hash("senha789", PASSWORD_DEFAULT) . "'),
        ('Roberto', 'Sousa', 'Avenida das Palmeiras, 543', 'Rio de Janeiro', 'Rio de Janeiro', 'roberto@example.com', '(21) 3456-7890', '" . password_hash("senha543", PASSWORD_DEFAULT) . "'),
        ('Vanessa', 'Martins', 'Travessa dos Pinheiros, 210', 'Belo Horizonte', 'Minas Gerais', 'vanessa@example.com', '(31) 6789-0123', '" . password_hash("senha210", PASSWORD_DEFAULT) . "'),
        ('Lucas', 'Almeida', 'Rua dos Cedros, 567', 'Curitiba', 'Paraná', 'lucas@example.com', '(41) 9012-3456', '" . password_hash("senha567", PASSWORD_DEFAULT) . "'),
        ('Carolina', 'Rocha', 'Avenida dos Ipês, 987', 'Porto Alegre', 'Rio Grande do Sul', 'carolina@example.com', '(51) 2345-6789', '" . password_hash("senha987", PASSWORD_DEFAULT) . "'),
        ('Thiago', 'Oliveira', 'Rua das Palmeiras, 654', 'São Paulo', 'São Paulo', 'thiago@example.com', '(11) 6789-0123', '" . password_hash("senha654", PASSWORD_DEFAULT) . "'),
        ('Gisele', 'Ferreira', 'Avenida das Flores, 321', 'Rio de Janeiro', 'Rio de Janeiro', 'gisele@example.com', '(21) 9012-3456', '" . password_hash("senha321", PASSWORD_DEFAULT) . "'),
        ('Felipe', 'Santos', 'Travessa dos Cedros, 876', 'Belo Horizonte', 'Minas Gerais', 'felipe@example.com', '(31) 2345-6789', '" . password_hash("senha876", PASSWORD_DEFAULT) . "'),
        ('Isabela', 'Pereira', 'Rua dos Ipês, 543', 'Curitiba', 'Paraná', 'isabela@example.com', '(41) 5678-9012', '" . password_hash("senha543", PASSWORD_DEFAULT) . "'),
        ('Marcos', 'Silva', 'Avenida das Palmeiras, 210', 'Porto Alegre', 'Rio Grande do Sul', 'marcos@example.com', '(51) 9012-3456', '" . password_hash("senha210", PASSWORD_DEFAULT) . "'),
        ('Aline', 'Santos', 'Rua das Flores, 123', 'São Paulo', 'São Paulo', 'aline@example.com', '(11) 9876-5432', '" . password_hash("senha123", PASSWORD_DEFAULT) . "'),
        ('Bruno', 'Silva', 'Avenida das Palmeiras, 456', 'Rio de Janeiro', 'Rio de Janeiro', 'bruno@example.com', '(21) 1234-5678', '" . password_hash("senha456", PASSWORD_DEFAULT) . "'),
        ('Carla', 'Oliveira', 'Travessa dos Pinheiros, 789', 'Belo Horizonte', 'Minas Gerais', 'carla@example.com', '(31) 3698-1357', '" . password_hash("senha789", PASSWORD_DEFAULT) . "'),
        ('Daniel', 'Ferreira', 'Rua dos Cedros, 321', 'Curitiba', 'Paraná', 'daniel@example.com', '(41) 8523-7412', '" . password_hash("senha321", PASSWORD_DEFAULT) . "'),
        ('Erika', 'Ribeiro', 'Avenida dos Ipês, 654', 'Porto Alegre', 'Rio Grande do Sul', 'erika@example.com', '(51) 2468-1478', '" . password_hash("senha654", PASSWORD_DEFAULT) . "'),
        ('Fabio', 'Silveira', 'Rua das Pedras, 987', 'São Paulo', 'São Paulo', 'fabio@example.com', '(11) 7654-3210', '" . password_hash("senha987", PASSWORD_DEFAULT) . "'),
        ('Giovana', 'Oliveira', 'Avenida das Árvores, 234', 'Rio de Janeiro', 'Rio de Janeiro', 'giovana@example.com', '(21) 5678-9012', '" . password_hash("senha234", PASSWORD_DEFAULT) . "'),
        ('Henrique', 'Santos', 'Travessa das Flores, 876', 'Belo Horizonte', 'Minas Gerais', 'henrique@example.com', '(31) 2468-9753', '" . password_hash("senha876", PASSWORD_DEFAULT) . "'),
        ('Isadora', 'Ferreira', 'Rua das Palmeiras, 543', 'Curitiba', 'Paraná', 'isadora@example.com', '(41) 3698-0246', '" . password_hash("senha543", PASSWORD_DEFAULT) . "'),
        ('Jorge', 'Souza', 'Avenida dos Cedros, 210', 'Porto Alegre', 'Rio Grande do Sul', 'jorge@example.com', '(51) 1357-8024', '" . password_hash("senha210", PASSWORD_DEFAULT) . "'),
        ('Karen', 'Carvalho', 'Rua dos Ipês, 345', 'São Paulo', 'São Paulo', 'karen@example.com', '(11) 8024-5678', '" . password_hash("senha345", PASSWORD_DEFAULT) . "'),
        ('Leandro', 'Almeida', 'Avenida das Pedras, 678', 'Rio de Janeiro', 'Rio de Janeiro', 'leandro@example.com', '(21) 0246-7890', '" . password_hash("senha678", PASSWORD_DEFAULT) . "'),
        ('Marta', 'Lima', 'Travessa das Árvores, 123', 'Belo Horizonte', 'Minas Gerais', 'marta@example.com', '(31) 5678-9024', '" . password_hash("senha123", PASSWORD_DEFAULT) . "'),
        ('Natalia', 'Martins', 'Rua das Flores, 432', 'Curitiba', 'Paraná', 'natalia@example.com', '(41) 8024-6789', '" . password_hash("senha432", PASSWORD_DEFAULT) . "'),
        ('Oscar', 'Sousa', 'Avenida dos Palmeiras, 987', 'Porto Alegre', 'Rio Grande do Sul', 'oscar@example.com', '(51) 5678-9012', '" . password_hash("senha987", PASSWORD_DEFAULT) . "'),
        ('Paula', 'Rocha', 'Rua dos Cedros, 678', 'São Paulo', 'São Paulo', 'paula@example.com', '(11) 0246-7890', '" . password_hash("senha678", PASSWORD_DEFAULT) . "'),
        ('Rafaela', 'Rocha', 'Avenida das Flores, 345', 'Rio de Janeiro', 'Rio de Janeiro', 'rafaela@example.com', '(21) 5678-9024', '" . password_hash("senha345", PASSWORD_DEFAULT) . "'),
        ('Sergio', 'Pereira', 'Travessa dos Ipês, 432', 'Belo Horizonte', 'Minas Gerais', 'sergio@example.com', '(31) 8024-6789', '" . password_hash("senha432", PASSWORD_DEFAULT) . "'),
        ('Tais', 'Gomes', 'Rua das Palmeiras, 987', 'Curitiba', 'Paraná', 'tais@example.com', '(41) 5678-9012', '" . password_hash("senha987", PASSWORD_DEFAULT) . "'),
        ('Vitor', 'Santana', 'Avenida dos Cedros, 654', 'Porto Alegre', 'Rio Grande do Sul', 'vitor@example.com', '(51) 0246-7890', '" . password_hash("senha654", PASSWORD_DEFAULT) . "'),
        ('Wagner', 'Oliveira', 'Rua das Palmeiras, 654', 'São Paulo', 'São Paulo', 'wagner@example.com', '(11) 6789-0123', '" . password_hash("senha789", PASSWORD_DEFAULT) . "'),
        ('Xavier', 'Ferreira', 'Avenida das Flores, 321', 'Rio de Janeiro', 'Rio de Janeiro', 'xavier@example.com', '(21) 9012-3456', '" . password_hash("senha321", PASSWORD_DEFAULT) . "'),
        ('Yasmin', 'Santos', 'Travessa dos Cedros, 876', 'Belo Horizonte', 'Minas Gerais', 'yasmin@example.com', '(31) 2345-6789', '" . password_hash("senha876", PASSWORD_DEFAULT) . "'),
        ('Zoe', 'Pereira', 'Rua dos Ipês, 543', 'Curitiba', 'Paraná', 'zoe@example.com', '(41) 5678-9012', '" . password_hash("senha543", PASSWORD_DEFAULT) . "'),
        ('Anderson', 'Silva', 'Avenida das Palmeiras, 210', 'Porto Alegre', 'Rio Grande do Sul', 'anderson@example.com', '(51) 9012-3456', '" . password_hash("senha210", PASSWORD_DEFAULT) . "'),
        ('Bianca', 'Martins', 'Travessa dos Pinheiros, 210', 'São Paulo', 'São Paulo', 'bianca@example.com', '(11) 9024-5678', '" . password_hash("senha567", PASSWORD_DEFAULT) . "'),
        ('Carlos', 'Santos', 'Rua das Flores, 789', 'Rio de Janeiro', 'Rio de Janeiro', 'carlos_santos@example.com', '(21) 3456-7890', '" . password_hash("senha890", PASSWORD_DEFAULT) . "'),
        ('Diana', 'Martins', 'Avenida dos Ipês, 654', 'Belo Horizonte', 'Minas Gerais', 'diana_martins@example.com', '(31) 6789-0123', '" . password_hash("senha123", PASSWORD_DEFAULT) . "'),
        ('Eduardo', 'Oliveira', 'Rua das Palmeiras, 987', 'Curitiba', 'Paraná', 'eduardo_oliveira@example.com', '(41) 9012-3456', '" . password_hash("senha456", PASSWORD_DEFAULT) . "'),
        ('Fernanda', 'Santos', 'Avenida dos Cedros, 876', 'Porto Alegre', 'Rio Grande do Sul', 'fernanda_santos@example.com', '(51) 2345-6789', '" . password_hash("senha789", PASSWORD_DEFAULT) . "')";
        $pdo->exec($sql_inserir_clientes);
    }

    // Criação da tabela carro
    $sql_carros = "CREATE TABLE IF NOT EXISTS carro (
    ID_CARRO SERIAL PRIMARY KEY,
    ANO INT NOT NULL,
    PLACA VARCHAR(10) NOT NULL,
    MODELO VARCHAR(30) NOT NULL,
    TIPO VARCHAR(100) NOT NULL,
    MARCA VARCHAR(50) NOT NULL,
    DISPONIBILIDADE VARCHAR(20) NOT NULL,
    PRECO NUMERIC NOT NULL
    )";
    $pdo->exec($sql_carros);

    // Verificar se há carros na tabela
    $sql_check_carros = "SELECT COUNT(*) FROM carro";
    $stmt_check_carros = $pdo->query($sql_check_carros);
    $carros_existe = $stmt_check_carros->fetchColumn();

    if ($carros_existe == 0) {
        // Inserção de carros padrão
        $sql_inserir_carros = "INSERT INTO carro (ANO, PLACA, MODELO, TIPO, MARCA, DISPONIBILIDADE, PRECO) VALUES
        (2022, 'ABC1234', 'Civic', 'Sedan', 'Honda', 'Disponível', 1000),
        (2021, 'DEF5678', 'Palio', 'Hatchback', 'Fiat', 'Disponível', 700),
        (2023, 'GHI9012', 'Ecosport', 'SUV', 'Ford', 'Disponível', 800),
        (2020, 'JKL3456', 'Fit', 'Hatchback', 'Honda', 'Disponível', 800),
        (2019, 'MNO7890', 'HB20', 'Hatchback', 'Hyundai', 'Disponível', 1400),
        (2018, 'PQR1234', 'Corolla', 'Sedan', 'Toyota', 'Disponível', 950),
         (2024, 'STU5678', 'Gol', 'Hatchback', 'Volkswagen', 'Indisponível', 600),
         (2023, 'VWX9012', 'Onix', 'Sedan', 'Chevrolet', 'Indisponível', 800),
         (2022, 'YZA3456', 'HR-V', 'SUV', 'Honda', 'Indisponível', 1200),
         (2021, 'BCD7890', 'Ka', 'Hatchback', 'Ford', 'Indisponível', 700),
         (2020, 'EFG1234', 'Cruze', 'Sedan', 'Chevrolet', 'Indisponível', 1000),
         (2019, 'HIJ5678', 'Renegade', 'SUV', 'Jeep', 'Indisponível', 1100),
         (2018, 'KLM9012', 'Civic', 'Sedan', 'Honda', 'Indisponível', 1000),
         (2017, 'NOP3456', 'Compass', 'SUV', 'Jeep', 'Indisponível', 1200),
         (2016, 'QRS7890', 'Fiesta', 'Hatchback', 'Ford', 'Indisponível', 600),
         (2015, 'TUV1234', 'Fusca', 'Sedan', 'Volkswagen', 'Indisponível', 800),
         (2014, 'WXY5678', 'Tracker', 'SUV', 'Chevrolet', 'Indisponível', 1100),
         (2013, 'ZAB9012', 'Corolla', 'Sedan', 'Toyota', 'Indisponível', 1000),
         (2012, 'BCD3456', 'Kicks', 'SUV', 'Nissan', 'Indisponível', 900),
         (2011, 'EFG7890', 'Uno', 'Hatchback', 'Fiat', 'Indisponível', 500),
         (2010, 'HIJ1234', 'Creta', 'SUV', 'Hyundai', 'Indisponível', 1200)";
        $pdo->exec($sql_inserir_carros);
    }

    // Criação da tabela agencia
    $sql_agencia = "CREATE TABLE IF NOT EXISTS agencia (
    NUM_AGENCIA SERIAL PRIMARY KEY,
    ENDERECO VARCHAR(255) NOT NULL,
    CIDADE VARCHAR(50) NOT NULL,
    CONTATO VARCHAR(14) NOT NULL,
    ESTADO VARCHAR(50) NOT NULL
    )";
    $pdo->exec($sql_agencia);

    // Verificar se há agências na tabela
    $sql_check_agencias = "SELECT COUNT(*) FROM agencia";
    $stmt_check_agencias = $pdo->query($sql_check_agencias);
    $agencias_existe = $stmt_check_agencias->fetchColumn();

    if ($agencias_existe == 0) {
        // Inserção de agências padrão
        $sql_inserir_agencias = "INSERT INTO agencia (ENDERECO, CIDADE, CONTATO, ESTADO) VALUES
        ('Rua Carlos Gomes, 123', 'Limeira', '(19) 1234-5678', 'São Paulo'),
        ('Rua da Luz, 456', 'Piracicaba', '(19) 9876-5432', 'São Paulo'),
        ('Rua dos Carros, 123', 'São Paulo', '(11) 1234-5678', 'São Paulo')";
        $pdo->exec($sql_inserir_agencias);
    }

    // Criação da tabela funcionario
    $sql_funcionario = "CREATE TABLE IF NOT EXISTS funcionario (
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
    FOREIGN KEY(NUM_AGENCIA) REFERENCES agencia(NUM_AGENCIA)
    )";
    $pdo->exec($sql_funcionario);

    // Verificar se há funcionários na tabela
    $sql_check_funcionarios = "SELECT COUNT(*) FROM funcionario";
    $stmt_check_funcionarios = $pdo->query($sql_check_funcionarios);
    $funcionarios_existe = $stmt_check_funcionarios->fetchColumn();

    if ($funcionarios_existe == 0) {
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


        $sql_inserir_funcionarios = "INSERT INTO funcionario (NOME, SOBRENOME, CARGO, DATA_CONTRATACAO, SALARIO, NUM_AGENCIA, CIDADE, EMAIL, SENHA) VALUES
    ('Lucas', 'Silva', 'Atendente', '2023-05-15', 3000.00, 1, 'São Paulo', 'lucas@example.com', '" . password_hash("senha123", PASSWORD_DEFAULT) . "'),
    ('Fernanda', 'Santos', 'Gerente', '2022-08-20', 5000.00, 2, 'Rio de Janeiro', 'fernanda@example.com', '" . password_hash("senha456", PASSWORD_DEFAULT) . "'),
    ('Carla', 'Oliveira', 'Vendedor', '2024-01-10', 2500.00, 3, 'Belo Horizonte', 'carla@example.com', '" . password_hash("senha789", PASSWORD_DEFAULT) . "'),
    ('Pedro', 'Ferreira', 'Motorista', '2023-11-05', 2800.00, 1, 'Curitiba', 'pedro@example.com', '" . password_hash("senha321", PASSWORD_DEFAULT) . "'),
    ('Ana', 'Ribeiro', 'Atendente', '2022-06-12', 3000.00, 2, 'Porto Alegre', 'ana@example.com', '" . password_hash("senha654", PASSWORD_DEFAULT) . "'),
    ('Marcos', 'Sousa', 'Gerente', '2023-02-25', 5500.00, 3, 'São Paulo', 'marcos@example.com', '" . password_hash("senha789", PASSWORD_DEFAULT) . "'),
    ('Mariana', 'Almeida', 'Vendedor', '2024-03-18', 2600.00, 1, 'Rio de Janeiro', 'mariana@example.com', '" . password_hash("senha987", PASSWORD_DEFAULT) . "'),
    ('Rafael', 'Pereira', 'Motorista', '2023-09-30', 2900.00, 2, 'Belo Horizonte', 'rafael@example.com', '" . password_hash("senha123", PASSWORD_DEFAULT) . "'),
    ('Juliana', 'Martins', 'Atendente', '2022-11-22', 3100.00, 3, 'Curitiba', 'juliana@example.com', '" . password_hash("senha456", PASSWORD_DEFAULT) . "'),
    ('Gustavo', 'Fernandes', 'Gerente', '2023-07-08', 5200.00, 1, 'Porto Alegre', 'gustavo@example.com', '" . password_hash("senha789", PASSWORD_DEFAULT) . "'),
    ('Camila', 'Oliveira', 'Vendedor', '2024-05-14', 2700.00, 2, 'São Paulo', 'camila@example.com', '" . password_hash("senha321", PASSWORD_DEFAULT) . "'),
    ('Thiago', 'Santos', 'Motorista', '2023-03-02', 3000.00, 3, 'Rio de Janeiro', 'thiago@example.com', '" . password_hash("senha654", PASSWORD_DEFAULT) . "'),
    ('Aline', 'Rocha', 'Atendente', '2022-09-18', 3200.00, 1, 'Belo Horizonte', 'aline@example.com', '" . password_hash("senha987", PASSWORD_DEFAULT) . "'),
    ('Bruno', 'Silva', 'Gerente', '2023-01-25', 5300.00, 2, 'Curitiba', 'bruno@example.com', '" . password_hash("senha123", PASSWORD_DEFAULT) . "'),
    ('Larissa', 'Ferreira', 'Vendedor', '2024-04-10', 2800.00, 3, 'Porto Alegre', 'larissa@example.com', '" . password_hash("senha456", PASSWORD_DEFAULT) . "'),
    ('Rodrigo', 'Almeida', 'Motorista', '2023-08-22', 3100.00, 1, 'São Paulo', 'rodrigo@example.com', '" . password_hash("senha789", PASSWORD_DEFAULT) . "'),
    ('Vanessa', 'Pereira', 'Atendente', '2022-12-05', 3300.00, 2, 'Rio de Janeiro', 'vanessa@example.com', '" . password_hash("senha321", PASSWORD_DEFAULT) . "'),
    ('Marcelo', 'Sousa', 'Gerente', '2023-04-15', 5400.00, 3, 'Belo Horizonte', 'marcelo@example.com', '" . password_hash("senha654", PASSWORD_DEFAULT) . "'),
    ('Tatiane', 'Martins', 'Vendedor', '2024-06-28', 2900.00, 1, 'Curitiba', 'tatiane@example.com', '" . password_hash("senha987", PASSWORD_DEFAULT) . "'),
    ('Alexandre', 'Fernandes', 'Motorista', '2023-10-10', 3200.00, 2, 'Porto Alegre', 'alexandre@example.com', '" . password_hash("senha123", PASSWORD_DEFAULT) . "'),
    ('Amanda', 'Ribeiro', 'Atendente', '2022-07-15', 3000.00, 3, 'São Paulo', 'amanda@example.com', '" . password_hash("senha123", PASSWORD_DEFAULT) . "'),
    ('Roberto', 'Sousa', 'Gerente', '2023-01-20', 5000.00, 1, 'Rio de Janeiro', 'roberto@example.com', '" . password_hash("senha456", PASSWORD_DEFAULT) . "'),
    ('Isabela', 'Oliveira', 'Vendedor', '2024-02-10', 2500.00, 2, 'Belo Horizonte', 'isabela@example.com', '" . password_hash("senha789", PASSWORD_DEFAULT) . "'),
    ('Ricardo', 'Ferreira', 'Motorista', '2023-10-05', 2800.00, 3, 'Curitiba', 'ricardo@example.com', '" . password_hash("senha321", PASSWORD_DEFAULT) . "'),
    ('Fernando', 'Santos', 'Atendente', '2022-05-12', 3000.00, 1, 'Porto Alegre', 'fernando@example.com', '" . password_hash("senha654", PASSWORD_DEFAULT) . "'),
    ('Julia', 'Almeida', 'Gerente', '2023-03-25', 5500.00, 2, 'São Paulo', 'julia@example.com', '" . password_hash("senha789", PASSWORD_DEFAULT) . "'),
    ('Luiz', 'Rocha', 'Vendedor', '2024-04-18', 2600.00, 3, 'Rio de Janeiro', 'luiz@example.com', '" . password_hash("senha987", PASSWORD_DEFAULT) . "'),
    ('Carolina', 'Ferreira', 'Motorista', '2023-08-30', 2900.00, 1, 'Belo Horizonte', 'carolina@example.com', '" . password_hash("senha123", PASSWORD_DEFAULT) . "'),
    ('Felipe', 'Martins', 'Atendente', '2022-10-22', 3100.00, 2, 'Curitiba', 'felipe@example.com', '" . password_hash("senha456", PASSWORD_DEFAULT) . "'),
    ('Mariana', 'Oliveira', 'Gerente', '2023-06-08', 5200.00, 3, 'Porto Alegre', 'mariana@example.com', '" . password_hash("senha789", PASSWORD_DEFAULT) . "'),
    ('Gustavo', 'Silva', 'Vendedor', '2024-05-14', 2700.00, 1, 'São Paulo', 'gustavo@example.com', '" . password_hash("senha321", PASSWORD_DEFAULT) . "'),
    ('Camila', 'Santos', 'Motorista', '2023-02-02', 3000.00, 2, 'Rio de Janeiro', 'camila@example.com', '" . password_hash("senha654", PASSWORD_DEFAULT) . "'),
    ('Bruno', 'Oliveira', 'Atendente', '2022-08-18', 3200.00, 3, 'Belo Horizonte', 'bruno@example.com', '" . password_hash("senha987", PASSWORD_DEFAULT) . "'),
    ('Ana', 'Martins', 'Gerente', '2023-12-25', 5300.00, 1, 'Curitiba', 'ana@example.com', '" . password_hash("senha123", PASSWORD_DEFAULT) . "'),
    ('Rodrigo', 'Ferreira', 'Vendedor', '2024-03-10', 2800.00, 2, 'Porto Alegre', 'rodrigo@example.com', '" . password_hash("senha456", PASSWORD_DEFAULT) . "'),
    ('Tatiane', 'Silva', 'Motorista', '2023-07-22', 3100.00, 3, 'São Paulo', 'tatiane@example.com', '" . password_hash("senha789", PASSWORD_DEFAULT) . "'),
    ('Alexandre', 'Santos', 'Atendente', '2022-11-05', 3300.00, 1, 'Rio de Janeiro', 'alexandre@example.com', '" . password_hash("senha321", PASSWORD_DEFAULT) . "'),
    ('Luana', 'Ferreira', 'Gerente', '2023-05-15', 5400.00, 2, 'Belo Horizonte', 'luana@example.com', '" . password_hash("senha654", PASSWORD_DEFAULT) . "'),
    ('Marcos', 'Martins', 'Vendedor', '2024-06-28', 2900.00, 3, 'Curitiba', 'marcos@example.com', '" . password_hash("senha987", PASSWORD_DEFAULT) . "'),
    ('Aline', 'Silva', 'Motorista', '2023-09-10', 3200.00, 1, 'Porto Alegre', 'aline@example.com', '" . password_hash("senha123", PASSWORD_DEFAULT) . "')";
    $pdo->exec($sql_inserir_funcionarios);

    }

 
} catch (PDOException $e) {
    echo "Falha ao conectar ao banco de dados. <br/>";
    die($e->getMessage());
}
?>
