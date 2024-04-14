
 //Funcao Dark_Light 

const iconhome = document.getElementById('icon_home');
const iconlogin = document.getElementById('icon_login');
const isDarkMode = localStorage.getItem('darkMode')

// document.addEventListener("DOMContentLoaded", function() {
//       const isDarkMode = localStorage.getItem('darkMode')

// verifica se o darkmode esta ativo e salvo em localStorage
if (isDarkMode =='true') {
  document.getElementById('html_home').setAttribute('data-bs-theme','dark');
  document.getElementById('html_login').setAttribute('data-bs-theme', 'dark');
  iconhome.classList.remove('fa-moon');
  iconlogin.classList.remove('fa-moon');
  iconhome.classList.add('fa-sun');
  iconlogin.classList.add('fa-sun');
}else{
  document.getElementById('html_home').setAttribute('data-bs-theme', 'ligth');
  document.getElementById('html_login').setAttribute('data-bs-theme', 'ligth');
  iconhome.classList.remove('fa-sun');
  iconlogin.classList.remove('fa-sun');
  iconhome.classList.add('fa-moon');
  iconlogin.classList.add('fa-moon');
};

function modoDark (icon,html) { 

      const icone =document.getElementById(`${icon}`)
      const htmlTag = document.getElementById(`${html}`);
      if (icone.classList.contains('fa-moon')) { 

          icone.classList.remove('fa-moon');
          icone.classList.add('fa-sun');
          
          localStorage.setItem('darkMode', 'true');
          htmlTag.setAttribute('data-bs-theme', 'dark');
        
          return;
      }
          
          icone.classList.remove('fa-sun');
          icone.classList.add('fa-moon');
          localStorage.setItem('darkMode', 'false');
          htmlTag.setAttribute('data-bs-theme', 'ligth'); 
  
}
// iconlogin.addEventListener('click', ()=> {
//     const html = document.getElementById('html');
//     if (iconlogin.classList.contains('fa-moon')) { 
//         iconlogin.classList.remove('fa-moon');
//         iconlogin.classList.add('fa-sun');
//         localStorage.setItem('darkMode', 'true');
//         document.querySelector('html').setAttribute(
//           'data-bs-theme', 'dark'
        
//         );
      
//         return;
//     }
        
//         iconlogin.classList.remove('fa-sun');
//         iconlogin.classList.add('fa-moon');
//         localStorage.setItem('darkMode', 'false');
//         document.querySelector('html_login').setAttribute(
//           'data-bs-theme', 'ligth'
        
       
//         ); 
// }); 

//Função escrevendo letras

document.addEventListener("DOMContentLoaded", function() {
  function ativaLetra(elemento) {
    const arrTexto = elemento.innerHTML.split('');
    elemento.innerHTML = '';
    arrTexto.forEach((letra, i) => {
      setTimeout(() => {
        elemento.innerHTML += letra;
      }, 75 * i);
    });
  }


  
  function escrevendoLetra() {
    const titulo = document.querySelector('.escletra');
    ativaLetra(titulo);
  }
escrevendoLetra();
});


// document.addEventListener("DOMContentLoaded", function() {
//   function ativaLetra2(elemento) {
//     const arrTexto = elemento.innerHTML.split('');
//     elemento.innerHTML = '';
//     arrTexto.forEach((letra, i) => {
//       setTimeout(() => {
//         elemento.innerHTML += letra;
//       }, 75 * i);
//     });
//   }


  
//   function escrevendoLetra2() {
//     const titulo = $('.titletable');
//     ativaLetra2(titulo);
//   }
// escrevendoLetra2();
// });