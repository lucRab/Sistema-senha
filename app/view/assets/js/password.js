import { requestDays, days, shift } from './course.js';
const btn = document.getElementById('btn');
const error = document.querySelector('.error');
const confirmRequest = document.querySelector('.c-confirm');

const course = window.location.href.split('/');
const nameCourse = course[course.length - 1];
let timeout;

const clearLabel = (element) => {
  element.classList.remove('active');
  btn.classList.remove('change');
  element.innerText = '';
};

const loading = (loading) => {
  if (loading) {
    btn.innerText = 'Carregando...';
    btn.disabled = true;
  } else {
    btn.innerText = 'Retirar Senha';
    btn.disabled = false;
  }
};

export default function requestClass() {
  const handleClick = async () => {
    if (days && shift) {
      loading(true);
      try {
        const response = await fetch(
          `http://localhost/Sistema-Senha/curso/${nameCourse}`,
          {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
            },
            body: JSON.stringify({ shift: shift, days: days }),
          },
        );
        const json = await response.json();
        if (!response.ok) throw new Error(json);
        updatePassword(json.password.cod_senha);
      } catch (err) {
        loading(false);
        clearTimeout(timeout);
        confirmRequest.classList.remove('active');
        error.classList.add('active');
        error.innerText = err;
        btn.classList.add('change');
        timeout = setTimeout(() => {
          clearLabel(error);
        }, 2000);
      }
    }
  };

  const updatePassword = async (cod_senha) => {
    loading(true);
    try {
      const response = await fetch('http://localhost/Sistema-Senha/json/senha', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ cod_senha }),
      });
      const json = await response.json();
      if (!response.ok) throw new Error('Erro ao retirar senha');
      confirmRequest.classList.add('active');
    } catch (error) {
      confirmRequest.classList.add('active');
      confirmRequest.style.background = '#e54';
      confirmRequest.innerText = 'Erro ao retirar senha';
      console.log(error);
    } finally {
      loading(false);
      clearTimeout(timeout);
      timeout = setTimeout(() => {
        clearLabel(confirmRequest);
      }, 5000);
    }
  };

  btn.addEventListener('click', handleClick);
}

requestDays();
