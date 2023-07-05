async function authToken() {
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
    if (loading) loading.classList.add('active');
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
  } catch (error) {
    json = error;
    logoutUser();
  } finally {
    loadingScreen = false;
    if (loading) loading.classList.remove('active');
    console.log(json);
    return json;
  }
}

window.addEventListener('load', authToken);
