

//construindo header de tabela dinamicamente 
function tH(keys) {
        keys.push('Editar')
        keys.push('Excluir')
        let h1 =document.createElement('h1');
        // h1.innerText='Tabela de Cadastrados'
        h1.id = 'h1_table'
    
        let table1 = document.createElement('table');
        
        let thead = document.createElement('thead');
        let tr = document.createElement('tr');
        thead.append(tr);
        table1.append(thead);
        let tbody = document.createElement('tbody');
        table1.append(tbody);
        let tag = document.querySelector('.htmlpags').id
        // table1.id =`table_${tag}`;
        table1.id ="table1";
        $(`#sessao_tabela`).append(table1,h1);
      
  
        
       
        for (let index = 0; index < keys.length; index++) {
            const element = keys[index];
            const tH = document.createElement('th');
            tH.innerText = element;
            
            tr.append(tH);
        }
            //adcionando tabela ao local exato do html
            // $(`#sessao_tabela_${tag}`).append(table1);
            $("#sessao_tabela").append(table1);
    
            $(table1).append(thead) ;
            $(table1).append(tbody) ;

            $(h1).addClass('h1s titletable'); 
            $('th').addClass('labelPerso'); 
            $(table1).addClass('table table-striped table-hover table-responsive')
            // $(table1).css('wigth','100%')
           
            $(tbody).addClass('tbody');
           
         
    };
// Construindo body de tabela dinamicamente
function arrumar(obj){      

  
  
        const values = Object.values(obj)
        // console.log(values)

        const tr = document.createElement('tr'); 
        for (let i = 0; i < values.length; i++) {  
            const el = values[i];
            const td = document.createElement('td'); 
            td.innerText = el
            tr.append(td);
            // tr.append(button)
            
        }
        const button = document.createElement('button')
        const button2 = document.createElement('button')
        
        
        $(button).addClass('btn btn-all btn-primary btn-sm ')
        $(button2).addClass('btn btn-all btn-danger btn-sm')
        
        $(button).text('Editar')
        $(button2).text('Excluir')
        button.id = values[0]
        button2.id = values[0]
        tr.id = 'tr'+values[0]  //atribuindo Id + valor passado no loop
      
  
    const td2=document.createElement('td')
    const td3=document.createElement('td')
    td2.append(button)
    td3.append(button2)
    tr.append(td2,td3)

  
    
    $('.tbody').append(tr);
    
    //evento botao de editar 
  
    button.addEventListener('click',requestGET);
    button2.addEventListener('click',confirmExcluir);
};
  
//exibir o tempo restante da sessao do usuario
function atualizarTempo() {
    const tempo =  document.getElementById('temposessao').textContent;   


   

    var dataAtual = new Date(); // Cria uma instância de Date()
    var timestamp = dataAtual.getTime(); // Obtém o timestamp em milissegundos

    // console.log(timestamp); // Imprime o timestamp

    let temtoken = new Date(tempo); 
    let timestampTempo = temtoken.getTime();

    let difereca = timestampTempo - timestamp;


    let n = new Date(difereca); // criando instancia da diff entre as datas

    var horasAtuais = n.getHours();  
    var minutosAtuais = n.getMinutes();
    let segundos = n.getSeconds();

    //adcionando 0 caso o valor conhenha apenas um digito 
    let formattedHoras = horasAtuais.toString().padStart(2, "0");
    let formattedMinutos = minutosAtuais.toString().padStart(2, "0");
    let formattedSegundos = segundos.toString().padStart(2, "0");



    let tempoRestante = `${formattedMinutos}:${formattedSegundos}` 

    // console.log(tempoRestante)
  let tempoRest =  document.getElementById('temposessao2').textContent = tempoRestante

//    let  tempoRest = document.getElementById('temposessao2').textContent
    if(tempoRest == "00:20"){
        tempoRest.style.color= red
    }
    if(tempoRest == "00:00"){
        fnMensagem('error',"Sessão Expirada",true,'/')
    }
}
setInterval(atualizarTempo, 1000);
