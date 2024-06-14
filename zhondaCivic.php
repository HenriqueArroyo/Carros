<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicial</title>
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
<?php include_once 'functions.php'; ?>
    <?php navbarLogado(); ?>

    <section>
 <div class="border">
    <img id="front" src="/img/front_civic.jpg" alt="">
    <img id="back" src="/img/back_civic.jpg" alt="">
    <br>
    <div class="info">
    <h3>Honda Civic</h3>
    <p>Ano: 2022 </p>
    <p>Modelo: Sedan</p>
    <p>Preço: R$ 1.000</p>
    <p>Situação: Disponível</p>
    
  <a href="/cadastrarLocacao.php">  <button type="submit">Alugar</button></a>
  </div>
 </div>
    </section>
    <footer>
    
    </footer>
</body>
<script src="/js/script.js"></script>
</html>