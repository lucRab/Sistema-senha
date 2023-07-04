const atualizar = document.querySelector('#atualizar');

const atualizacao = async () => {
    const senha = document.querySelector('#senha_login').value;
    const confirma = document.querySelector('#confirma_senha').value;
    const alerta = document.querySelector('#alerta');

    if(senha == confirma) {

    }else{
        alerta.innerText = "teste";
    }
}
atualizar.addEventListener('submit', atualizacao);