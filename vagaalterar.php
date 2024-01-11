<?php
	// inclusão do template para inicio da sessão
	require_once('startsession.php');
	// inclusão do template cabeçalho
	$page_title = 'Cadastrar Vaga';
	//Cabeçalho
	require_once('header.php');
	//inclusão do template barra de navegação
	require_once('barranavegacao.php');
	require_once('conexao.php');
	// if verdadeiro se a sessão tiver sido criada
	if( isset($_SESSION['usuario_id']) ) {

		// conecta ao banco de dados
		$dbc = mysqli_connect(SERVIDOR, USUARIO, SENHA, BANCO_DE_DADOS) or die ('Erro ao conectar ao banco de dados!');

		if( isset($_POST['submit']) ) {

			// IF CENTRAL
			if($_SESSION['usuario_id'] === '2' ) {

				// CAPTURA OS DAODS DIGITADOS PELA CENTRAL DE MARCAÇÃO
				$vaga_id                    = mysqli_real_escape_string($dbc, trim($_POST['vaga_id']));
				$paciente_atendido_nome     = mysqli_real_escape_string($dbc, trim($_POST['paciente_atendido_nome']));
				$central_data_preenchimento = mysqli_real_escape_string($dbc, trim($_POST['central_data_preenchimento']));
																
				// String de Alteração da tabela	
				$consulta = "UPDATE controle_vaga SET paciente_atendido_nome = '$paciente_atendido_nome', central_data_preenchimento='$central_data_preenchimento'
				WHERE id_vaga = '" . $vaga_id . "'";

				// Executa a consulta 							
				$exec = mysqli_query($dbc, $consulta) or die ('Erro ao inserir dados do banco de dados!');
					
				// fecho a conexão com o banco de dados
				mysqli_close($dbc);
								
				// Crio uma url para redirecionar a página atual para a páginla do painel principal.
				$url_painel_principal = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/vagatabela.php';

				header('Location: ' . $url_painel_principal); // função que recebe um link e redireciona a página para esse link
				
				// informa ao funcionário que ele deve preencher todos os dados.
				echo '<p class="error"> Você deve preencher todos os dados para cadastramento da vaga! </p>';
			// IF POLICLINICA
			} else if($_SESSION['usuario_id'] === '1' ) {

				$consulta_dia = implode('/', $_POST['consulta_dia']);

				// CAPTURA OS DAODS DIGITADOS PELA CENTRAL DE POLICLINICA
				$vaga_id               = mysqli_real_escape_string($dbc, trim($_POST['vaga_id']));
				$consulta_descricao    = mysqli_real_escape_string($dbc, trim($_POST['consulta_descricao']));
				$profissional_nome     = mysqli_real_escape_string($dbc, trim($_POST['profissional_nome']));
				$consulta_tipo         = mysqli_real_escape_string($dbc, trim($_POST['consulta_tipo']));
				$data_liberada         = mysqli_real_escape_string($dbc, trim($_POST['data_liberada']));
				$consulta_dia          = mysqli_real_escape_string($dbc, trim($consulta_dia));
				$consulta_hora         = mysqli_real_escape_string($dbc, trim($_POST['consulta_hora']));
				$paciente_compareceu   = mysqli_real_escape_string($dbc, trim($_POST['paciente_compareceu']));
				$paciente_data_entrada = mysqli_real_escape_string($dbc, trim($_POST['paciente_data_entrada']));
				$observacao            = mysqli_real_escape_string($dbc, trim($_POST['observacao']));
				

				if($paciente_data_entrada === "") {
					// String de Alteração da tabela	
					$consulta = "UPDATE controle_vaga SET 
					paciente_confirmacao_consulta = '$paciente_compareceu', 
					consulta_descricao            = '$consulta_descricao', 
					consulta_hora                 = '$consulta_hora', 
					profissional_nome             = '$profissional_nome', 
					consulta_tipo                 = '$consulta_tipo',
					data_liberada                 = '$data_liberada',
					consulta_dia                  = '$consulta_dia',
					observacao                    = '$observacao'
					WHERE id_vaga                 = '" . $vaga_id . "'";
				} else {
					// String de Alteração da tabela	
					$consulta = "UPDATE controle_vaga SET 
					paciente_confirmacao_consulta = '$paciente_compareceu', 
					consulta_descricao            = '$consulta_descricao', 
					paciente_data_entrada         = '$paciente_data_entrada', 
					profissional_nome             = '$profissional_nome', 
					consulta_tipo                 = '$consulta_tipo', 
					data_liberada                 = '$data_liberada',
					consulta_hora                 = '$consulta_hora',
					consulta_dia                  = '$consulta_dia',
					observacao                    = '$observacao' 
					WHERE id_vaga                 = '" . $vaga_id . "'";
				}
				// Executa a consulta 							
				$exec = mysqli_query($dbc, $consulta) or die ('Erro ao inserir dados do banco de dados!');
					
				// fecho a conexão com o banco de dados
				mysqli_close($dbc);
								
				// Crio uma url para redirecionar a página atual para a páginla do painel principal.
				$url_painel_principal = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/vagatabela.php';

				header('Location: ' . $url_painel_principal); // função que recebe um link e redireciona a página para esse link
				
				// informa ao funcionário que ele deve preencher todos os dados.
				echo '<p class="error"> Você deve preencher todos os dados para cadastramento da vaga! </p>';
			}
		} else {
			// ELSE EXECUTADO NO CASO DO USUARIO NÃO TER CLICADO NO SUBMIT
			// CONECTA AO BANDO DE DADOS
			$dbc = mysqli_connect(SERVIDOR, USUARIO, SENHA, BANCO_DE_DADOS) or die ('Erro ao conectar ao banco de dados!');

			// STRING DE CONSULTA
			$consulta = "SELECT id_vaga, consulta_descricao, consulta_tipo, profissional_nome, data_liberada, consulta_dia, central_data_preenchimento, 
			paciente_atendido_nome, consulta_hora, paciente_confirmacao_consulta, paciente_data_entrada, observacao FROM controle_vaga WHERE id_vaga =" . $_GET['id_vaga'];
	
			// EXECUTA A CONSULTA E ARMAZENA NA VARIAVEL TABELA
			$tabela = mysqli_query($dbc, $consulta) or die('Erro ao realizar a consulta no banco de dados');

			$row = mysqli_fetch_array($tabela);

			$vaga_id                       = $row['id_vaga'];
			$consulta_descricao            = $row['consulta_descricao'];
			$consulta_tipo                 = $row['consulta_tipo'];
			$profissional_nome             = $row['profissional_nome'];
			$data_liberada                 = $row['data_liberada'];
			$consulta_dia                  = $row['consulta_dia'];
			$paciente_atendido_nome        = $row['paciente_atendido_nome'];
			$central_data_preenchimento    = $row['central_data_preenchimento'];
			$paciente_confirmacao_consulta = $row['paciente_confirmacao_consulta'];
			$paciente_data_entrada         = $row['paciente_data_entrada'];
			$consulta_hora                 = $row['consulta_hora'];
			$observacao                    = $row['observacao'];

			// FECHA CONEXÃO COM O BANCO DE DADOS
			mysqli_close($dbc);
		}
	
		if($_SESSION['usuario_id'] === '2' ) {
	//#isset Session			
?>

<!-- FORMULARIO PARA O PESSOAL DA CENTRAL ALTERAR -->
<form method="post" action = "<?php echo $_SERVER['PHP_SELF']; ?>">
	<fieldset>
		<legend class="text-dark font-weight-bold"> Informe data de preenchimento e nome do paciente para ocupar a vaga.</legend>
		<table>
			<tr>
				<td class="text-dark">ID da Vaga:</td>
				<td><input type="text" id="vaga_id" name="vaga_id" value="<?php if (!empty($vaga_id)) echo $vaga_id;?>" class="form-control form-control-sm" readonly /></td>
			</tr>
			<tr>
				<td class="text-dark">Nome do Paciente:</td>
				<td><input type="text" id="paciente_atendido_nome" name="paciente_atendido_nome" value="<?php if (!empty($paciente_atendido_nome)) echo $paciente_atendido_nome; ?>" class="form-control form-control-sm" /></td>
			</tr>
			<tr>
				<td class="text-dark">Data de Preenchida:</td>
				<td><input type="date" id="central_data_preenchimento" name="central_data_preenchimento" value="<?php echo date('Y-m-d'); ?>" class="form-control form-control-sm" /></td>
			</tr>
			<tr>
				<!-- Botão faz uma chamada recursiva para a mesma página -->
				<td><input type="submit" value="Alterar" name="submit" class="btn btn-danger" /></td>
			</tr>
		</table>
	</fieldset>
</form>

<?php
	} else if($_SESSION['usuario_id'] === '1' ) {
?>
<!-- FORMULARIO PARA O PESSOAL DA POLICLINICA ALTERAR -->
<form method="post" action = "<?php echo $_SERVER['PHP_SELF']; ?>">
	<fieldset>
		<legend class="text-dark font-weight-bold"> Informe a se o paciente compareceu e a data de atendimento.</legend>
		<div class="row float-start">
			<div class="col">
				<table>
					<tr>
						<td class="text-dark">ID da Vaga:</td>
						<td><input type="text" id="vaga_id" name="vaga_id" value="<?php if (!empty($vaga_id)) echo $vaga_id;?>" class="form-control form-control-sm" readonly /></td>
					</tr>
					<tr>
						<td class="text-dark">Descrição:</td>
						<td>
							<select id="consulta_descricao" name="consulta_descricao" class="form-control form-control-sm" onchange="alterar()" required>
								<option value="<?php echo $consulta_descricao ?>"></option>
							</select>
						</td>
					</tr>
					<tr>
						<td class="text-dark">Nome do Profissional:</td>
						<td>
							<select id="profissional_nome" name="profissional_nome" class="form-control form-control-sm" value="Abacaxi" required>
								<option value="<?php echo $profissional_nome ?>"></option>
							</select>
						</td>
					</tr>
					<tr>
						<td class="text-dark">Tipo:</td>
						<td>
							<select id="consulta_tipo" name="consulta_tipo" value="<?php if (!empty($consulta_tipo)) echo $consulta_tipo; ?>" class="form-control form-control-sm" required>
							<option value="<?php echo $consulta_tipo ?>"></option>
							</select>
						</td>
					</tr>
					<tr>
						<td class="text-dark">Data de liberação:</td>
						<td><input type="date" id="data_liberada" name="data_liberada" class="form-control form-control-sm" value="<?php if (!empty($data_liberada)) echo $data_liberada; ?>" required /></td>
					</tr>
					<tr>
						<td class="text-success">Dia da Consulta:</td>
						<td>
							<input type="checkbox" id="consulta_dia[]" name="consulta_dia[]" value="Segunda" class="form-check-input" <?php if(strpos($consulta_dia, "Segunda") !== false) echo 'checked'; ?>> SEGUNDA </input>
							<input type="checkbox" id="consulta_dia[]" name="consulta_dia[]" value="Terça"   class="form-check-input" <?php if(strpos($consulta_dia, "Terça") !== false)   echo 'checked'; ?>> TERÇA   </input>
							
						</td>
					</tr>
					<tr>
						<td></td>
						<td>
							<input type="checkbox" id="consulta_dia[]" name="consulta_dia[]" value="Quarta" class="form-check-input" <?php if(strpos($consulta_dia, "Quarta") !== false)   echo 'checked'; ?>> QUARTA  </input>
							<input type="checkbox" id="consulta_dia[]" name="consulta_dia[]" value="Quinta" class="form-check-input" <?php if(strpos($consulta_dia, "Quinta") !== false)   echo 'checked'; ?>> QUINTA  </input>
						</td>	
					</tr>
					<tr>
						<td></td>
						<td><input type="checkbox" id="consulta_dia[]" name="consulta_dia[]" value="Sexta"  class="form-check-input" <?php if(strpos($consulta_dia, "Sexta") !== false)   echo 'checked'; ?>> SEXTA   </input></td>
					</tr>	
					<tr>
						<td class="text-dark">Hora:</td>
						<td><input type="time" id="consulta_hora" name="consulta_hora" value="<?php if (!empty($consulta_hora)) echo $consulta_hora; ?>" class="form-control form-control-sm" /></td>
					</tr>
					<tr>
						<!-- Botão faz uma chamada recursiva para a mesma página -->
						<td><input type="submit" value="Alterar" name="submit" class="btn btn-success" /></td>
						<td><input type="button" value="Exluir Consulta" class="btn btn-danger" onClick="excluirConsulta(<?php echo $vaga_id; ?>)"/></td>
					</tr>
				</table>	
			</div>
			<div class="col">	
				<table>
					<tr>
						<td class="text-dark">Observação:</td>
						<td><input type="text" id="observacao" name="observacao" value="<?php if (!empty($observacao)) echo $observacao; ?>" class="form-control form-control-sm"/></td>
					</tr>
					<tr>
						<td class="text-dark">Paciente Compareceu:</td>
						<td>
							<select id="paciente_compareceu" name="paciente_compareceu" class="form-control form-control-sm">
								<option value=""                                                                                                                    >     </option>
								<option value="SIM"  <?php if( isset($paciente_confirmacao_consulta) and $paciente_confirmacao_consulta== "SIM") echo "selected"; ?>> SIM </option>
								<option value="NÃO"  <?php if( isset($paciente_confirmacao_consulta) and $paciente_confirmacao_consulta== "NÃO") echo "selected"; ?>> NÃO </option>
							</select>
						</td>
						
					</tr>
					<tr>
						<td class="text-dark">Data de Atendimento:</td>
						<td><input type="date" id="paciente_data_entrada" name="paciente_data_entrada" class="form-control form-control-sm" value="<?php if (!empty($paciente_data_entrada)) echo $paciente_data_entrada; ?>" /></td>
					</tr>
				</table>
			</div>
		</div>
	</fieldset>
</form>
<script src="preencherdados.js"></script>
<script src="preencherdados2.js"></script>
<script src="consultaexcluir.js"></script>
<?php	
		}
	}//#session			
?>	

<?php
	// Insert the page footer
	require_once('rodape.php');
?>