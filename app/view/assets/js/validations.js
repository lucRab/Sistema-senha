import { requestTokenRegister, requestTokenLogin } from './token/token.js';
import validaCPF from './validaCPF.js';

const validations = {
  name: {
    regex: /^((\b[A-zÀ-ú']{2,40}\b)\s*){2,}$/,
    message: 'Digite um nome e sobrenome válido',
  },
  password: {
    regex: /^.{6,}$/,
    message: 'A senha deve possuir no mínimo 6 caracteres',
  },
  cpf: {
    validate: (value) => validaCPF(value),
    message: 'CPF inválido',
  },
  date: {
    validate: (value) => {
      const date = value.split('-').join(', ');
      const birthDate = new Date(date);
      const currentDate = new Date();
      return birthDate.getTime() > currentDate.getTime() ? false : true;
    },
    message: 'Data inválida',
  },
};

const elements = {
  name: false,
  cpf: false,
  date: false,
  password: false,
};

function validationsData() {
  let form = document.querySelector('form');
  const inputs = document.querySelectorAll('form input[data-validate]');
  const btn = document.querySelector('input[type="submit"]');
  const action = form.getAttribute('data-action');

  const validation = (target) => {
    const type = target.getAttribute('data-validate');
    const value = target.value;
    const errorElement = target.nextElementSibling;

    if (value.length === 0) {
      errorElement.innerText = 'Digite um valor';
      elements[type] = false;
    } else if (
      (type === 'cpf' || type === 'date') &&
      !validations[type].validate(value)
    ) {
      elements[type] = false;
      errorElement.innerText = validations[type].message;
    } else if (
      type !== 'cpf' &&
      type !== 'date' &&
      validations[type] &&
      !validations[type].regex.test(value)
    ) {
      elements[type] = false;
      errorElement.innerText = validations[type].message;
    } else {
      elements[type] = true;
      errorElement.innerText = '';
    }
  };

  const handleChange = (event) => {
    event.preventDefault();
    validation(event.target);
    const totalInputs = Object.values(elements);
    const inputsValid = totalInputs.filter((element) => element === true);
    inputsValid;
    if (inputsValid.length === inputs.length) {
      btn.disabled = false;
    } else {
      btn.disabled = true;
    }
  };

  const submitForm = (e) => {
    e.preventDefault();
    const totalInputs = Object.values(elements);
    const inputsValid = totalInputs.filter((element) => element === true);
    if (inputsValid.length === inputs.length) {
      if (action === 'cad') requestTokenRegister();
      else if (action === 'log') requestTokenLogin();
    }
  };

  form.addEventListener('change', handleChange);
  form.addEventListener('submit', submitForm);
  inputs.forEach((input) => {
    input.addEventListener('blur', handleChange);
  });
}

validationsData();
