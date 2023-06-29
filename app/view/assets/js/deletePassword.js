const btn = document.querySelector('button');

const handleClick = async () => {
  const response = await fetch('http://localhost/Sistema-Senha/historico/update', {
    method: 'PUT',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({ cod_senha: 1 }),
  });
  console.log(response);
  console.log(await response.json());
};

btn.addEventListener('click', handleClick);
