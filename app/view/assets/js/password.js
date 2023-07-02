import { requestDays, days, shift } from './course.js';
const btn = document.getElementById('btn');
const error = document.querySelector('.error');
const course = window.location.href.split('/');
const nameCourse = course[course.length - 1];
let timeout;

export default function requestClass() {
  const handleClick = async () => {
    console.log(days, shift);
    if (days && shift) {
      const response = await fetch(`http://localhost/Sistema-Senha/curso/${nameCourse}`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ shift: shift, days: days }),
      });
      console.log(response);
      const json = await response.json();
      console.log(json);
      if (response.ok) {
        updatePassword(json.password.cod_senha);
      } else {
        clearTimeout(timeout);
        error.classList.add('active');
        error.innerText = `Error: ${json}`;
        btn.classList.add('change');
        timeout = setTimeout(errorRequest, 2000);
      }
    } else {
      alert('n foi selecionado');
    }
  };

  const errorRequest = () => {
    setTimeout(() => {
      error.classList.remove('active');
      btn.classList.remove('change');
      error.innerText = '';
    }, 2000);
  };

  const updatePassword = async (cod_senha) => {
    const response = await fetch('http://localhost/Sistema-Senha/json/senha', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ cod_senha }),
    });
    const json = await response.json();
    console.log(response);
    console.log(json);
  };

  btn.addEventListener('click', handleClick);
}
requestDays();
