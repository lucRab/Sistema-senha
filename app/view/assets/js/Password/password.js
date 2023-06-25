const btn = document.getElementById('btn');

const handleClick = async () => {
  const response = await fetch('http://localhost/Sistema-Senha/curso/ingles', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({ nome: 'gui', idade: '10' }),
  });
  console.log(response);
  const json = await response.json();
  console.log(json);
};

btn.addEventListener('click', handleClick);
