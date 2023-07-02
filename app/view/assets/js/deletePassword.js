const btns = document.querySelectorAll('.btn');
const content = document.querySelector('.content');

const handleClick = async ({ target }) => {
  const cod_senha = target.id;
  const elementPassword = target.parentNode.parentNode;

  const response = await fetch('http://localhost/Sistema-Senha/historico/update', {
    method: 'PUT',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({ cod_senha }),
  });

  if (response.ok) {
    setTimeout(() => {
      content.removeChild(elementPassword);
    }, 200);
  }
};

btns.forEach((btn) => {
  btn.addEventListener('click', handleClick);
});
