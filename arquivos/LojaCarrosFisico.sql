CREATE TABLE Agencia (
    NUM_AGENCIA SERIAL PRIMARY KEY,
    ENDERECO VARCHAR(255) NOT NULL,
    CIDADE VARCHAR(50) NOT NULL,
    CONTATO VARCHAR(14) NOT NULL,
    ESTADO VARCHAR(50) NOT NULL
);

CREATE TABLE Funcionarios (
    ID_FUNCIONARIO SERIAL PRIMARY KEY,
    NOME VARCHAR(50) NOT NULL,
    SOBRENOME VARCHAR(50),
    CARGO VARCHAR(50),
    DATA_CONTRATACAO DATE NOT NULL,
    SALARIO NUMERIC,
    NUM_AGENCIA INT,
    CIDADE VARCHAR(50) NOT NULL,
    FOREIGN KEY(NUM_AGENCIA) REFERENCES Agencia (NUM_AGENCIA)
);

CREATE TABLE Pagamento (
    ID_PAGAMENTO SERIAL PRIMARY KEY,
    DATA_PAGAMENTO DATE NOT NULL,
    STATUS_PAGAMENTO VARCHAR(50) NOT NULL,
    FORMA_PAGAMENTO VARCHAR(50) NOT NULL,
    VALOR NUMERIC NOT NULL
);


CREATE TABLE Carro (
    ID_CARRO SERIAL PRIMARY KEY,
    ANO INT NOT NULL,
    PLACA INT NOT NULL,
    MODELO VARCHAR(30) NOT NULL,
    TIPO VARCHAR(100) NOT NULL,
    MARCA VARCHAR(50) NOT NULL,
    DISPONIBILIDADE VARCHAR(20) NOT NULL
);

CREATE TABLE Manutencao (
    ID_MANUTENCAO SERIAL PRIMARY KEY,
    CUSTO NUMERIC NOT NULL,
    ICM NUMERIC NOT NULL,
    DESCRICAO TEXT,
    TIPO_MANUTENCAO VARCHAR(50) NOT NULL,
    DATA_MANUTENCAO DATE NOT NULL
);

CREATE TABLE Feedback (
    ID_FEEDBACK SERIAL PRIMARY KEY,
    DATA_FEEDBACK DATE NOT NULL,
    AVALIACAO VARCHAR(20),
    COMENTARIO TEXT NOT NULL
);

CREATE TABLE Cliente (
    ID_CLIENTE SERIAL PRIMARY KEY,
    NOME VARCHAR(100) NOT NULL,
    SOBRENOME VARCHAR(50) NOT NULL,
    ENDERECO VARCHAR(255) NOT NULL,
    CIDADE VARCHAR(50) NOT NULL,
    ESTADO VARCHAR(50) NOT NULL,
    EMAIL VARCHAR(255) NOT NULL,
    TELEFONE VARCHAR(14),
    ID_PAGAMENTO SERIAL,
    FOREIGN KEY(ID_PAGAMENTO) REFERENCES Pagamento (ID_PAGAMENTO)
);

CREATE TABLE Locacao (
    ID_LOCALIZACAO SERIAL PRIMARY KEY,
    DATA_LOCACAO DATE NOT NULL,
    DATA_DEVOLUCAO DATE NOT NULL,
    VALOR_TOTAL NUMERIC NOT NULL,
    ID_CLIENTE INT,
    ID_CARRO INT,
    FOREIGN KEY(ID_CLIENTE) REFERENCES Cliente (ID_CLIENTE),
    FOREIGN KEY(ID_CARRO) REFERENCES Carro (ID_CARRO)
);

CREATE TABLE Recebe (
    ID_CARRO INT,
    ID_MANUTENCAO INT,
    FOREIGN KEY(ID_CARRO) REFERENCES Carro (ID_CARRO),
    FOREIGN KEY(ID_MANUTENCAO) REFERENCES Manutencao (ID_MANUTENCAO)
);

CREATE TABLE Envia (
    ID_ENVIA SERIAL PRIMARY KEY,
    OBSERVACAO TEXT,
    ID_CLIENTE INT,
    ID_FEEDBACK INT,
    FOREIGN KEY(ID_CLIENTE) REFERENCES Cliente (ID_CLIENTE),
    FOREIGN KEY(ID_FEEDBACK) REFERENCES Feedback (ID_FEEDBACK)
);

-- Inserts para a tabela Agencia
INSERT INTO Agencia (ENDERECO, CIDADE, CONTATO, ESTADO) VALUES 
('123 Main Street', 'New York', '123-456-7890', 'NY'),
('456 Oak Avenue', 'Los Angeles', '987-654-3210', 'CA'),
('789 Maple Lane', 'Chicago', '456-789-0123', 'IL'),
('101 Pine Street', 'Houston', '321-654-0987', 'TX'),
('202 Elm Street', 'Miami', '789-012-3456', 'FL'),
('303 Cedar Avenue', 'San Francisco', '210-987-6543', 'CA'),
('404 Birch Lane', 'Seattle', '543-210-6789', 'WA'),
('505 Willow Drive', 'Boston', '012-345-6789', 'MA'),
('606 Spruce Street', 'Philadelphia', '678-901-2345', 'PA'),
('707 Cherry Lane', 'Atlanta', '234-567-8901', 'GA');

