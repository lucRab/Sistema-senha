$('#form1').submit(function(e){
    e.preventDefault();

    var u_cpf = $('#cpf_login').val();
    var u_senha = $('#senha_login').val();
   // console.log(u_cpf,u_senha);
     $.ajax({
        url:'http://localhost/Sistema-senha/app/controller/teste_jwt.controller.php',
        method: 'POST',
        data: {cpf: u_cpf, senha: u_senha},
        dataType: 'json' 
     }).done(function(result){
        //console.log(result);
        sessionStorage.setItem('session',result)
     });
});
const input1 = document.querySelector("#input1");

input1.addEventListener('click', async()=>{
    try {
    const verificar = 'Bearer'+ sessionStorage.getItem('session');
    
    const {data} = await axios.get('auth.php',{
        headers:{
            "Authorization":  verificar
        }
    })
    console.log(data); 
    }catch(error) {
        console.log(error);
    }
});
// $('#input1').submit(function(e){
//     input1.addEventListener('click', ()=>(
//         console.log('teste')
//     ));
    
// });