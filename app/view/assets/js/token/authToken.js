async function authToken() {
  const loadingBg = document.querySelector('.c-loader-bg');
  const loading = document.querySelector('.c-loader');
  let loadingScreen = false;
  let json = null;
  const location = window.location.href;

  const logoutUser = () => {
    if (!location.includes('login') && !location.includes('registro')) {
      window.localStorage.removeItem('token');
      window.location.replace('/Sistema-Senha/login');
    }
  };

  const token = localStorage.getItem('token');
  try {
    loadingScreen = true;
    if (loading) {
      loadingBg.classList.add('active');
      loading.classList.add('active');
    }
    if (!token) throw new Error('Usuario nao verificado');
    const response = await fetch('http://localhost/Sistema-Senha/json/token/verificar', {
      method: 'POST',
      headers: {
        Authorization: 'Bearer ' + token,
      },
    });
    json = await response.json();
    if (!response.ok) throw new Error('Sem permissão');
    if (location.includes('login') || location.includes('registro')) {
      window.location.replace('/Sistema-Senha');
    }
    updateEmail(json.email, json.id_usuario);
  } catch (error) {
    json = error;
    logoutUser();
  } finally {
    loadingScreen = false;
    if (loading) {
      loadingBg.classList.remove('active');
      loading.classList.remove('active');
    }
    json;
    return json;
  }
}

const updateEmail = (email, id_usuario) => {
  const updateContent = document.querySelector('.update-email-content');
  if (updateContent) {
    const form = updateContent.querySelector('form');
    if (!email || email === 'Analise') {
      updateContent.classList.add('active');
      form.addEventListener('submit', (event) => {
        event.preventDefault();
        const emailValue = event.target[0].value;
        requestUpdateEmail(emailValue, id_usuario);
        updateContent.classList.remove('active');
      });
    }
  }
};

const requestUpdateEmail = async (emailValue, id_usuario) => {
  console.log(value);
  try {
    const response = await fetch('http://localhost/Sistema-Senha/login/atualizar/email', {
      method: 'PUT',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ email: emailValue, cod_aluno: id_usuario }),
    });
    json = await response.json();
    console.log(json);
    if (!response.ok) throw new Error('Sem permissão');
  } catch (error) {
    json = error;
    logoutUser();
  } finally {
    console.log(json);
    return json;
  }
};

window.addEventListener('load', authToken);