-- Inserts para a tabela Funcionarios
INSERT INTO Funcionarios (NOME, SOBRENOME, CARGO, DATA_CONTRATACAO, SALARIO, CIDADE, NUM_AGENCIA) VALUES 
('João', 'Silva', 'Gerente', '2023-01-15', 5000.00, 'São Paulo', 1),
('Maria', 'Santos', 'Atendente', '2023-02-20', 3000.00, 'Recife', 1),
('Carlos', 'Oliveira', 'Atendente', '2023-03-10', 3000.00, 'Florianópolis', 2),
('Ana', 'Rodrigues', 'Gerente', '2023-04-05', 5000.00, 'Limeira', 2),
('Pedro', 'Costa', 'Atendente', '2023-05-15', 3000.00, 'Rio de Janeiro', 3),
('Sofia', 'Martins', 'Atendente', '2023-06-20', 3000.00, 'Salvador', 3),
('Miguel', 'Ferreira', 'Gerente', '2023-07-10', 5000.00, 'Campinas', 4),
('Inês', 'Pereira', 'Atendente', '2023-08-05', 3000.00, 'Belo Horizonte', 4),
('Luís', 'Ribeiro', 'Gerente', '2023-09-15', 5000.00, 'São Paulo', 5),
('Catarina', 'Almeida', 'Atendente', '2023-10-20', 3000.00, 'Rio de Janeiro', 5);

-- Inserts para a tabela Pagamento
INSERT INTO Pagamento (DATA_PAGAMENTO, STATUS_PAGAMENTO, FORMA_PAGAMENTO, VALOR) VALUES 
('2024-04-01', 'Pago', 'Cartão de Crédito', 100.00),
('2024-04-05', 'Pago', 'Cartão de Débito', 150.00),
('2024-04-10', 'Pendente', 'Boleto Bancário', 200.00),
('2024-04-15', 'Pago', 'Transferência Bancária', 120.00),
('2024-04-20', 'Pendente', 'Dinheiro', 90.00),
('2024-04-25', 'Pago', 'Cartão de Crédito', 180.00),
('2024-04-30', 'Pago', 'Cartão de Débito', 210.00),
('2024-05-01', 'Pendente', 'Boleto Bancário', 220.00),
('2024-05-05', 'Pago', 'Transferência Bancária', 130.00),
('2024-05-10', 'Pendente', 'Dinheiro', 95.00);

-- Inserts para a tabela Carro
INSERT INTO Carro (ANO, PLACA, MODELO, TIPO, MARCA, DISPONIBILIDADE) VALUES 
(2019, 1234, 'Civic', 'Sedan', 'Honda', 'Disponível'),
(2020, 5678, 'Corolla', 'Sedan', 'Toyota', 'Disponível'),
(2018, 9012, 'Fiesta', 'Compacto', 'Ford', 'Disponível'),
(2017, 3456, 'Cruze', 'Sedan', 'Chevrolet', 'Disponível'),
(2016, 7890, 'Golf', 'Compacto', 'Volkswagen', 'Disponível'),
(2019, 1235, 'Civic', 'Sedan', 'Honda', 'Disponível'),
(2020, 5679, 'Corolla', 'Sedan', 'Toyota', 'Disponível'),
(2018, 9013, 'Fiesta', 'Compacto', 'Ford', 'Disponível'),
(2017, 3457, 'Cruze', 'Sedan', 'Chevrolet', 'Disponível'),
(2016, 7891, 'Golf', 'Compacto', 'Volkswagen', 'Disponível');

-- Inserts para a tabela Manutencao
INSERT INTO Manutencao (CUSTO, ICM, DESCRICAO, TIPO_MANUTENCAO, DATA_MANUTENCAO) VALUES 
(200.00, 20.00, 'Troca de óleo e filtro', 'Preventiva', '2024-03-15'),
(150.00, 15.00, 'Troca de pneus', 'Corretiva', '2024-04-10'),
(300.00, 30.00, 'Reparo no sistema de freios', 'Corretiva', '2024-04-25'),
(180.00, 18.00, 'Revisão geral', 'Preventiva', '2024-05-02'),
(220.00, 22.00, 'Troca de correias', 'Corretiva', '2024-05-20'),
(250.00, 25.00, 'Reparo no sistema elétrico', 'Corretiva', '2024-06-05'),
(170.00, 17.00, 'Troca de fluidos', 'Preventiva', '2024-06-15'),
(280.00, 28.00, 'Reparo na suspensão', 'Corretiva', '2024-07-01'),
(190.00, 19.00, 'Troca de filtros', 'Preventiva', '2024-07-10'),
(270.00, 27.00, 'Reparo na transmissão', 'Corretiva', '2024-07-25');

