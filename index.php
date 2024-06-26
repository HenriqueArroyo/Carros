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
    <?php navbarPadrao(); ?>

    <section >
        <div class="slider">
            <div class="slides">

                <input type="radio" name="radio-btn" id="radio1">
                <input type="radio" name="radio-btn" id="radio2">
                <input type="radio" name="radio-btn" id="radio3">
                <input type="radio" name="radio-btn" id="radio4">

                <div class="slide first">
                    <img src="/img/carousel1.png" alt="imagem 1">
                </div>
                <div class="slide ">
                    <img src="/img/carousel2.png" alt="imagem 2">
                </div>
                <div class="slide ">
                    <img src="/img/carousel3.png" alt="imagem 3">
                </div>
                <div class="slide">
                    <img src="/img/carousel4.png" alt="imagem 4">
                </div>

                <div class="navigation-auto">
                    <div class="auto-btn1"></div>
                    <div class="auto-btn2"></div>
                    <div class="auto-btn3"></div>
                    <div class="auto-btn4"></div>
                </div>

            </div>

        <div class="manual-navigation">
               <label for="radio1" class="manual-btn"></label>
               <label for="radio2" class="manual-btn"></label>
               <label for="radio3" class="manual-btn"></label>
               <label for="radio4" class="manual-btn"></label>
        </div>
        </div>
        <hr>
        <h1 id="titulo">Catálago de Carros</h1>
        <div id="catalago" class="catalago">
           


    <a href="/login.php">    <div class="car1">
           <img src="/img/honda-civic.webp"
            alt="">
            <h4>Honda Civic</h4>
            <h6>R$ 1.000 a diária</h6>
         </div></a> 
          
      <a href="/login.php">  <div class="car2">
            <img src="/img/fiat-palio.webp"
            alt="">
            <h4>Fiat Palio</h4>
            <h6>R$ 700 a diária</h6>
          </div></a>  

          
       <a href="/login.php"> <div class="car3">
            <img src="/img/ford-ecosport.webp"
            alt="">
            <h4>Ford Ecosport</h4>
            <h6>R$ 800 a diária</h6>
         </div></a> 
        </div>
        <div class="catalago">
           <a href="/login.php"><div class="car4">
            <img src="/img/honda-fit.webp"
            alt="">
            <h4>Honda Fit</h4>
            <h6>R$ 800 a diária</h6>
            </div></a> 
  
            
          <a href="/login.php"><div class="car5">
            <img src="/img/hyundai-hb20.webp"
            alt="">
            <h4>Hyundai HB20</h4>
            <h6>R$1400 a diária</h6>
           </div></a> 
            
          <a href="/login.php"> <div class="car6">
            <img src="/img/toyota-corolla.webp"
            alt="">
            <h4>Toyota Corolla</h4>
            <h6>R$ 950 a diária</h6>
            </div></a> 
        </div>

    </section>
    <?php footer(); ?>
</body>
<script src="/js/script.js"></script>
</html>