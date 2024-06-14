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
    <img id="front" src="/img/front-corolla.png" alt="">
    <img id="back" src="/img/back-corolla.png" alt="">
    <br>
    <div class="info">
    <h3>Toyota Corolla</h3>
    <p>Ano: 2018 </p>
    <p>Modelo: Sedan</p>
    <p>Preço: R$ 950</p>
    <p>Situação: Disponível</p>
    
  <a href="/cadastrarLocacao.php"> <button type="submit">Alugar</button></a>
  </div>
 </div>
    </section>
    <?php footer(); ?>

</body>
<script src="/js/script.js"></script>
</html>