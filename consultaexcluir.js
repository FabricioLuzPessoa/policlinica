// CRIA A REQUISICAO REQUEST
var request = null;
try {
	request = new XMLHttpRequest();
} catch (trymicrosoft) {
	try {
		request = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (othermicrosoft) {
		try {
			request = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (failed) {
			request = null;
		}
	}
}

function excluirConsulta(idPac){
	
    let valor = confirm("Tem certeza que deseja excluir o a consulta?");
	
    if(valor) {
		
        let idPaciente = idPac;
		let url        = "consultaexcluir.php";                   // url do script backend
		url            = url + "?dummy=" + new Date().getTime();  // String para evitar que o navegador respota a solicicatão com resposta em cache 
		request.open("POST", url, true);                          // Define o protocolo para enviar os dados, a url php e que a informação será enviada de forma assincrona
		request.onreadystatechange = mensagem;                    // Método chamado quando o objeto request tiver a resposta do servidor.
		request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		request.send("variavel=" + idPaciente );
	} else {
		alert("Ação cancelada!");
	}
}

function mensagem() {
	if (request.readyState == 4) {  // Estado de prontidão: 1 iniciado, 2 trabalhando, 3 trabalhando, 4 tudo ok
		if(request.status == 200) {
			let msg = request.responseText;
			alert(msg);
			location.replace('./vagatabela.php')
			
		} else {
			alert("Erro no Sistema!")
		}
		
	}
}