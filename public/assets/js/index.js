
// document.querySelector('html').setAttribute(
//   'data-bs-theme',
//   window.matchMedia && window.matchMedia('(prefers-color-scheme: light)').matches ? 'light' : 'dark'
// );

  
  //Enviando Formulario para o Backend
  async function enviar(v_form){ 
  
      const response = await fetch('http://localhost:8080/cadastro.php',{
        method:'post',
        body : v_form
      })
      
      let newResponse = await response.json()
     
      let icon = newResponse.status == 'fail' ? 'error' : 'success'
      let reload = newResponse.status=='fail' ? false : true
      
      // let admMsg = newResponse.usuario
      // console.log(admMsg); 
      fnMensagem(icon,newResponse.msg,reload)
      // admMensagem(icon,admMsg)
      // console.log(newResponse)
     
  };
  
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
function admMensagem(msg,icon){ 
  Swal.fire({
    title: msg,
    icon: icon,
    confirmButtonText: 'Ok',
    timer: 3500,
    timerProgressBar: true,
})
}