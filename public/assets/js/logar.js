//enviando dados de login 
async function logar(v_form){

const response = await fetch('/logar'
,{

    method : 'post' , 
    body : v_form

});

let newResponse = await response.json()
     
let icon = newResponse.status == 'fail' ? 'error' : 'success' 
let reload = newResponse.status=='fail' ? false : true

function fnMensagem(icon,msg,reload=false,location=''){
    Swal.fire({
      title: msg,
      icon: icon,
      confirmButtonText: 'Ok',
      timer: 5500,
      timerProgressBar: true,
      willClose: () => {
        
        if(reload){
          window.location.reload();
      }
      if (location != ''){
        window.location.href=location
      }
    }
    });
}

if(icon=='error'){
    fnMensagem(icon,newResponse.msg)
}else {
    fnMensagem(icon,newResponse.msg,false,'registrar')
    // window.location.href='registrar' 
}
}

$('#btn_entrar').on('click', async ()=> {
    let v_form = new FormData(document.getElementById('form_login')) 

    logar(v_form)
  })

