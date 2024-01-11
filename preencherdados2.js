const consultaDescricao = document.getElementById("consulta_descricao")
const profissional_nome = document.getElementById("profissional_nome")
const consulta_tipo     = document.getElementById("consulta_tipo")

if(consultaDescricao.value === "Fisioterapeuta" || consultaDescricao.value === "Fonoaudiólogo" || consultaDescricao.value === "Psicólogo" ) {
    const valorSelecionado = consultaDescricao.value
    // REMOVE TODOS OS ELEMENTOS DO SELECT ANTES DE PREENCHER NOVAMENTE.
    if(consultaDescricao.length > 0) {
        while(consultaDescricao.options.length > 0) {
            consultaDescricao.options[0].remove();
        }
    }
    // CRIAÇÃO DOS ELEMENTOS
    const fisioterapeuta = document.createElement("option")
    fisioterapeuta.value = "Fisioterapeuta"
    fisioterapeuta.text  = "Fisioterapeuta"

    const fonoaudiologo = document.createElement("option")
    fonoaudiologo.value = "Fonoaudiólogo"
    fonoaudiologo.text  = "Fonoaudiólogo"
    
    const psicologo = document.createElement("option")
    psicologo.value = "Psicólogo"
    psicologo.text  = "Psicólogo"

    consultaDescricao.appendChild(fisioterapeuta)
    consultaDescricao.appendChild(fonoaudiologo)
    consultaDescricao.appendChild(psicologo)

    consultaDescricao.value = valorSelecionado   
    
    alterarTipo(consultaDescricao.value)
}    
    
if(profissional_nome.value === "Isabella" || profissional_nome.value === "Jusce" || profissional_nome.value === "Karine" 
|| profissional_nome.value === "Letícia" || profissional_nome.value === "Milena" || profissional_nome.value === "Neto") {

    const valorSelecionado = profissional_nome.value
    
    // REMOVE TODOS OS ELEMENTOS DO SELECT ANTES DE PREENCHER NOVAMENTE.
    if(profissional_nome.length > 0) {
        while(profissional_nome.options.length > 0) {
            profissional_nome.options[0].remove();
        }
    }
    
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
    profissional_nome.appendChild(isabella)
    profissional_nome.appendChild(jusce)
    profissional_nome.appendChild(karine)
    profissional_nome.appendChild(leticia)
    profissional_nome.appendChild(milena)
    profissional_nome.appendChild(neto)
    
    profissional_nome.value = valorSelecionado

} else if (profissional_nome.value === "Aida" || profissional_nome.value === "Maryana" || profissional_nome.value === "Irlanda") {

    const valorSelecionado = profissional_nome.value

    // REMOVE TODOS OS ELEMENTOS DO SELECT ANTES DE PREENCHER NOVAMENTE.
    if(profissional_nome.length > 0) {
        while(profissional_nome.options.length > 0) {
            profissional_nome.options[0].remove();
        }
    }

    // CRIAÇÃO DOS ELEMENTOS
    const aida = document.createElement("option")
    aida.value = "Aida"
    aida.text  = "Aida"
    
    const maryana = document.createElement("option")
    maryana.value = "Maryana"
    maryana.text  = "Maryana"
    
    const irlanda = document.createElement("option")
    irlanda.value = "Irlanda"
    irlanda.text  = "Irlanda"

    profissional_nome.appendChild(aida)
    profissional_nome.appendChild(maryana)
    profissional_nome.appendChild(irlanda)

    profissional_nome.value = valorSelecionado

} else if( profissional_nome.value === "Aline" || profissional_nome.value === "Marina" || profissional_nome.value === "Thamille") {

    const valorSelecionado = profissional_nome.value
    
    // REMOVE TODOS OS ELEMENTOS DO SELECT ANTES DE PREENCHER NOVAMENTE.
    if(profissional_nome.length > 0) {
        while(profissional_nome.options.length > 0) {
            profissional_nome.options[0].remove();
        }
    }

    // CRIAÇÃO DOS ELEMENTOS
    const aline = document.createElement("option")
    aline.value = "Aline"
    aline.text  = "Aline"

    const marina = document.createElement("option")
    marina.value = "Marina"
    marina.text  = "Marina"

    const thamille = document.createElement("option")
    thamille.value = "Thamille"
    thamille.text  = "Thamille"

    profissional_nome.appendChild(aline)
    profissional_nome.appendChild(marina)
    profissional_nome.appendChild(thamille)

    profissional_nome.value = valorSelecionado
}

// --------------------------------- ALTERAR O TIPO DE CONSULTA -----------------------------
function alterarTipo(tipoProfissao) {

    const valor = consulta_tipo.value

    // REMOVE TODOS OS ELEMENTOS DO SELECT ANTES DE PREENCHER NOVAMENTE.
    if(consulta_tipo.length > 0) {
        while(consulta_tipo.options.length > 0) {
            consulta_tipo.options[0].remove();
        }
    }

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
        consulta_tipo.appendChild(neurologico)
        consulta_tipo.appendChild(normal)
        consulta_tipo.appendChild(psiquiatrica)

        consulta_tipo.value = valor
    
    } else if(tipoProfissao === "Fonoaudiólogo") {
        
        // CRIA OS ELEMENTOS
        const adulto  = document.createElement("option")
        adulto.value  = "Adulto"
        adulto.text   = "Adulto"
        
        const crianca = document.createElement("option")
        crianca.value = "Criança"
        crianca.text  = "Criança"
        
        // ADICIONA OS ELEMENTOS COMO FILHO DO ELEMENTO SELECT
        consulta_tipo.appendChild(adulto)
        consulta_tipo.appendChild(crianca)

        consulta_tipo.value = valor
    
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
         consulta_tipo.appendChild(adolescente)
         consulta_tipo.appendChild(adult)
         consulta_tipo.appendChild(crianc)

         consulta_tipo.value = valor
    }
}


