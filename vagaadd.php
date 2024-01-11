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

		if( isset($_POST['submit']) ) {
								
			// conecta ao banco de dados
			$dbc = mysqli_connect(SERVIDOR, USUARIO, SENHA, BANCO_DE_DADOS) or die ('Erro ao conectar ao banco de dados!');

			//print_r($$_POST['consulta_dia']);
			
			$consulta_dia = implode('/', $_POST['consulta_dia']);
			
			// capture os dados digitados pelo funcionário
			$consulta_descricao = mysqli_real_escape_string($dbc, trim($_POST['consulta_descricao']));
			$profissional_nome  = mysqli_real_escape_string($dbc, trim($_POST['profissional_nome']));
			$consulta_tipo      = mysqli_real_escape_string($dbc, trim($_POST['consulta_tipo']));
			$data_liberada      = mysqli_real_escape_string($dbc, trim($_POST['data_liberada']));
			$consulta_dia       = mysqli_real_escape_string($dbc, trim($consulta_dia));
			$consulta_hora      = mysqli_real_escape_string($dbc, trim($_POST['consulta_hora']));
			$observacao         = mysqli_real_escape_string($dbc, trim($_POST['observacao']));
									
			// condição verdadeira se nenhum dos campos estiverem vazio.								
			if( !empty($consulta_descricao) && !empty($consulta_tipo) && !empty("$profissional_nome") && 
			!empty("$data_liberada") && !empty("$consulta_dia") && !empty("$consulta_hora") ) {
								
				// String de inserção do registro no banco de dados	
				$consulta = "INSERT INTO controle_vaga ( consulta_descricao, consulta_tipo, profissional_nome, data_liberada, consulta_dia, consulta_hora, observacao ) 
							 VALUES ( '$consulta_descricao', '$consulta_tipo', '$profissional_nome', '$data_liberada', '$consulta_dia', '$consulta_hora', '$observacao' )";

				// Executa a consulta 							
				$exec = mysqli_query($dbc, $consulta) or die ('Erro ao inserir dados do banco de dados!');
				
				// fecho a conexão com o banco de dados
				mysqli_close($dbc);
									
				echo '<p class="ok">Paciente cadastrado com sucesso!</p>';
							
			} else {
				// informa ao funcionário que ele deve preencher todos os dados.
				echo '<p class="error"> Você deve preencher todos os dados para cadastramento da vaga! </p>';
			}
		}//#submit
?>

<!-- Formulário para cadastro de consulta -->
<form method="post" action = "<?php echo $_SERVER['PHP_SELF']; ?>">
	<fieldset>
		<legend class="text-dark font-weight-bold"> Preencha a descrição da vaga.</legend>
		<table>
			<tr>
				<td class="text-success">Descrição:</td>
				<td>
					<select id="consulta_descricao" name="consulta_descricao" class="form-control form-control-sm" onchange="alterar()" required>
					    <option value=""               >                </option>
						<option value="Fisioterapeuta" > Fisioterapeuta </option>
						<option value="Fonoaudiólogo"  > Fonoaudiólogo  </option>
						<option value="Psicólogo"      > Psicólogo      </option>
					</select>
				</td>
			</tr>
			<tr>
				<td class="text-success">Nome do Profissional:</td>
			<td><select id="profissional_nome" name="profissional_nome" class="form-control form-control-sm" required></select></td>
			</tr>
			<tr>
				<td class="text-success">Tipo:</td>
				<td><select id="consulta_tipo" name="consulta_tipo" value="<?php if (!empty($consulta_tipo)) echo $consulta_tipo; ?>" class="form-control form-control-sm" required></select></td>
			</tr>
			<tr>
				<td class="text-success">Data de liberação:</td>
				<td><input type="date" id="data_liberada" name="data_liberada" value="<?php echo date('Y-m-d'); ?>" class="form-control form-control-sm" required /></td>
			</tr>
			<tr>
				<td class="text-success">Dia da Consulta:</td>
				<td>
					<input type="checkbox" id="consulta_dia[]" name="consulta_dia[]" value="Segunda" class="form-check-input"> SEGUNDA </input>
					<input type="checkbox" id="consulta_dia[]" name="consulta_dia[]" value="Terça"   class="form-check-input"> TERÇA   </input>
					
				</td>
			</tr>
			<tr>
				<td></td>
				<td>
					<input type="checkbox" id="consulta_dia[]" name="consulta_dia[]" value="Quarta" class="form-check-input"> QUARTA  </input>
					<input type="checkbox" id="consulta_dia[]" name="consulta_dia[]" value="Quinta" class="form-check-input"> QUINTA  </input>
				</td>	
			</tr>
			<tr>
				<td></td>
				<td><input type="checkbox" id="consulta_dia[]" name="consulta_dia[]" value="Sexta"  class="form-check-input"> SEXTA   </input></td>
			</tr>	
			<tr>
				<td class="text-success">Hora:</td>
				<td><input type="time" id="consulta_hora" name="consulta_hora" class="form-control form-control-sm" required /></td>
			</tr>
			<tr>
				<td class="text-dark"> Observação:</td>
				<td><input type="text" id="observacao" name="observacao" class="form-control form-control-sm"></td>
			</tr>
			<tr>
				<!-- Botão faz uma chamada recursiva para a mesma página -->
				<td><input type="submit" value="Cadastrar" name="submit" class="btn btn-success" /></td>
			</tr>
		</table>
	</fieldset>
</form>
<script src="preencherdados.js"></script>
<?php	
	}//#session			
?>	

<?php
	// Insert the page footer
	require_once('rodape.php');
?>

<!-- <select id="consulta_dia" name="consulta_dia" class="form-control form-control-sm" required>
					    <option value="Segunda-Feira"> Segunda-Feira </option>
						<option value="Terça-Feira"  > Terça-Feira   </option>
						<option value="Quarta-Feira" > Quarta-Feira  </option>
						<option value="Quinta-Feira" > Quinta-Feira  </option>
						<option value="Sexta-Feira"  > Sexta-Feira   </option>
</select> -->



