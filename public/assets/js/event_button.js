//botoes + eventos

$('#btn_entrar').on('click', async ()=> {
    let v_form = new FormData(document.getElementById('form_login')) 

    requestPOST('/ajax',v_form)
  })
$('#btn_sair').on('click', async ()=> {
    
   requestPOST('/sair')
  })

  $("#btn_cadastrar").click(function(){
    Cadastrar();
   
  
  }); 

// botoes modal 
$('#btn_enviarCad').on('click', async ()=> {
    let v_form = new FormData(document.getElementById('form_cad')) 

    requestPOST(v_form)
  

  })
$("#fechar").click(function(){
    $("#myModal").hide();
    // sair();
}) 
$("#btn_close").click(function(){
    $("#myModal").hide();
  //  sair();
})
