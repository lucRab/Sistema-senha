const btns = document.querySelectorAll('.btn-danger');
const content = document.querySelector('.content');

const handleClick = async ({ target }) => {
  let elementPassword = target.parentNode.parentNode;
  if (target.tagName === 'I') {
    elementPassword = elementPassword.parentNode;
  }

  const cod_senha = elementPassword.querySelector('button').id;
  const response = await fetch('http://localhost/Sistema-Senha/historico/update', {
    method: 'PUT',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({ cod_senha }),
  });
  const json = await response.json();
  response;
  json;
  if (response.ok) {
    if (content.hasChildNodes(elementPassword)) {
      elementPassword;
      content.removeChild(elementPassword);
    }
  }
};
btns.forEach((btn) => {
  btn.addEventListener('click', handleClick);
});
