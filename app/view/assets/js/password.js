import { requestDays, days, shift } from './course.js';
const btn = document.getElementById('btn');
const course = window.location.href.split('/');
const nameCourse = course[course.length - 1];

export default function requestClass() {
  const handleClick = async () => {
    console.log(days, shift);
    if (days && shift) {
      const response = await fetch(`http://localhost/Sistema-Senha/curso/${nameCourse}`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ age: '10', shift: shift, days: days }),
      });
      console.log(response);
      const json = await response.json();
      console.log(json);
      if (response.ok) {
        updatePassword(json.password.cod_senha);
      }
    } else {
      alert('n foi selecionado');
    }
  };

  const updatePassword = async (cod_senha) => {
    const response = await fetch('http://localhost/Sistema-Senha/json/senha', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ cod_senha: 1, id: 1 }),
    });
    console.log(response);
    const json = await response.json();
    console.log(json);
  };

  btn.addEventListener('click', handleClick);
}
requestDays();
