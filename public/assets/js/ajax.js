//enviando dados com medoto POST
async function requestPOST(rota,v_form=null){
    const rots = rota 
    const modoDark = localStorage.getItem('darkMode');
    // v_form.append(modoDark)
    const response = await fetch(`${rots}`
,{

    method : 'post' , 
    body : v_form,
  

});

let newResponse = await response.json()
// console.log(newResponse)
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
// buscar dados com metodo GET 
async function requestGET(key) { 
   
  let id = key.target.id
//   console.log(id);
  let response = await fetch(`/admin/editar?id=${id}`);
  let obj = await response.json()

  // console.log(obj.data[0][0])
  gerarModal(obj.data.code,obj.data) 
  // createModal(obj.data[0]);
  // modalEditarAdm(obj.data);
}

// buscar dados com metodo GET
async function requestGETrota(rota) { 
   

//   console.log(id);
  let response = await fetch(`${rota}`);
  let obj = await response.json()
  // console.log(obj) 
  let newResponse = await response.json()
  // console.log(newResponse)
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


async function requestDELETE(key,rota) {
    try {
      let id = key.target.id;
      
      const response = await fetch(
        `${rota}?id=${id}`,
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
// Bucando dados do backend para listar tabela
async function buscar(rota)
    {
    try {
        let response = await fetch(`${rota}`);
        let obj = await response.json()
      //  console.log(obj.data[4])
        return obj.data

    }catch(error) {  //Identificando possivel erro 
      console.log('erro na busca',error)
    }finally {
      
    };
    };