INSERT INTO Feedback (DATA_FEEDBACK, AVALIACAO, COMENTARIO) VALUES 
('2024-04-02', 'Bom', 'Ótimo serviço, recomendo!'),
('2024-04-07', 'Regular', 'Atendimento poderia ser melhor.'),
('2024-04-12', 'Ótimo', 'Estou muito satisfeito com o serviço prestado.'),
('2024-04-17', 'Ruim', 'Carro estava sujo e com problemas mecânicos.'),
('2024-04-22', 'Excelente', 'Superou minhas expectativas, atendimento impecável.'),
('2024-04-27', 'Bom', 'Preço justo e bom atendimento.'),
('2024-05-03', 'Regular', 'Demorou muito para entregar o carro.'),
('2024-05-08', 'Ótimo', 'Carro em ótimo estado, atendimento rápido.'),
('2024-05-13', 'Ruim', 'Problemas na reserva e carro não estava disponível.'),
('2024-05-18', 'Excelente', 'Atendimento excepcional, carro limpo e novo.');

-- Inserts para a tabela Cliente
INSERT INTO Cliente (NOME, SOBRENOME, ENDERECO, CIDADE, ESTADO, EMAIL, TELEFONE, ID_PAGAMENTO) VALUES
('José', 'Silva', 'Rua X, 123', 'São Paulo', 'SP', 'jose@example.com', '(11) 1234-5678', 1),
('Ana', 'Santos', 'Av. Y, 456', 'Rio de Janeiro', 'RJ', 'ana@example.com', '(21) 9876-5432', 2),
('Marcos', 'Oliveira', 'Rua Z, 789', 'Belo Horizonte', 'MG', 'marcos@example.com', '(31) 3456-7890', 3),
('Laura', 'Rodrigues', 'Av. W, 101', 'Curitiba', 'PR', 'laura@example.com', '(41) 6543-2109', 4),
('Gabriel', 'Costa', 'Rua V, 202', 'Brasília', 'DF', 'gabriel@example.com', '(61) 7890-1234', 5),
('Mariana', 'Martins', 'Av. U, 303', 'Porto Alegre', 'RS', 'mariana@example.com', '(51) 9012-3456', 6),
('Rafael', 'Ferreira', 'Rua T, 404', 'Salvador', 'BA', 'rafael@example.com', '(71) 2345-6789', 7),
('Juliana', 'Pereira', 'Av. S, 505', 'Fortaleza', 'CE', 'juliana@example.com', '(85) 5678-9012', 8),
('Mateus', 'Ribeiro', 'Rua R, 606', 'Recife', 'PE', 'mateus@example.com', '(81) 7890-1234', 9),
('Camila', 'Almeida', 'Av. Q, 707', 'Manaus', 'AM', 'camila@example.com', '(92) 3456-7890', 10);

-- Inserts para a tabela Locacao (continuação)
INSERT INTO Locacao (DATA_LOCACAO, DATA_DEVOLUCAO, VALOR_TOTAL, ID_CLIENTE, ID_CARRO) VALUES
('2024-04-01', '2024-04-05', 200.00, 1, 1),
('2024-04-05', '2024-04-10', 250.00, 2, 2),
('2024-04-10', '2024-04-15', 300.00, 3, 3),
('2024-04-15', '2024-04-20', 280.00, 4, 4),
('2024-04-20', '2024-04-25', 320.00, 5, 5),
('2024-04-25', '2024-04-30', 270.00, 6, 6),
('2024-05-01', '2024-05-05', 330.00, 7, 7),
('2024-05-05', '2024-05-10', 290.00, 8, 8),
('2024-05-10', '2024-05-15', 310.00, 9, 9),
('2024-05-15', '2024-05-20', 340.00, 10, 10);

-- Inserts para a tabela Recebe (continuação)
INSERT INTO Recebe (ID_CARRO, ID_MANUTENCAO) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10);

INSERT INTO Envia (OBSERVACAO, ID_CLIENTE, ID_FEEDBACK) VALUES
('Excelente serviço, carro limpo e novo.', 1, 1),
('Atendimento rápido e eficiente.', 2, 2),
('Carro com problemas mecânicos.', 3, 4),
('Ótimo atendimento, mas demorou para entregar o carro.', 4, 7),
('Preço justo, mas o carro estava sujo.', 5, 6),
('Reserva foi complicada e o carro não estava disponível.', 6, 9),
('Atendimento excepcional, carro em ótimo estado.', 7, 8),
('Demorou muito para entregar o carro.', 8, 3),
('Problemas na reserva e carro não estava disponível.', 9, 10),
('Superou minhas expectativas, atendimento impecável.', 10, 5);


