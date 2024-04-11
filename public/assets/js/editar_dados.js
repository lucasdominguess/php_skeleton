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
    
    $("#myModal").fadeToggle(1000)
    $('#title_h3').text('Editar Cadastro')

// valores nos Inputs
    let values = Object.values(key) 
   
      $("#id").val(values[0])
      $("#nome").val(values[1])
      $("#data").val(values[2])

};


