document.getElementById('form_config').addEventListener('submit', function(event) {
    event.preventDefault();


    const formData = new FormData(this);


    fetch('/admin/arquivo', {
        method: 'POST', 
        body: formData
    })
    .then(response => response.json())
    .then(newResponse=> {
     
     
        let icon = newResponse.data.status == 'fail' ? 'error' : 'success' 
        let reload = newResponse.data.status=='fail' ? false : true
      
        let rotas = newResponse.data.location 
        let msg = newResponse.data.msg

        if(icon=='error'){
            fnMensagem(icon,msg)
            
        }else {
            fnMensagem(icon,msg,reload,rotas)
      
        }
        }
      
    )
    .catch(error => {
       
        console.error('Erro:', error);
    });
});

document.addEventListener("DOMContentLoaded",async ()=>{

    const response = await buscar('/admin/listar_arquivos')

   
    // console.log(response)
   tH(response)
});
