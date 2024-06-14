<?php
function navbarPadrao() {
    ?>
    <nav>
    <a href="/index.php"><img id="logo" src="/img/SENAI-CAR-sem-fundo.png" alt="Logo"></a> 
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
   <a href="/indexLog.php"><img id="logo" src="/img/SENAI-CAR-sem-fundo.png" alt="Logo"></a> 
    <div class="link">
     <a href="/index.php" id="registrar">Sair</a>
     
    </div>
</nav>
<div class="nav2">
    <a href="/cadastrarLocacao.php">Alugar</a>
    <a href="#catalago">Catálago</a>
    <a href="">Contato</a>
    <a href="">Sobre</a>
</div>

<?php
}

function navbarFuncionario(){
  ?>
    <nav>
       <a href="/indexFun.php"><img id="logo" src="/img/SENAI-CAR-sem-fundo.png" alt="Logo"></a> 
        <div class="link">
         <a href="/index.php" id="registrar">Sair</a>
         
        </div>
    </nav>
    <div class="nav2">
        <a href="/listaPedidos.php">Pedidos</a>
        <a href="/listaCliente.php">Clientes</a>
        <a href="/listaFuncionario.php">Funcionarios</a>
        <a href="/listaCarro.php">Carros</a>
    </div>



<?php
}

function footer(){
?>
  
  <div class= "container-fluid" > 
    <footer>
	<p>&copy; 2023 - Todos os direitos reservados</p>
	<nav>
		<ul>
			<li><a >Termos de uso</a></li>
			<li><a >Política de privacidade</a></li>
			<li><a >Sobre nós</a></li>
			<li><a >Contato</a></li>
		</ul>
	</nav>
</footer> 
</div>
<?php
}
