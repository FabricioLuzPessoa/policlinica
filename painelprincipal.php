<?php 
	/*
		- Página responsavel para direcionar o funcionário para outras partes do sistema.
	*/
	// inclusão do template para inicio da sessão
	require_once('startsession.php');
	
	// inclusão do template cabeçalho
	$page_title = 'Painel Principal';
	require_once('header.php');
	
	//inclusão do template barra de navegação
	require_once('barranavegacao.php');

	if( isset($_SESSION['usuario_id']) and $_SESSION['profissao'] == 'adm_policlinica' ) {
			
		echo '<p class="my-3 mx-3"> <a href="vagaadd.php"  class="text-primary"> <img src="img/cadastrar.png"/> Cadastrar Consulta. </a></p>';
		echo '<p class="my-3 mx-3"> <a href="senhaalterar.php"  class="text-primary"> <img src="img/alterar_senha.png"> Alterar Senha. </a></p>';
	}

	if( isset($_SESSION['usuario_id']) and $_SESSION['profissao'] == 'adm_central' ) {
			
		echo '<p class="my-3 mx-3"> <a href="senhaalterar.php"  class="text-primary"> <img src="img/alterar_senha.png"> Alterar Senha. </a></p>';
	}

?>	
	
<?php
  	// Insert the page footer
	require_once('rodape.php');
?>