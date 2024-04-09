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
}function sair() {
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