-- Inserts adicionais para a tabela Agencia
INSERT INTO Agencia (ENDERECO, CIDADE, CONTATO, ESTADO) VALUES 
('111 Pine Street', 'Dallas', '345-678-9012', 'TX'),
('222 Maple Lane', 'Phoenix', '678-901-2345', 'AZ'),
('333 Cedar Avenue', 'Denver', '901-234-5678', 'CO'),
('444 Oak Avenue', 'Las Vegas', '123-456-7890', 'NV'),
('555 Elm Street', 'Orlando', '456-789-0123', 'FL'),
('666 Birch Lane', 'New Orleans', '789-012-3456', 'LA'),
('777 Willow Drive', 'San Diego', '012-345-6789', 'CA'),
('888 Spruce Street', 'Portland', '234-567-8901', 'OR'),
('999 Cherry Lane', 'Detroit', '567-890-1234', 'MI'),
('000 Main Street', 'Salt Lake City', '890-123-4567', 'UT');

-- Inserts adicionais para a tabela Funcionarios
INSERT INTO Funcionarios (NOME, SOBRENOME, CARGO, DATA_CONTRATACAO, SALARIO, CIDADE, NUM_AGENCIA) VALUES 
('Fernanda', 'Oliveira', 'Atendente', '2023-11-20', 3000.00, 'São Paulo', 6),
('Gustavo', 'Rodrigues', 'Gerente', '2023-12-10', 5000.00, 'Campinas', 7),
('Aline', 'Costa', 'Atendente', '2024-01-05', 3000.00, 'Manaus', 8),
('Roberto', 'Martins', 'Gerente', '2024-02-15', 5000.00, 'Recife', 9),
('Carolina', 'Ferreira', 'Atendente', '2024-03-20', 3000.00, 'São Paulo', 10),
('Daniel', 'Ribeiro', 'Gerente', '2024-04-10', 5000.00, 'Rio de Janeiro', 1),
('Juliana', 'Almeida', 'Atendente', '2024-05-15', 3000.00, 'Limeira', 2),
('Ricardo', 'Santos', 'Gerente', '2024-06-20', 5000.00, 'Juazeiro', 3),
('Tatiane', 'Silva', 'Atendente', '2024-07-01', 3000.00, 'Guarulhos', 4),
('Bruno', 'Oliveira', 'Gerente', '2024-08-10', 5000.00, 'Vitória', 5);

-- Inserts adicionais para a tabela Pagamento
INSERT INTO Pagamento (DATA_PAGAMENTO, STATUS_PAGAMENTO, FORMA_PAGAMENTO, VALOR) VALUES 
('2024-05-15', 'Pendente', 'Dinheiro', 240.00),
('2024-05-20', 'Pago', 'Transferência Bancária', 170.00),
('2024-05-25', 'Pago', 'Cartão de Débito', 200.00),
('2024-05-30', 'Pendente', 'Boleto Bancário', 180.00),
('2024-06-01', 'Pago', 'Transferência Bancária', 220.00),
('2024-06-05', 'Pendente', 'Dinheiro', 190.00),
('2024-06-10', 'Pago', 'Cartão de Crédito', 210.00),
('2024-06-15', 'Pendente', 'Boleto Bancário', 230.00),
('2024-06-20', 'Pago', 'Transferência Bancária', 250.00),
('2024-06-25', 'Pago', 'Cartão de Débito', 260.00);

-- Inserts adicionais para a tabela Carro
INSERT INTO Carro (ANO, PLACA, MODELO, TIPO, MARCA, DISPONIBILIDADE) VALUES 
(2019, 1236, 'Civic', 'Sedan', 'Honda', 'Disponível'),
(2020, 5680, 'Corolla', 'Sedan', 'Toyota', 'Disponível'),
(2018, 9014, 'Fiesta', 'Compacto', 'Ford', 'Disponível'),
(2017, 3458, 'Cruze', 'Sedan', 'Chevrolet', 'Disponível'),
(2016, 7892, 'Golf', 'Compacto', 'Volkswagen', 'Disponível'),
(2019, 1237, 'Civic', 'Sedan', 'Honda', 'Disponível'),
(2020, 5681, 'Corolla', 'Sedan', 'Toyota', 'Disponível'),
(2018, 9015, 'Fiesta', 'Compacto', 'Ford', 'Disponível'),
(2017, 3459, 'Cruze', 'Sedan', 'Chevrolet', 'Disponível'),
(2016, 7893, 'Golf', 'Compacto', 'Volkswagen', 'Disponível');

