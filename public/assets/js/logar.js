//enviando dados de login 
async function logar(v_form){

const response = await fetch('logar.php',{
    method : 'post' , 
    body : v_form
}) 

let newResponse = await response.json()
     
let icon = newResponse.status == 'fail' ? 'error' : 'success' 
let reload = newResponse.status=='fail' ? false : true

if(icon=='error'){
    fnMensagem(icon,newResponse.msg)
}else {
    fnMensagem(icon,newResponse.msg,false,'registrar.php')
}


// fnMensagem(icon,newResponse.msg,reload)
// console.log(newResponse)
// setTimeout(8000)

// if (newResponse.status=='ok'){
//     window.location.href = "registrar.php"
//     fnMensagem(icon,newResponse.msg,reload)
    
// }
}

$('#btn_entrar').on('click', async ()=> {
    let v_form = new FormData(document.getElementById('form_login')) 

    logar(v_form)
  })

