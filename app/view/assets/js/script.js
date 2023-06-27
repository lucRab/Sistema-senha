$('#form1').submit(function(e){
  e.preventDefault();

  var u_cpf = $('#cpf_login').val();
  var u_senha = $('#senha_login').val();
 //console.log(u_cpf,u_senha);
   $.ajax({
      url:'http://localhost/Sistema-senha/app/controller/teste_jwt.controller.php',
      method: 'POST',
      data: {cpf: u_cpf, senha: u_senha},
      dataType: 'json' ,
      success:function(a, b, c) {
          if(c.status === 200){
             sessionStorage.setItem('session',a);
             window.location.replace('http://localhost/Sistema-senha/')
              console.log(c);
          }

      }
   });
  //  .done(function(result){

  //     sessionStorage.setItem('session',result)
  //  });

});
const input1 = document.querySelector("#input1");

//input1.addEventListener('click', async()=>{
$('#input1').submit(function(e){
  e.preventDefault();

      var verificar = 'Bearer '+ sessionStorage.getItem('session');
      //console.log(verificar);

      $.ajax({ 
          url:'http://localhost/Sistema-senha/app/view/auth.php',
          method: 'POST',
          data: {verificar: verificar},
          dataType: 'json'
      }).done(function(result){
          if(result === 'Expired token'){
              alert('Sessão expirou');
          }else{
          console.log(result);
          }
      });






});