-- Inserts adicionais para a tabela Manutencao
INSERT INTO Manutencao (CUSTO, ICM, DESCRICAO, TIPO_MANUTENCAO, DATA_MANUTENCAO) VALUES 
(230.00, 23.00, 'Troca de óleo e filtro', 'Preventiva', '2024-08-15'),
(260.00, 26.00, 'Troca de pneus', 'Corretiva', '2024-08-20'),
(210.00, 21.00, 'Reparo no sistema de freios', 'Corretiva', '2024-08-25'),
(240.00, 24.00, 'Revisão geral', 'Preventiva', '2024-09-02'),
(270.00, 27.00, 'Troca de correias', 'Corretiva', '2024-09-20'),
(290.00, 29.00, 'Reparo no sistema elétrico', 'Corretiva', '2024-10-05'),
(220.00, 22.00, 'Troca de fluidos', 'Preventiva', '2024-10-15'),
(300.00, 30.00, 'Reparo na suspensão', 'Corretiva', '2024-11-01'),
(250.00, 25.00, 'Troca de filtros', 'Preventiva', '2024-11-10'),
(280.00, 28.00, 'Reparo na transmissão', 'Corretiva', '2024-11-25');

-- Inserts adicionais para a tabela Feedback
INSERT INTO Feedback (DATA_FEEDBACK, AVALIACAO, COMENTARIO) VALUES 
('2024-05-23', 'Bom', 'Atendimento satisfatório, mas o carro poderia estar mais limpo.'),
('2024-05-28', 'Regular', 'Demorou para entregar o carro e o atendimento foi apenas razoável.'),
('2024-06-02', 'Ótimo', 'Serviço impecável, carro em perfeito estado.'),
('2024-06-07', 'Ruim', 'Carro apresentava problemas mecânicos e atraso na entrega.'),
('2024-06-12', 'Excelente', 'Experiência incrível, atendimento rápido e eficiente.'),
('2024-06-17', 'Bom', 'Preço justo, porém o carro estava sujo.'),
('2024-06-22', 'Regular', 'Atendimento deixou a desejar, carro não estava disponível.'),
('2024-06-27', 'Ótimo', 'Carro em excelente estado, atendimento cordial.'),
('2024-07-03', 'Ruim', 'Problemas na reserva e carro não estava pronto na hora marcada.'),
('2024-07-08', 'Excelente', 'Atendimento excepcional, carro limpo e em perfeitas condições.');

-- Inserts adicionais para a tabela Cliente
INSERT INTO Cliente (NOME, SOBRENOME, ENDERECO, CIDADE, ESTADO, EMAIL, TELEFONE, ID_PAGAMENTO) VALUES
('Fernando', 'Silva', 'Rua A, 111', 'São Luís', 'MA', 'fernando@example.com', '(98) 1234-5678', 11),
('Beatriz', 'Santos', 'Av. B, 222', 'Natal', 'RN', 'beatriz@example.com', '(84) 9876-5432', 12),
('Vanessa', 'Oliveira', 'Rua C, 333', 'João Pessoa', 'PB', 'vanessa@example.com', '(83) 3456-7890', 13),
('Ricardo', 'Rodrigues', 'Av. D, 444', 'Teresina', 'PI', 'ricardo@example.com', '(86) 6543-2109', 14),
('Felipe', 'Costa', 'Rua E, 555', 'Maceió', 'AL', 'felipe@example.com', '(82) 7890-1234', 15),
('Amanda', 'Martins', 'Av. F, 666', 'Aracaju', 'SE', 'amanda@example.com', '(79) 9012-3456', 16),
('Lucas', 'Ferreira', 'Rua G, 777', 'Belém', 'PA', 'lucas@example.com', '(91) 2345-6789', 17),
('Isabela', 'Pereira', 'Av. H, 888', 'Macapá', 'AP', 'isabela@example.com', '(96) 5678-9012', 18),
('Matheus', 'Ribeiro', 'Rua I, 999', 'Boa Vista', 'RR', 'matheus@example.com', '(95) 7890-1234', 19),
('Luana', 'Almeida', 'Av. J, 000', 'Palmas', 'TO', 'luana@example.com', '(63) 3456-7890', 20);

-- Inserts adicionais para a tabela Locacao (continuação)
INSERT INTO Locacao (DATA_LOCACAO, DATA_DEVOLUCAO, VALOR_TOTAL, ID_CLIENTE, ID_CARRO) VALUES
('2024-05-25', '2024-05-30', 220.00, 11, 1),
('2024-05-30', '2024-06-01', 180.00, 12, 2),
('2024-06-01', '2024-06-05', 200.00, 13, 3),
('2024-06-05', '2024-06-10', 250.00, 14, 4),
('2024-06-10', '2024-06-15', 210.00, 15, 5),
('2024-06-15', '2024-06-20', 230.00, 16, 6),
('2024-06-20', '2024-06-25', 240.00, 17, 7),
('2024-06-25', '2024-07-03', 260.00, 18, 8),
('2024-07-03', '2024-07-08', 250.00, 19, 9),
('2024-07-08', '2024-07-13', 270.00, 20, 10);

-- Inserts adicionais para a tabela Recebe (continuação)
INSERT INTO Recebe (ID_CARRO, ID_MANUTENCAO) VALUES
(11, 11),
(12, 12),
(13, 13),
(14, 14),
(15, 15),
(16, 16),
(17, 17),
(18, 18),
(19, 19),
(20, 20);

