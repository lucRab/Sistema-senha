$('#form1').submit(function(e){
    e.preventDefault();

    var u_cpf = $('#cpf_login').val();
    var u_senha = $('#senha_login').val();
   //console.log(u_cpf,u_senha);
     $.ajax({
        url:'http://localhost/Sistema-senha/app/controller/teste_jwt.controller.php',
        method: 'POST',
        data: {cpf: u_cpf, senha: u_senha},
        dataType: 'json' 
     }).done(function(result){
        console.log(result);
        sessionStorage.setItem('session',result)
     });
});
const input1 = document.querySelector("#input1");

//input1.addEventListener('click', async()=>{
$('#imput1').submit(function(e){
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