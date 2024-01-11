function alterar() {
    
    let   consulta_descricao  = document.getElementById("consulta_descricao")
    const profissional_nome   = document.getElementById("profissional_nome")
    const consulta_tipo       = document.getElementById("consulta_tipo")

    const vazio = document.createElement("option")
    vazio.value = ""
    vazio.text  = ""

    // REMOVE TODOS OS ELEMENTOS DO SELECT ANTES DE PREENCHER NOVAMENTE.
    if(profissional_nome.length > 0) {
        while(profissional_nome.options.length > 0) {
            profissional_nome.options[0].remove();
        }
    }

    if(consulta_descricao.value === "Fisioterapeuta") {
        
        // CRIAÇÃO DOS ELEMENTOS
        const isabella = document.createElement("option")
        isabella.value = "Isabella"
        isabella.text  = "Isabella"

        const jusce = document.createElement("option")
        jusce.value = "Jusce"
        jusce.text  = "Jusce"
        
        const karine = document.createElement("option")
        karine.value = "Karine"
        karine.text  = "Karine"

        const leticia = document.createElement("option")
        leticia.value = "Letícia"
        leticia.text  = "Letícia"

        const milena = document.createElement("option")
        milena.value = "Milena"
        milena.text  = "Milena"
        
        const neto = document.createElement("option")
        neto.value = "Neto"
        neto.text  = "Neto"
        
        // ADICIONA OS ELEMENTOS COMO FILHO DO ELEMENTO SELECT
        profissional_nome.appendChild(vazio)
        profissional_nome.appendChild(isabella)
        profissional_nome.appendChild(jusce)
        profissional_nome.appendChild(karine)
        profissional_nome.appendChild(leticia)
        profissional_nome.appendChild(milena)
        profissional_nome.appendChild(neto)

        alterarTipo("Fisioterapeuta")
    } else if(consulta_descricao.value === "Fonoaudiólogo") {
        // CRIA OS ELEMENTOS
        const aline = document.createElement("option")
        aline.value = "Aline"
        aline.text  = "Aline"

        const marina = document.createElement("option")
        marina.value = "Marina"
        marina.text  = "Marina"

        const thamille = document.createElement("option")
        thamille.value = "Thamille"
        thamille.text  = "Thamille"
        
        // ADICIONA OS ELEMENTOS COMO FILHO DO ELEMENTO SELECT
        profissional_nome.appendChild(vazio)
        profissional_nome.appendChild(aline)
        profissional_nome.appendChild(marina)
        profissional_nome.appendChild(thamille)

        alterarTipo("Fonoaudiólogo")

    } else if(consulta_descricao.value === "Psicólogo" ) {

        // CRIA OS ELEMENTOS
        const aida = document.createElement("option")
        aida.value = "Aida"
        aida.text  = "Aida"

        const irlanda = document.createElement("option")
        irlanda.value = "Irlanda"
        irlanda.text  = "Irlanda"

        const maryana = document.createElement("option")
        maryana.value = "Maryana"
        maryana.text  = "Maryana"
  
        // ADICIONA OS ELEMENTOS COMO FILHO DO ELEMENTO SELECT
        profissional_nome.appendChild(vazio)
        profissional_nome.appendChild(aida)
        profissional_nome.appendChild(irlanda)
        profissional_nome.appendChild(maryana)

        alterarTipo("Psicólogo")
    }
}
// --------------------------------- ALTERAR O TIPO DE CONSULTA -----------------------------
function alterarTipo(tipoProfissao) {

    // REMOVE TODOS OS ELEMENTOS DO SELECT ANTES DE PREENCHER NOVAMENTE.
    if(consulta_tipo.length > 0) {
        while(consulta_tipo.options.length > 0) {
            consulta_tipo.options[0].remove();
        }
    }

    const vazio = document.createElement("option")
    vazio.value = ""
    vazio.text  = ""

    if(tipoProfissao === "Fisioterapeuta") {
        
        // CRIA OS ELEMENTOS
        const neurologico = document.createElement("option")
        neurologico.value = "Neurológico"
        neurologico.text  = "Neurológico"

        const normal = document.createElement("option")
        normal.value = "Normal"
        normal.text  = "Normal"

        const psiquiatrica = document.createElement("option")
        psiquiatrica.value = "Psiquiatrica"
        psiquiatrica.text  = "Psiquiatrica"

        // ADICIONA OS ELEMENTOS COMO FILHO DO ELEMENTO SELECT
        consulta_tipo.appendChild(vazio)
        consulta_tipo.appendChild(neurologico)
        consulta_tipo.appendChild(normal)
        consulta_tipo.appendChild(psiquiatrica)
    
    } else if(tipoProfissao === "Fonoaudiólogo") {
        
        // CRIA OS ELEMENTOS
        const adulto  = document.createElement("option")
        adulto.value  = "Adulto"
        adulto.text   = "Adulto"
        
        const crianca = document.createElement("option")
        crianca.value = "Criança"
        crianca.text  = "Criança"
        
        // ADICIONA OS ELEMENTOS COMO FILHO DO ELEMENTO SELECT
        consulta_tipo.appendChild(vazio)
        consulta_tipo.appendChild(adulto)
        consulta_tipo.appendChild(crianca)
    
    } else if(tipoProfissao === "Psicólogo") {

        // CRIA OS ELEMENTOS
        const adolescente = document.createElement("option")
        adolescente.value = "Adolescente"
        adolescente.text  = "Adolescente"

        const adult  = document.createElement("option")
        adult.value  = "Adulto"
        adult.text   = "Adulto"

        const crianc = document.createElement("option")
        crianc.value = "Criança"
        crianc.text  = "Criança"

         // ADICIONA OS ELEMENTOS COMO FILHO DO ELEMENTO SELECT
         consulta_tipo.appendChild(vazio)
         consulta_tipo.appendChild(adolescente)
         consulta_tipo.appendChild(adult)
         consulta_tipo.appendChild(crianc)
    }
}