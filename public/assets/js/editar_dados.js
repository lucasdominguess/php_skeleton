function Cadastrar(key) { 
   
    $("#myModal").show(1000)
    $("#title_h3").text('Cadastrar')
    limparCampos() 
  }
  function limparCampos(){ 
    $('#id').val('')
    $('#nome').val('')
    $('#data').val('')
   
}
  //Criando Modal & dados para alterar/cadastrar na table
function createModal(key) {
    let keys = Object.keys(key)
    // console.log(keys)
    $("#myModal").fadeToggle(1000)
    $('#title_h3').text('Editar Cadastro')

// valores nos Inputs
    let values = Object.values(key) 
   
      $("#id").val(values[0])
      $("#nome").val(values[1])
      $("#data").val(values[2])

};


// buscar para Editar item com mesmo id do botao 
async function btn_editar(key) { 
   
    let id = key.target.id
    let response = await fetch(`http://localhost:9000/buscar.php?id=${id}`);
    let obj = await response.json()
    // console.log(obj)
    
    
    createModal(obj);
}

// // Eventos de botoes
$("#btn_cadastrar").click(function(){
  Cadastrar();
 

}); 
// botoes modal 
$('#btn_enviarCad').on('click', async ()=> {
    let v_form = new FormData(document.getElementById('form_cad')) 

    enviar(v_form)
  

  })
$("#fechar").click(function(){
    $("#myModal").hide();
    // sair();
}) 
$("#btn_close").click(function(){
    $("#myModal").hide();
  //  sair();
})

function sair() {
  Swal.fire({ 
  title: 'Deseja realmente sair? Dados serão Perdidos! ',
  showDenyButton: true,            
  confirmButtonText: "Sim",
  denyButtonText: `Não`,
  icon : 'question',
  

  }).then((result) => {
 
  if (result.isConfirmed) {  
 
      $("#myModal").fadeToggle('slow');
   
    // Swal.fire(`O ID do paciente é ${button.id}`, "", "info");
  } else if (result.isDenied) {
    // Swal.fire("OK!");
    
  }
})}