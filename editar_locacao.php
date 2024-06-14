<?php
// Verificar se o ID da locação foi fornecido
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "ID da locação não fornecido.";
    exit;
}

// Conectar ao banco de dados
try {
    $pdo = new PDO("pgsql:host=localhost;dbname=locadora_carros", "postgres", "postgres");
} catch (PDOException $e) {
    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar os dados do formulário
    $id_locacao = $_POST['id_locacao'];
    $data_locacao = $_POST['data_locacao'];
    $data_devolucao = $_POST['data_devolucao'];
    $valor_total = $_POST['valor_total'];
    $id_cliente = $_POST['id_cliente'];
    $id_carro = $_POST['id_carro'];

    // Atualizar os dados da locação no banco de dados
    $query = "UPDATE Locacao SET DATA_LOCACAO = :data_locacao, DATA_DEVOLUCAO = :data_devolucao, 
              VALOR_TOTAL = :valor_total, ID_CLIENTE = :id_cliente, ID_CARRO = :id_carro WHERE ID_LOCACAO = :id_locacao";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':data_locacao', $data_locacao);
    $stmt->bindParam(':data_devolucao', $data_devolucao);
    $stmt->bindParam(':valor_total', $valor_total);
    $stmt->bindParam(':id_cliente', $id_cliente);
    $stmt->bindParam(':id_carro', $id_carro);
    $stmt->bindParam(':id_locacao', $id_locacao);
    
    if ($stmt->execute()) {
        echo "Locação atualizada com sucesso.";
        header('location: listaPedidos.php');
    } else {
        echo "Erro ao atualizar a locação.";
    }
} else {
    // Recuperar o ID da locação da URL
    $id_locacao = $_GET['id'];

    // Consulta para recuperar os dados da locação com base no ID
    $query = "SELECT * FROM Locacao WHERE ID_LOCACAO = :id_locacao";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id_locacao', $id_locacao);
    $stmt->execute();

    // Verificar se a locação existe
    if ($stmt->rowCount() > 0) {
        // Recuperar os dados da locação
        $locacao = $stmt->fetch(PDO::FETCH_ASSOC);
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Editar Locação</title>
        </head>
        <style>
    body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

h1 {
    text-align: center;
    margin-top: 30px;
}

form {
    max-width: 400px;
    margin: 0 auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
}

label {
    display: block;
    margin-bottom: 5px;
}

input[type="text"],
input[type="email"],
input[type="tel"],
input[type="password"],
select {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

select {
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="12" height="6"><polygon points="6,0 0,6 12,6"/></svg>');
    background-repeat: no-repeat;
    background-position: right 10px center;
    background-size: 8px 4px;
}

input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    padding: 15px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    width: 100%;
}

input[type="submit"]:hover {
    background-color: #45a049;
}
</style>
        <body>
        <h2>Editar Locação</h2>
        <form method="post">
            <input type="hidden" name="id_locacao" value="<?php echo $locacao['id_locacao']; ?>">
            Data Locação: <input type="date" name="data_locacao" value="<?php echo $locacao['data_locacao']; ?>"><br>
            Data Devolução: <input type="date" name="data_devolucao" value="<?php echo $locacao['data_devolucao']; ?>"><br>
            Valor Total: <input type="text" name="valor_total" value="<?php echo $locacao['valor_total']; ?>"><br>
            ID Cliente: <input type="text" name="id_cliente" value="<?php echo $locacao['id_cliente']; ?>"><br>
            ID Carro: <input type="text" name="id_carro" value="<?php echo $locacao['id_carro']; ?>"><br>
            <input type="submit" value="Salvar">
        </form>
        </body>
        </html>
        <?php
    } else {
        echo "Locação não encontrada.";
    }
}
?>
