<?php

    // inclusão do template para inicio da sessão
    require_once('startsession.php');
    require_once('conexao.php');

    // IF VERDADEIRO SE A SESSÃO TIVER SIDO CRIADA
	if( isset($_SESSION['usuario_id']) ) {

        // CONECTA AO BANCO DE DADOS
		$dbc = mysqli_connect(SERVIDOR, USUARIO, SENHA, BANCO_DE_DADOS) or die ('Erro ao conectar ao banco de dados!');
        
        // RECEBE O ID DO PACIENTE ATRAVÉS DO PROTOCOLO POST
        $idConsulta = $_REQUEST['variavel']; 
        
        // STRING DE CONSULTA PARA EXCLUIR O PACIENTE
        $stringDelete = "DELETE FROM controle_vaga where id_vaga = " . $idConsulta;
        
        // EXECUTA A CONSULTA 							
		$exec = mysqli_query($dbc, $stringDelete) or die ('Erro ao exlcuir o paciente do registro!');
		
        // FECHO A CONEXÃO COM O BANDO DE DADOS
		mysqli_close($dbc);
        
        echo 'Consulta excluida  com sucesso!';

    }
?>