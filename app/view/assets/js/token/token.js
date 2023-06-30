export const requestTokenLogin = async () => {
  const cpf = document.querySelector('#cpf_login').value;
  const senha = document.querySelector('#senha_login').value;

  const response = await fetch('http://localhost/Sistema-Senha/json/token/login', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({ cpf: cpf, senha: senha }),
  });
  const json = await response.json();
  //console.log(response.status);

  if (response.status === 200) {
    localStorage.setItem('token', json);
    window.location.replace('http://localhost/Sistema-senha/');
    console.log(response);
  }
};

export const requestTokenRegister = async () => {
  const nome = document.querySelector('#nome_cad').value;
  const cpf = document.querySelector('#cpf_cad').value;
  const data_nascimento = document.querySelector('#data_cad').value;
  const senha = document.querySelector('#senha_cad').value;

  console.log(nome, cpf);

  const response = await fetch('http://localhost/Sistema-Senha/json/token/cadastro', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({
      nome: nome,
      cpf: cpf,
      data_nascimento: data_nascimento,
      senha: senha,
    }),
  });
  const json = await response.json();
  console.log(json);
  if (response.status === 200) {
    localStorage.setItem('token', json);
    window.location.replace('http://localhost/Sistema-senha/');
    console.log(response);
  }
};

// const allShifts1 = async (alement) => {
//   alement.preventDefault()

// }
// $('#form1').submit(function(e){
//   e.preventDefault();

//   const u_cpf = $('#cpf_login').val();
//   var u_senha = $('#senha_login').val();
//  //console.log(u_cpf,u_senha);
//    $.ajax({
//       url:'http://localhost/Sistema-senha/app/controller/teste_jwt.controller.php',
//       method: 'POST',
//       data: {cpf: u_cpf, senha: u_senha},
//       dataType: 'json' ,
//       success:function(a, b, c) {
//           if(c.status === 200){
//              sessionStorage.setItem('session',a);
//              window.location.replace('http://localhost/Sistema-senha/')
//               console.log(c);
//           }

//       }
//    });
//   //  .done(function(result){

//   //     sessionStorage.setItem('session',result)
//   //  });

// });
// const input1 = document.querySelector("#input1");

// //input1.addEventListener('click', async()=>{
// $('#input1').submit(function(e){
//   e.preventDefault();

//       var verificar = 'Bearer '+ sessionStorage.getItem('session');
//       //console.log(verificar);

//       $.ajax({
//           url:'http://localhost/Sistema-senha/app/view/auth.php',
//           method: 'POST',
//           data: {verificar: verificar},
//           dataType: 'json'
//       }).done(function(result){
//           if(result === 'Expired token'){
//               alert('Sessão expirou');
//           }else{
//           console.log(result);
//           }
//       });

//});
