<?php
function navbarPadrao() {
    ?>
    <nav>
        <img id="logo" src="/img/SENAI-CAR-sem-fundo.png" alt="Logo">
        <div class="link">
            <a id="login" href="login.php">Entrar</a>
            <a id="registrar" href="cadastro.php">Registrar</a>
        </div>
    </nav>
    <div class="nav2">
        <a href="cadastro.php">Alugar</a>
        <a href="#catalago">Catálogo</a>
        <a href="">Contato</a>
        <a href="">Sobre</a>
    </div>
    <?php
}

function navbarLogado(){
     ?>
    <nav>
    <img id="logo" src="/img/SENAI-CAR-sem-fundo.png" alt="Logo">
    <div class="link">
     <a href="/index.php" id="registrar">Sair</a>
     
    </div>
</nav>
<div class="nav2">
    <a href="">Alugar</a>
    <a href="">Catálago</a>
    <a href="">Contato</a>
    <a href="">Sobre</a>
</div>

<?php
}

function navbarFuncionario(){
  ?>
    <nav>
        <img id="logo" src="/img/SENAI-CAR-sem-fundo.png" alt="Logo">
        <div class="link">
         <a href="/index.php" id="registrar">Sair</a>
         
        </div>
    </nav>
    <div class="nav2">
        <a href="">Pedidos</a>
        <a href="/listaCliente.php">Clientes</a>
        <a href="/listaFuncionario.php">Funcionarios</a>
        <a href="/listaCarro.php">Carros</a>
    </div>



<?php
}

?>
