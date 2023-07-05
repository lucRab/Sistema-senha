


export const requestTokenLogin = async (event) => {
    event.preventDefault()
    const senha = document.querySelector("#senha_login").value;
    const confirma = document.querySelector("#confirma_senha").value;
    const alerta = document.querySelector("#alerta").value;
    var mensage = "teste";
        if(senha != confirma) {
            alerta.innerText = mensage;
        }else{
        const response = await fetch('http://localhost/Sistema-Senha/json/atualizar', {
            method: 'POST',
            headers: {
            'Content-Type': 'application/json',
            },
            body: JSON.stringify({senha: senha }),
            });
            const a = await response.json();
            console.log(a);
        }
}

document.getElementById("atualizar").addEventListener("click", requestTokenLogin);