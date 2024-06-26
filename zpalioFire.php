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
    <img id="front" src="/img/front_palio.jpg" alt="">
    <img id="back" src="/img/back_palio.webp" alt="">
    <br>
    <div class="info">
    <h3>Palio Fire</h3>
    <p>Ano: 2021 </p>
    <p>Modelo: Hatchback</p>
     <p>Preço: R$ 700</p>
    <p>Situação: Disponível</p>
    
  <a href="/cadastrarLocacao.php"> <button type="submit">Alugar</button></a>
  </div>
 </div>
    </section>
    <?php footer(); ?>

</body>
<script src="/js/script.js"></script>
</html>