-- Inserts adicionais para a tabela Envia
INSERT INTO Envia (OBSERVACAO, ID_CLIENTE, ID_FEEDBACK) VALUES
('Carro limpo e pronto na hora marcada.', 11, 11),
('Demora na entrega do carro, mas serviço satisfatório.', 12, 12),
('Carro apresentava problemas mecânicos.', 13, 13),
('Atendimento rápido e cordial.', 14, 14),
('Excelente serviço, carro em perfeito estado.', 15, 15),
('Preço justo, mas o carro estava sujo.', 16, 16),
('Problemas na reserva, carro não estava disponível.', 17, 17),
('Carro em bom estado, atendimento poderia ser melhor.', 18, 18),
('Ótimo atendimento, carro em ótimas condições.', 19, 19),
('Demorou para entregar o carro, mas o serviço foi bom.', 20, 20);


-- Atividade 1

-- Listar carros "Disponiveis"
SELECT * FROM Carro
WHERE DISPONIBILIDADE = 'Disponível';

-- Listar Clientes que alugaram
SELECT DISTINCT cli.* FROM Cliente cli
INNER JOIN Locacao l ON cli.ID_CLIENTE = l.ID_CLIENTE
WHERE l.DATA_LOCACAO >= CURRENT_DATE - INTERVAL '3 months';


-- Listar Funcionarios pela Agência
SELECT * FROM Funcionarios
WHERE NUM_AGENCIA = (SELECT NUM_AGENCIA FROM Agencia WHERE CIDADE = 'New York');



SELECT * FROM Pagamento
WHERE ID_PAGAMENTO IN (SELECT ID_PAGAMENTO FROM Cliente WHERE NOME = 'Ricardo');


SELECT * FROM Carro
WHERE ID_CARRO IN (SELECT ID_CARRO FROM Recebe);


SELECT * FROM Cliente cli
WHERE (SELECT COUNT(*)
       FROM Locacao l
       WHERE l.ID_CLIENTE = cli.ID_CLIENTE) > 1;


SELECT * FROM Carro car
INNER JOIN Locacao loc ON car.ID_CARRO = loc.ID_CARRO
INNER JOIN Cliente cli ON loc.ID_CLIENTE = cli.ID_CLIENTE
INNER JOIN Funcionarios fun ON cli.CIDADE = fun.cidade
WHERE fun.NOME = 'Maria';


-- Atividade 2 

-- Atualizar o preço do aluguel de todos os carros da marca "Toyota"
UPDATE Carro
SET VALOR_ALUGUEL = VALOR_ALUGUEL * 1.1
WHERE MARCA = 'Toyota';

-- Modificar a data de retorno de um carro alugado por um cliente
UPDATE Locacao
SET DATA_DEVOLUCAO = '2024-06-10'
WHERE ID_CARRO = (SELECT ID_CARRO FROM Carro WHERE PLACA = 1234)
AND ID_CLIENTE = (SELECT ID_CLIENTE FROM Cliente WHERE NOME = 'José' AND SOBRENOME = 'Silva')
AND DATA_LOCACAO = '2024-04-01';


-- Atualizar o status de manutenção de um carro após ter sido consertado
UPDATE Carro
SET DISPONIBILIDADE = 'Disponível'
WHERE ID_CARRO = (SELECT ID_CARRO FROM Recebe WHERE ID_MANUTENCAO = 1);


-- Atividade 3

-- Adicionar uma nova coluna à tabela de Carro para armazenar o status de disponibilidade
ALTER TABLE Carro
ADD COLUMN DISPONIBILIDADE VARCHAR(20);

-- Modificar o tipo de dados de uma coluna na tabela de Pagamento
ALTER TABLE Pagamento
ALTER COLUMN VALOR DECIMAL(10, 2);

-- Remover uma coluna não utilizada da tabela de Cliente
ALTER TABLE Cliente
DROP COLUMN COLUNA_NAO_UTILIZADA;


-- Atividade 4

-- Listar todos os aluguéis de carros, incluindo o nome do cliente, modelo do carro e data de aluguel
SELECT Cliente.nome AS NomeCliente, Carro.modelo AS ModeloCarro, Locacao.DATA_LOCACAO AS DataAluguel
FROM Locacao
INNER JOIN Cliente ON Locacao.id_cliente = Cliente.id_cliente
INNER JOIN Carro ON Locacao.id_carro = Carro.id_carro;

-- 
SELECT cli.NOME, cli.SOBRENOME, pag.VALOR
FROM Cliente cli
JOIN Pagamento pag ON cli.ID_PAGAMENTO = pag.ID_PAGAMENTO;


