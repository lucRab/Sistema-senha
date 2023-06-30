<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <h1>cursos</h1>

  <script>
  const teste = async () => {
    const token = localStorage.getItem('token')
    const response = await fetch('http://localhost/Sistema-Senha/json/token/verificar', {
      method: 'POST',
      headers: {
        Authorization: 'Bearer ' + token,
      },
    });
    const json = await response.json()
    console.log(json);
  }
  teste()
  </script>
</body>

</html>