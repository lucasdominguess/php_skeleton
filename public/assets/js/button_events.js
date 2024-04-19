//botoes + eventos

// login 
$('#btn_entrar').on('click', async ()=> {
    let v_form = new FormData(document.getElementById('form_login')) 

    requestPOST('/logar',v_form)
  })


//home 
$('#btn_sair').on('click', async ()=> {
    
   requestPOST('/sair')
  })

  $("#btn_cadastrar").click(function(){
    Cadastrar();
   
  
  }); 

// botoes modal 
$('#btn_enviarCad').on('click', async ()=> {
    let v_form = new FormData(document.getElementById('form_cad')) 

    requestPOST('/cadastrar',v_form)
  

  })
$("#fechar").click(function(){
    $("#myModal").hide();
    // sair();
}) 
$("#btn_close").click(function(){
    $("#myModal").hide();
  //  sair();
})
// icones do modo dark

// iconhome.addEventListener('click' ,modoDark) ;
$("#icon_login").click( function (){ 
  modoDark('icon_login','html_login')
});
// $("#icon_home").click( function (){ 
//   modoDark('icon_home','html_homeuser')
// });
$("#icon_home").click( function (){ 
  modoDark('icon_home','html_userhome')
});
$("#icon_home").click( function (){ 
  modoDark('icon_home','html_admhome')
});

//  //Funcao Dark_Light 
// function modoDark()
// {
//   const html = document.getElementById('html');
//   if (iconhome.classList.contains('fa-moon')) { 
//       iconhome.classList.remove('fa-moon');
//       iconlogin.classList.remove('fa-moon');
//       iconhome.classList.add('fa-sun');
//       iconlogin.classList.add('fa-sun');
//       localStorage.setItem('darkMode', 'true');
//       document.querySelector('html').setAttribute(
//         'data-bs-theme', 'dark'
      
//       );
    
//       return;
//   }
//       iconhome.classList.remove('fa-sun');
//       iconlogin.classList.remove('fa-sun');
//       iconhome.classList.add('fa-moon');
//       iconlogin.classList.add('fa-moon');

//       localStorage.setItem('darkMode', 'false');
//       document.querySelectorAll('html').setAttribute(
//         'data-bs-theme', 'ligth'
//       ); 
// }; 
// // verifica se o darkmode esta ativo e salvo em localStorage
// if (isDarkMode == 'true') {
//   document.querySelector('html').setAttribute('data-bs-theme', 'dark');
//   iconhome.classList.remove('fa-moon');
//   iconlogin.classList.remove('fa-moon');
//   iconhome.classList.add('fa-sun');
//   iconlogin.classList.add('fa-sun');
// }else{
//   document.querySelector('html').setAttribute('data-bs-theme', 'ligth');
//   iconhome.classList.remove('fa-sun');
//   iconlogin.classList.remove('fa-sun');
//   iconhome.classList.add('fa-moon');
//   iconlogin.classList.add('fa-moon');
// };

