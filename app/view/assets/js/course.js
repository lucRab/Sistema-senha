const selectDays = document.getElementById('days');
const selectShifts = document.getElementById('shifts');
let valuesShifts = null;
const course = window.location.href.split('/');
const nameCourse = course[course.length - 1];
export let shift = selectShifts.value;
export let days = selectDays.value;

export function requestDays() {
  shift = selectShifts.value;
  days = selectDays.value;

  const allShifts = async () => {
    const response = await fetch('http://localhost/Sistema-Senha/json/turnos', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ course: nameCourse, age: '10' }),
    });
    const json = await response.json();
    json;
    valuesShifts = json;
  };

  const handleChange = ({ target }) => {
    const changeDay = target.value;
    days = changeDay;
    const shifts = valuesShifts
      .filter(({ nome_dia }) => nome_dia === changeDay)
      .map(({ turno }) => turno);

    [...selectShifts].forEach((option) => {
      selectShifts.removeChild(option);
    });

    shifts.forEach((text) => {
      const option = document.createElement('option');
      option.innerText = text;
      option.value = text;
      selectShifts.appendChild(option);
    });

    shift = shifts[0];
  };

  const handleChangeShifts = ({ target }) => {
    shift = target.value;
  };

  allShifts();
  selectDays.addEventListener('change', handleChange);
  selectShifts.addEventListener('change', handleChangeShifts);
}