SELECT cli.NOME, cli.SOBRENOME, ca.MODELO, f.COMENTARIO
FROM Cliente cli
JOIN Envia e ON cli.ID_CLIENTE = e.ID_CLIENTE
JOIN Feedback f ON e.ID_FEEDBACK = f.ID_FEEDBACK
JOIN Locacao l ON cli.ID_CLIENTE = l.ID_CLIENTE
JOIN Carro ca ON l.ID_CARRO = ca.ID_CARRO;


-- Atividade 5 

SELECT c.*
FROM Carro c
JOIN Agencia a ON c.ID_CARRO = a.NUM_AGENCIA
WHERE a.CIDADE = 'New York' AND c.DISPONIBILIDADE = 'Disponível';


SELECT l.*, cl.NOME, cl.SOBRENOME
FROM Locacao l
JOIN Cliente cl ON l.ID_CLIENTE = cl.ID_CLIENTE
JOIN Agencia a ON cl.CIDADE = a.CIDADE
WHERE a.CIDADE = 'New York';


SELECT DISTINCT f.*
FROM Funcionarios f
JOIN Agencia a ON f.NUM_AGENCIA = a.NUM_AGENCIA
JOIN Carro c ON a.NUM_AGENCIA = c.ID_CARRO
WHERE c.MARCA = 'Toyota';

-- Atividade 6

SELECT c.*, f.* FROM Carro c
LEFT JOIN Recebe r ON c.ID_CARRO = r.ID_CARRO
LEFT JOIN Feedback f ON r.ID_MANUTENCAO = f.ID_FEEDBACK;

SELECT cl.*, l.* FROM Cliente cl
LEFT JOIN Locacao l ON cl.ID_CLIENTE = l.ID_CLIENTE;

SELECT a.*, COUNT(c.ID_CARRO) AS TOTAL_CARROS_DISPONIVEIS
FROM Agencia a
LEFT JOIN Carro c ON a.NUM_AGENCIA = c.ID_CARRO
WHERE c.DISPONIBILIDADE = 'Disponível'
GROUP BY a.NUM_AGENCIA;

-- Atividade 7

SELECT f.*, e.*
FROM Feedback f
RIGHT JOIN Envia e ON f.ID_FEEDBACK = e.ID_FEEDBACK;

SELECT c.*, l.*
FROM Carro c
RIGHT JOIN Locacao l ON c.ID_CARRO = l.ID_CARRO;

SELECT m.*, r.*
FROM Manutencao m
RIGHT JOIN Recebe r ON m.ID_MANUTENCAO = r.ID_MANUTENCAO;

-- Atividade 8

SELECT c.* FROM Cliente c
WHERE (
    SELECT COUNT(*)
    FROM Locacao l
    WHERE l.ID_CLIENTE = c.ID_CLIENTE
) > 1;

SELECT c.* FROM Carro c
WHERE c.ID_CARRO IN (
    SELECT l.ID_CARRO
    FROM Locacao l
    WHERE l.ID_CLIENTE IN (
        SELECT ec.ID_CLIENTE
        FROM Envia en
        JOIN Feedback fb ON en.ID_FEEDBACK = fb.ID_FEEDBACK
        JOIN Cliente ec ON en.ID_CLIENTE = ec.ID_CLIENTE
        WHERE fb.AVALIACAO = 'positivo'
    )
);

-- Atividade 9

SELECT SUM(VALOR) AS TOTAL_PAGAMENTOS
FROM Pagamento
WHERE DATA_PAGAMENTO BETWEEN '2023-04-01' AND '2024-04-01';


SELECT AVG(DATEDIFF('day', m.DATA_MANUTENCAO, l.DATA_DEVOLUCAO)) AS MEDIA_DIAS_MANUTENCAO
FROM Manutencao m
JOIN Recebe r ON m.ID_MANUTENCAO = r.ID_MANUTENCAO
JOIN Locacao l ON r.ID_CARRO = l.ID_CARRO;

-- Atividade 9.1

SELECT COUNT(*) AS TOTAL_CARROS_DISPONIVEIS
FROM Carro
WHERE DISPONIBILIDADE = 'Disponível';


SELECT SUM(VALOR_TOTAL) AS TOTAL_ARRECADADO
FROM Locacao
WHERE DATA_LOCACAO >= DATE_TRUNC('quarter', CURRENT_DATE - INTERVAL '1 month') AND DATA_LOCACAO <= CURRENT_DATE;

SELECT AVG(VALOR_TOTAL / (EXTRACT(DAY FROM DATA_DEVOLUCAO - DATA_LOCACAO))) AS PRECO_MEDIO_ALUGUEL_DIA
FROM Locacao
WHERE DATA_DEVOLUCAO IS NOT NULL;


-- Atividade 9.2

SELECT MODELO, COUNT(*) AS QUANTIDADE FROM Carro
GROUP BY MODELO;

SELECT DATE_TRUNC('month', DATA_LOCACAO) AS MES, SUM(VALOR_TOTAL) AS TOTAL_ALUGUEIS FROM Locacao
GROUP BY MES;

