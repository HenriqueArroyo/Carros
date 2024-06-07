<?php
// Verificar se o ID do carro foi fornecido na URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "ID do carro não fornecido.";
    exit;
}

// Capturar o ID do carro da URL
$id_carro = $_GET['id'];

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Processar os dados do formulário e atualizar o carro no banco de dados
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

        // Atualizar os dados do carro no banco de dados
        $sql_atualizar_carro = "UPDATE carro SET ano = :ano, placa = :placa, modelo = :modelo, tipo = :tipo, marca = :marca, disponibilidade = :disponibilidade, preco = :preco WHERE id_carro = :id";
        $stmt = $pdo->prepare($sql_atualizar_carro);
        $stmt->bindParam(':ano', $_POST['ano']);
        $stmt->bindParam(':placa', $_POST['placa']);
        $stmt->bindParam(':modelo', $_POST['modelo']);
        $stmt->bindParam(':tipo', $_POST['tipo']);
        $stmt->bindParam(':marca', $_POST['marca']);
        $stmt->bindParam(':disponibilidade', $_POST['disponibilidade']);
        $stmt->bindParam(':preco', $_POST['preco']);
        $stmt->bindParam(':id', $id_carro);
        $stmt->execute();

        // Redirecionar para listaCarros.php após a edição
        header("Location: listaCarro.php");
        exit;
    } catch (PDOException $e) {
        echo "Falha ao conectar ao banco de dados. <br/>";
        die($e->getMessage());
    }
} else {
    // Formulário de edição do carro
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

        // Consulta para obter os dados do carro
        $sql_carro = "SELECT * FROM carro WHERE id_carro = :id";
        $stmt = $pdo->prepare($sql_carro);
        $stmt->bindParam(':id', $id_carro);
        $stmt->execute();
        $carro = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Falha ao conectar ao banco de dados. <br/>";
        die($e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Carro</title>
</head>
<body>

<h2>Editar Carro</h2>
<form method="post">
    Ano: <input type="text" name="ano" value="<?php echo $carro['ano']; ?>"><br>
    Placa: <input type="text" name="placa" value="<?php echo $carro['placa']; ?>"><br>
    Modelo: <input type="text" name="modelo" value="<?php echo $carro['modelo']; ?>"><br>
    Tipo: <input type="text" name="tipo" value="<?php echo $carro['tipo']; ?>"><br>
    Marca: <input type="text" name="marca" value="<?php echo $carro['marca']; ?>"><br>
    Disponibilidade: <input type="text" name="disponibilidade" value="<?php echo $carro['disponibilidade']; ?>"><br>
    Preço: <input type="text" name="preco" value="<?php echo $carro['preco']; ?>"><br>
    <input type="submit" value="Salvar">
</form>

</body>
</html>
