const element = document.getElementById('form1')

const allShifts = async( e) => {
  e.preventDefault();

    var cpf = document.querySelector('#cpf_login').value;
    var senha = document.querySelector('#senha_login').value;

  const response = await fetch('http://localhost/Sistema-Senha/json/token', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({ cpf: cpf, senha: senha }),
  });
  const json = await response.json();
  //console.log(response.status);

  if(response.status === 200){
        sessionStorage.setItem('session',json);
        window.location.replace('http://localhost/Sistema-senha/')
        console.log(response);
    }
};

element.addEventListener('submit', allShifts);

const a = document.getElementById('form2')

const b = async(e)=>{   
    e.preventDefault()
    var nome =  document. querySelector("#nome_cad").value;
    var cpf =  document. querySelector("#cpf_cad").value;
    var data_nascimento =  document. querySelector("#data_cad").value;
    var senha =  document. querySelector("#senha_cad").value;
  
    const response = await fetch('http://localhost/Sistema-Senha/json/token1', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({nome: nome, cpf: cpf, data_nascimento: data_nascimento, senha: senha}),
    }); 
    const json = await response.json();
    if(response.status === 200){
        sessionStorage.setItem('session',json);
        window.location.replace('http://localhost/Sistema-senha/')
        console.log(response);
    }
}

a.addEventListener('submit',b)

// const allShifts1 = async (alement) => {
//   alement.preventDefault()
  
// }
    // $('#form1').submit(function(e){
//   e.preventDefault();

//   var u_cpf = $('#cpf_login').val();
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