$('#form1').submit(function(e){
  e.preventDefault();

  var u_cpf = $('#cpf_login').val();
  var u_senha = $('#senha_login').val();
 //console.log(u_cpf,u_senha);
   $.ajax({
      url:'http://localhost/Sistema-senha/app/controller/Token.php',
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
});
const form = document.getElementById('form2');
$(form).submit(function(e){
    e.preventDefault();

    var u_nome = $('#nome_cad').val();
    var u_cpf = $('#cpf_cad').val();
    var u_data = $('#data_cad').val();
    var u_senha = $('#senha_cad').val();

    $.ajax({
        url:'http://localhost/Sistema-senha/login/token',
        method: 'POST',
        data: {nome: u_nome, cpf: u_cpf, data_nascimento: u_data, senha: u_senha},
        dataType: 'json' ,
        success:function(a, b, c) {
            if(c.status === 200){
               sessionStorage.setItem('session',a);
               window.location.replace('http://localhost/Sistema-senha/')
                console.log(c);
            }
  
        }
     });

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