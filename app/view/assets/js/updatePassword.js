const lostPassword = document.querySelector('.lost-password');
const lostPasswordContainer = document.querySelector('.lost-password-container');
const lostPasswordContent = document.querySelector('.lost-password-content');
const form = document.querySelector('.lost-password-form');
const closeModal = document.querySelector('.fechar');
let inputSubmit = form.querySelector('input[type=submit]');

const loading = (input, loading) => {
  if (!loading) {
    input.disabled = false;
    input.value = 'Enviar';
    return null;
  }
  input.disabled = true;
  input.value = 'Carregando...';
};

const updatePassword = (event) => {
  event.preventDefault();
  lostPasswordContainer.classList.add('active');
};

function generateCod() {
  return Math.random().toString(36).slice(2, 8);
}

const sendEmail = async (event) => {
  event.preventDefault();
  const cpf = document.querySelector('#cpf').value;
  const code = generateCod();
  const btn = form.querySelector('input[type=submit]');
  try {
    loading(btn, true);
    const response = await fetch(`http://localhost/Sistema-Senha/login/atualizar`, {
      method: 'PUT',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ cpf, code }),
    });
    response;
    const json = await response.json();
    if (!response.ok) throw new Error(json);
    sendCode(code, { email: json.email, cpf });
  } catch (error) {
    alert(error);
  } finally {
    loading(btn, false);
  }
};

const createElement = (type, attributes = {}, parent) => {
  const element = document.createElement(type);
  Object.keys(attributes).forEach((key) => (element[key] = attributes[key]));
  if (parent) parent.appendChild(element);
  return element;
};

const sendCode = (code, data) => {
  lostPasswordContainer;
  lostPasswordContent.hasChildNodes(form);
  if (lostPasswordContent.hasChildNodes(form)) {
    lostPasswordContent.removeChild(form);
  }
  const newForm = createElement(
    'form',
    { className: 'lost-password-form-code' },
    lostPasswordContent,
  );

  createElement(
    'label',
    { textContent: 'Digite o código enviado ao email', htmlFor: 'code' },
    newForm,
  );
  createElement('p', { textContent: data.email }, newForm);
  createElement('input', { type: 'text', name: 'code', id: 'code' }, newForm);
  const error = createElement('p', { type: 'text', className: 'error' }, newForm);

  createElement('input', { type: 'submit' }, newForm);

  newForm.addEventListener('submit', (event) => {
    event.preventDefault();
    const value = event.target['0'].value;
    if (value === code) {
      newPassword(newForm, data);
    } else {
      error.innerText = 'Código inválido';
    }
  });
};

const newPassword = (newForm, data) => {
  if (lostPasswordContent.hasChildNodes(form)) {
    lostPasswordContent.removeChild(newForm);
  }
  const formPassword = createElement(
    'form',
    { className: 'lost-password-form-code' },
    lostPasswordContent,
  );

  createElement(
    'label',
    { textContent: 'Digite sua nova senha', htmlFor: 'newpassword' },
    formPassword,
  );
  createElement(
    'input',
    { type: 'text', name: 'newpassword', id: 'newpassword' },
    formPassword,
  );
  const btnSubmit = createElement('input', { type: 'submit' }, formPassword);

  formPassword.addEventListener('submit', (event) => {
    event.preventDefault();
    event;
    const newPassword = event.target['0'].value;
    const { cpf } = data;
    requestNewPassword(cpf, newPassword, btnSubmit);
  });
};

const requestNewPassword = async (cpf, newPass, btnSubmit) => {
  try {
    loading(btnSubmit, true);
    const response = await fetch(`http://localhost/Sistema-Senha/login/atualizar/senha`, {
      method: 'PUT',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ cpf, newPassword: newPass }),
    });
    const json = await response.json();
    if (!response.ok) throw new Error(json);
  } catch (error) {
    return error;
  } finally {
    loading(btnSubmit, false);
    handleCloseModal();
  }
};

const handleCloseModal = () => {
  lostPasswordContainer.classList.remove('active');
};

lostPassword.addEventListener('click', updatePassword);
form.addEventListener('submit', sendEmail);
closeModal.addEventListener('click', handleCloseModal);
