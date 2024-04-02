

  
  //Enviando Formulario para o Backend rota Cadastro
  async function enviar(v_form){ 
  
      const response = await fetch('http://localhost:9000/cadastro.php',{
        method:'post',
        body : v_form
      })
      
      // capturando resposta para enviar no sweetAlert
      let newResponse = await response.json()
      
      // verificando valores de variaveis para formação do sweetalert 
      let icon = newResponse.status == 'fail' ? 'error' : 'success'
      let reload = newResponse.status=='fail' ? false : true
  
      fnMensagem(icon,newResponse.msg,reload)
      
     
  };


// Sweet Alert (mostra msg de sucess ou fail )
  function fnMensagem(icon,msg,reload=false){
    Swal.fire({
      title: msg,
      icon: icon,
      confirmButtonText: 'Ok',
      timer: 3500,
      timerProgressBar: true,
      willClose: () => {
        
        if(reload){
          window.location.reload();
      }
    }
    });
}