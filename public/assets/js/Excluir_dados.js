//Excluir dados da tabela
async function ExcluirDados(key) {
  try {
    let id = key.target.id;
    console.log(id);
    const response = await fetch(
      `http://localhost:9000/excluir_dados.php?id=${id}`,
      {
        method: "post",
        body: id,
        
      }
    );

    // capturando resposta para enviar no sweetAlert
    let newResponse = await response.json();

    // verificando valores de variaveis para formação do sweetalert
    let icon = newResponse.status == "fail" ? "error" : "success";
    let reload = newResponse.status == "fail" ? false : true;

    fnMensagem(icon, newResponse.msg, reload);
  } catch {}
}

// function excluirLinha(key) {
//     id = key.target.id
//     // $('#tr'+id).fadeToggle(1500)
//     ExcluirDados(key)
//     // let Ocultos = [] ;
// };

function confirmExcluir(key) {
  Swal.fire({
    title: "Deseja realmente Excluir? \n Todos os dados serao Apagados! ",
    showDenyButton: true,
    confirmButtonText: "Sim",
    denyButtonText: `Não`,
    icon: "question",
  }).then((result) => {
    if (result.isConfirmed) {
      ExcluirDados(key);

      // Swal.fire(`O ID do paciente é ${button.id}`, "", "info");
    } else if (result.isDenied) {
      // Swal.fire("OK!");
    }
  });
}
