export const requestTokenLogin = async () => {
  const cpf = document.querySelector('#cpf_login').value;
  const senha = document.querySelector('#senha_login').value;
  const alerta = document.querySelector('#alerta');
  const response = await fetch('http://localhost/Sistema-Senha/json/token/login', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({ cpf: cpf, senha: senha }),
  });
  const json = await response.json();
  //console.log(response.status);
  if (response.ok) {
    localStorage.setItem('token', json);
    window.location.replace('http://localhost/Sistema-Senha/');
    console.log(json);
  } else {
    if (response.status === 404) {
      alerta.innerText = json;
    } else {
      alert(json);
    }
  }
};

export const requestTokenRegister = async () => {
  const nome = document.querySelector('#nome_cad').value;
  const cpf = document.querySelector('#cpf_cad').value;
  const data_nascimento = document.querySelector('#data_cad').value;
  const senha = document.querySelector('#senha_cad').value;
  const alerta = document.querySelector('#alerta');

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
  console.log(response);
  const json = await response.json();
  //
  if (!response.ok) {
    if (response.status === 403) {
      alerta.innerText = json;
      return null;
    }
    alert(json);
  } else {
    if (response.status === 200) {
      localStorage.setItem('token', json);
      window.location.replace('http://localhost/Sistema-Senha/');
      console.log(json);
    }
  }
};

