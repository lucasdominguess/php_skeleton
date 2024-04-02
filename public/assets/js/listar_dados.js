
// Bucando dados do backend para listar tabela
async function buscar()
    {
    try {
        let response = await fetch(`http://localhost:9000/listar.php/`);
        let obj = await response.json()
    
        return obj
    }catch(error) {  //Identificando possivel erro 
      console.log('erro na busca',error)
    }finally {
      
    };
    };
//construindo header de tabela dinamicamente 
function tH(keys) {
        keys.push('Editar')
        keys.push('Excluir')
        let h1 =document.createElement('h1');
        h1.innerText='Tabela de Cadastrados'
       
    
        let table1 = document.createElement('table');
        
        let thead = document.createElement('thead');
        let tr = document.createElement('tr');
        thead.append(tr);
        table1.append(thead);
        let tbody = document.createElement('tbody');
        table1.append(tbody);
        table1.id ='table1';
        $('#sessao_tabela').append(table1,h1);
      
  
        
       
        for (let index = 0; index < keys.length; index++) {
            const element = keys[index];
            const tH = document.createElement('th');
            tH.innerText = element;
            
            tr.append(tH);
        }
            //adcionando tabela ao local exato do html
            $("#sessao_tabela").append(table1);
    
            $(table1).append(thead) ;
            $(table1).append(tbody) ;

            $(h1).addClass('h1s'); 
            $('th').addClass('labelPerso'); 
            $(table1).addClass('table table-striped table-hover table-responsive-sm  container')
            // $(table1).css('wigth','100%')
           
            $(tbody).addClass('tbody');
           
         
    };
// Construindo body de tabela dinamicamente
function arrumar(obj){      

     

        const values = Object.values(obj)
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
    button.addEventListener('click',btn_editar);
    button2.addEventListener('click',confirmExcluir);
};




$(document).ready(async ()=>{
        let obj = await buscar();
        tH(Object.keys(obj[0]));
       
       
        // loop para construir chave da tabela
        for (let index = 0; index < obj.length; index++) {
          const element = obj[index];
          arrumar(element)      
         
        }
        // Construindo datatables
        $('#table1').DataTable({
          language: {
            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json'
        },
          dom: 'Blfrtip',
          pageLength : 5,
          lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'Todos']],
          buttons: [
          'copy', 'csv', 'excel'
        ],
        responsive: true,
        columnDefs: [
          { target: [0,3], visible: false, searchable: false},
          { title: 'Nome', targets: 1 },
          { title: 'Data de Nascimento', targets: 2 },
          { className: "dt-head-center", targets: [1,2,4,5] },
          
      ],
      initComplete: function () {
        $('.dt-buttons').removeClass('btn-group');
        $('.dt-buttons').addClass('d-flex');
      }
      })

      });


      