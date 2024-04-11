//enviando dados com medoto POST
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
    fnMensagem(icon,msg,false,rotas)
    // window.location.href='registrar' 
}
}
// buscar dados com metodo GET
async function requestGET(key) { 
   
  let id = key.target.id
//   console.log(id);
  let response = await fetch(`/editar?id=${id}`);
  let obj = await response.json()
  // console.log(obj) 
  createModal(obj.data);
}

async function requestDELETE(key) {
    try {
      let id = key.target.id;
      
      const response = await fetch(
        `/excluir?id=${id}`,
        {
          method: "post",
          body: id,
          
        }
      );
      
    // capturando resposta para enviar no sweetAlert
    let newResponse = await response.json();

    // verificando valores de variaveis para formação do sweetalert
    let icon = newResponse.data.status == "fail" ? "error" : "success";
    let reload = newResponse.data.status == "fail" ? false : true;

    fnMensagem(icon, newResponse.data.msg, reload);
  } catch {}
}