SELECT FORMA_PAGAMENTO, SUM(VALOR) AS TOTAL_PAGAMENTOS FROM Pagamento
GROUP BY FORMA_PAGAMENTO;

-- Atividade 9.3

SELECT COUNT(*) AS TOTAL_CARROS_DISPONIVEIS FROM Carro
WHERE NUM_AGENCIA = (
    SELECT NUM_AGENCIA
    FROM Agencia
    WHERE CIDADE = 'New York'
);

SELECT SUM(l.VALOR_TOTAL) AS TOTAL_ARRECADADO FROM Locacao l
INNER JOIN Cliente cl ON l.ID_CLIENTE = cl.ID_CLIENTE
WHERE cl.CIDADE = 'São Paulo';

SELECT AVG(EXTRACT(DAY FROM (l.DATA_DEVOLUCAO - l.DATA_LOCACAO))) AS MEDIA_DIAS_ALUGADOS FROM Locacao l
INNER JOIN Carro c ON l.ID_CARRO = c.ID_CARRO
WHERE c.MARCA = 'Toyota';


-- Atividade 9.4

SELECT COUNT(*) AS NUM_ALUGUEIS_EXCEDENTES FROM Locacao
WHERE VALOR_TOTAL > 500;

SELECT SUM(p.VALOR) AS TOTAL_PAGAMENTOS
FROM Pagamento p
JOIN Cliente c ON p.ID_PAGAMENTO = c.ID_PAGAMENTO
JOIN Locacao l ON c.ID_CLIENTE = l.ID_CLIENTE
GROUP BY c.ID_CLIENTE
HAVING COUNT(l.ID_LOCALIZACAO) > 1;

-- Atividade 10

-- 1- Melhorar o desempenho da consulta
-- 2- Ordenação
-- 3- Restrições de unicidade
-- 4- Chaves estrangeiras

-- Tabelas Não Indexadas: Consultas em tabelas não indexadas podem exigir uma varredura completa da
-- tabela para encontrar os registros correspondentes às condições da consulta. Isso pode ser lento em
-- tabelas grandes, especialmente se as consultas envolverem operações complexas ou conjuntos de dados
-- extensos.
-- Tabelas Indexadas: Consultas em tabelas indexadas geralmente são mais rápidas, pois o banco de
-- dados pode usar as estruturas de índice para localizar rapidamente os registros relevantes. 
-- Isso é especialmente verdadeiro para consultas que envolvem cláusulas WHERE, JOIN ou ORDER BY em 
-- colunas indexadas.




-- Atividade 11

-- Selecionar os carros alugados por um cliente específico
SELECT c.MODELO, c.MARCA, l.DATA_LOCACAO
FROM Carro c
INNER JOIN Locacao l ON c.ID_CARRO = l.ID_CARRO
WHERE l.ID_CLIENTE = 123;

-- Atualizar o status de manutenção de um carro após uma manutenção preventiva
UPDATE Carro
SET DISPONIBILIDADE = 'Disponível'
WHERE ID_CARRO = 456;


-- Adicionar uma nova coluna para armazenar o número de portas do carro
ALTER TABLE Carro
ADD COLUMN NUMERO_PORTAS INT;


-- Listar todos os aluguéis de carros, incluindo informações do cliente e do carro
SELECT c.MODELO, cl.NOME AS NOME_CLIENTE, l.DATA_LOCACAO
FROM Carro c
INNER JOIN Locacao l ON c.ID_CARRO = l.ID_CARRO
INNER JOIN Cliente cl ON l.ID_CLIENTE = cl.ID_CLIENTE;


-- Listar os carros disponíveis na agência "X"
SELECT c.MODELO, c.MARCA
FROM Carro c
INNER JOIN Agencia a ON c.NUM_AGENCIA = a.NUM_AGENCIA
WHERE a.CIDADE = 'X';


-- Listar todos os carros e, se disponível, mostrar o feedback associado a cada carro
SELECT c.MODELO, f.COMENTARIO
FROM Carro c
LEFT JOIN Feedback f ON c.ID_CARRO = f.ID_CARRO;


-- Listar todos os feedbacks deixados pelos clientes, incluindo aqueles que não estão associados a nenhum aluguel de carro
SELECT f.COMENTARIO, c.MODELO
FROM Feedback f
RIGHT JOIN Carro c ON f.ID_CARRO = c.ID_CARRO;


-- Encontrar os carros mais alugados por clientes que deram feedback positivo
SELECT c.MODELO
FROM Carro c
WHERE c.ID_CARRO IN (
    SELECT f.ID_CARRO
    FROM Feedback f
    WHERE f.AVALIACAO = 'Positivo'
);


-- Calcule o total de pagamentos recebidos pela locadora em um determinado período
SELECT SUM(VALOR)
FROM Pagamento
WHERE DATA_PAGAMENTO BETWEEN '2024-01-01' AND '2024-03-31';













