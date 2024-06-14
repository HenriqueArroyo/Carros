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
    <img id="front" src="/img/front-hb20.avif" alt="">
    <img id="back" src="/img/back-hb20.avif" alt="">
    <br>
    <div class="info">
    <h3>Hyundai HB20</h3>
    <p>Ano: 2019 </p>
    <p>Modelo: Hatchback</p>
    <p>Preço: R$ 1.400</p>
    <p>Situação: Disponível</p>
    
  <a href="/cadastrarLocacao.php"> <button type="submit">Alugar</button></a>
  </div>
 </div>
    </section>
    <?php footer(); ?>

</body>
<script src="/js/script.js"></script>
</html>