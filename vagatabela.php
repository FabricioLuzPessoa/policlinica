<?php
	// inclusão do template para inicio da sessão
	require_once('startsession.php');
	// inclusão das contantes de conexão
	require_once('conexao.php');
	// inclusão do template cabeçalho
	$page_title = 'Tabela de Consultas';
	require_once('header.php');
	//inclusão do template barra de navegação
	require_once('barranavegacao.php');
	// SE SESSÃO USUARIO CRIADA.
	if( isset($_SESSION['usuario_id']) ) {
			
		// aqui se abre uma conexão com o banco de dados.
		$dbc = mysqli_connect(SERVIDOR, USUARIO, SENHA, BANCO_DE_DADOS) or die ('Erro ao conectar ao banco de dados!');

		// CONDIÇÃO VERDADEIRA SE O CLIENTE CLICAR NO BOTÃO SUBMIT ALTERAR
		if(isset($_POST['submit'])){
			// captura a informação do formulário	
			$filtrar = mysqli_real_escape_string($dbc, trim($_POST['filtrar']));

			// SE CARTÃO VAZIO
			if(empty($filtrar)) {
							
				// FAZ UMA CONSULTA DE TODAS AS CONSULTAS
				$consulta = "SELECT id_vaga, consulta_descricao, consulta_tipo, profissional_nome, data_liberada, consulta_dia, consulta_hora, central_data_preenchimento, paciente_atendido_nome, 
				paciente_confirmacao_consulta, paciente_data_entrada, observacao FROM controle_vaga ORDER BY data_liberada DESC, consulta_hora DESC";
			} else {
								
				// FAZ A CONSULTA APENAS DE UM TIPO DE DESCRIÇÃO DE CONSULTA
				$consulta = "SELECT id_vaga, consulta_descricao, consulta_tipo, profissional_nome, data_liberada, consulta_dia, consulta_hora, central_data_preenchimento, paciente_atendido_nome, 
				paciente_confirmacao_consulta, paciente_data_entrada, observacao FROM controle_vaga where consulta_descricao = '" . $filtrar . "' ORDER BY data_liberada DESC, consulta_hora DESC";

			}
		} else {
			// consulta realizada a primeira vez que o usuário entrar nessa página e ainda não clicou no botão submit
			$consulta = "SELECT id_vaga, consulta_descricao, consulta_tipo, profissional_nome, data_liberada, consulta_dia, consulta_hora, central_data_preenchimento, paciente_atendido_nome, 
			paciente_confirmacao_consulta, paciente_data_entrada, observacao FROM controle_vaga ORDER BY data_liberada DESC, consulta_hora DESC";
		}
				
		// EXECUTA A CONSULTA E ARMAZENA NA VARIAVEL TABELA
		$tabela = mysqli_query($dbc, $consulta) or die('Erro ao realizar a consulta no banco de dados');
?>

<!--HTML puro, apenas para gerar um formulário para a página-->
<form method="post" action = "<?php echo $_SERVER['PHP_SELF']; ?>">

	<table class="my-1">
		<tr>
			<td class="text-primary"><strong> Exibir Consultas por Descrição:</strong>                            </td>
			<td>
				<select id="filtrar" name="filtrar" class="form-control form-control-sm">
					<option value=""                                                                            >                </option>
					<option value="Fisioterapeuta" <?php if( isset($filtrar) and $filtrar === "Fisioterapeuta") echo "selected"; ?> > Fisioterapeuta </option>
					<option value="Fonoaudiólogo"  <?php if( isset($filtrar) and $filtrar === "Fonoaudiólogo")  echo "selected"; ?> > Fonoaudiólogo  </option>
					<option value="Psicólogo"      <?php if( isset($filtrar) and $filtrar === "Psicólogo")      echo "selected"; ?> > Psicólogo      </option>
				</select>
			</td> <!-- Campo de Texto -->
			<td><input type="submit" name="submit"   value="Alterar" class="btn btn-primary" />             </td> <!-- Botão de pesquisar -->
		</tr>
	</table>
</form>

<?php  
		// Start generating the table of results - Comece a gerar a tabela de resultados. Aqui eu mostro a tabelas com todos os pacientes cadastrados.
		echo '<table border="0" cellpadding="1" class="table table-borderless table-hover table-sm table-striped">';
		// Generate the search result headings - Gere os títulos dos resultados da pesquisa. 
		echo '<thead class="thead-dark">';
			echo '<tr class="table-primary">';
			echo 	   '<th>Id                               </th> 
						<th>Descrição                        </th>
						<th>Profissional                     </th>
						<th>Tipo                             </th> 
						<th>Data Liberada                    </th>	
						<th>Dia da Consulta                  </th>
						<th>Hora                             </th>
						<th>Observação                       </th>
						<th>Data Preenchida                  </th>
						<th>Paciente                         </th>
						<th>Paciente Compareceu ?            </th>
						<th>Data que o paciente foi atendido </th>
						<th>                                 </th>';
						
			echo '</tr>';
		echo '</thead>';
		echo '<tbody>';
		while($row = mysqli_fetch_array($tabela)) {
			$dataPreenchimento   = $row['central_data_preenchimento']===null ? $row['central_data_preenchimento'] : date('d/m/Y', strtotime($row['central_data_preenchimento']));
			$dataEntradaPaciente = $row['paciente_data_entrada']===null ? $row['paciente_data_entrada'] : date('d/m/Y', strtotime($row['paciente_data_entrada'])); 
			echo '<tr>';
				echo '<td>'                      . $row['id_vaga']                                          .'</td>';
				echo '<td>'                      . $row['consulta_descricao']                               .'</td>';
				echo '<td>'                      . $row['profissional_nome']                                .'</td>';
				echo '<td>'                      . $row['consulta_tipo']                                    .'</td>';
				echo '<td class="text-dark">'    . date('d/m/Y', strtotime($row['data_liberada']))          .'</td>';
				echo '<td class="text-danger">'  . $row['consulta_dia']                                     .'</td>';
				echo '<td class="text-danger">'  . $row['consulta_hora']                                    .'</td>';
				echo '<td class="text-primary">' . $row['observacao']                                       .'</td>';
				echo '<td class="text-primary">' . $dataPreenchimento                                       .'</td>';
				echo '<td class="text-primary">' . $row['paciente_atendido_nome']                           .'</td>';
				echo '<td>'                      . $row['paciente_confirmacao_consulta']                    .'</td>';
				echo '<td>'                      . $dataEntradaPaciente                                     .'</td>';
				// faz um redirecionamento para a página paciente com o id do paciente.
				echo '<td><a href="vagaalterar.php?id_vaga='. $row['id_vaga'] .' " class="btn-sm border rounded"> Alterar</a></td>'; // LINK PARA A PÁGINA PACIENTE COM AS INFORMAÇÕES DO PACIENTE.
				// O ID DO PACIENTE É ENVIADO ATRAVÉS DO PROTOCOLO GET. NA PAGINA PACIENTE, ESSE VALOR PODERÁ SER OBTIDO ATRÁVES DA VARIAVEL GET. EX: $GET['ID_PAGIENTE'].
			echo '</tr>';
		}//#while
		echo '</tbody>';
	echo '</table>';
	}//#session
?>

<?php
	// Insert the page footer
	require_once('rodape.php');
?>