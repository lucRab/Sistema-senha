const inputSubmit = document.querySelector('.btn-sub');
const valueInput = inputSubmit.value;

const loading = (loading) => {
  console.log(inputSubmit);
  if (!loading) {
    inputSubmit.disabled = false;
    inputSubmit.value = valueInput;
    return null;
  }
  inputSubmit.disabled = true;
  inputSubmit.value = 'Carregando...';
};

export const requestTokenLogin = async () => {
  const cpf = document.querySelector('#cpf_login').value;
  const senha = document.querySelector('#senha_login').value;
  const alerta = document.querySelector('#alerta');
  let json;

  try {
    loading(true);
    const response = await fetch('http://localhost/Sistema-Senha/json/token/login', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ cpf: cpf, senha: senha }),
    });
    json = await response.json();
    if (!response.ok) throw new Error(response.status);
    localStorage.setItem('token', json);
    window.location.replace('http://localhost/Sistema-Senha/');
  } catch (error) {
    if (!error === 404) {
      alert(json);
      return null;
    }
    alerta.innerText = json;
  } finally {
    loading(false);
    return json;
  }
};

export const requestTokenRegister = async () => {
  const nome = document.querySelector('#nome_cad').value;
  const cpf = document.querySelector('#cpf_cad').value;
  const data_nascimento = document.querySelector('#data_cad').value;
  const senha = document.querySelector('#senha_cad').value;
  const alerta = document.querySelector('#alerta');
  let json;

  console.log(nome, cpf);

  try {
    loading(true);
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
    console.log(response);
    json = await response.json();
    if (!response.ok) throw new Error(response.status);
    localStorage.setItem('token', json);
    window.location.replace('http://localhost/Sistema-Senha/');
  } catch (error) {
    if (error === 403) {
      alerta.innerText = json;
      return null;
    }
    alert(json);
  } finally {
    loading(false);
    return json;
  }
};
