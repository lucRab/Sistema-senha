const btn = document.querySelector('.btn-more-courses');
const content = document.querySelector('.courses-content');
const input = document.querySelector('.filter-courses');
const elements = content.querySelectorAll('ul li a figcaption');
const close = document.querySelector('.close');

console.log(elements);

const handleClick = () => {
  window.scrollTo(0, 0);
  content.classList.add('active');
};

const closeContent = () => {
  content.classList.remove('active');
};

const filterCourses = ({ target }) => {
  elements.forEach((fig) => {
    const figText = fig.innerText.toLocaleLowerCase();
    const valueInput = target.value.toLocaleLowerCase();
    const parent = fig.parentElement.parentElement.parentElement;
    if (!figText.includes(valueInput)) {
      parent.style.display = 'none';
    } else {
      parent.style.display = 'block';
    }
  });
  console.log(target);
};

btn.addEventListener('click', handleClick);
input.addEventListener('input', filterCourses);
close.addEventListener('click', closeContent);
