//enviando dados de login 
async function requestPOST(rota,v_form=null){
    const rots = rota 
    const response = await fetch(`${rots}`
,{

    method : 'post' , 
    body : v_form

});


let newResponse = await response.json()


let icon = newResponse.data.status == 'fail' ? 'error' : 'success' 
let reload = newResponse.data.status=='fail' ? false : true
let rotas = newResponse.data.location 
let msg = newResponse.data.msg



if(icon=='error'){
    fnMensagem(icon,msg)
}else {
    fnMensagem(icon,msg,reload,rotas)
    // window.location.href='registrar' 
}
}
// buscar para Editar item com mesmo id do botao 
async function requestGET(key) { 
   
  let id = key.target.id
  console.log(id);
  
  let response = await fetch(`http://localhost:9000/buscar.php?id=${id}`);
  let obj = await response.json()
  // console.log(obj)
  
  
//   createModal(obj);
}
