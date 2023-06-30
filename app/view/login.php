<?php 

  var_dump($_SESSION);

?>


<!DOCTYPE html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="app/view/assets/css/login.css">
</head>

<body>
  <div class="c-loader"></div>
  <h1 class="gradient">Cidade do Saber</h1>
  <div class="container">
    <div class="content">
      <!--FORMULÁRIO DE LOGIN-->
      <div id="login">
        <form method="post" id="form1" data-action="log">
          <h1>Login</h1>
          <p>
            <label for="cpf_login">Seu CPF</label>
            <input id="cpf_login" name="cpf_login" required="required" type="text" placeholder="000.000.000-00" data-validate="cpf" />
            <span class="error"></span>
          </p>
          <p>
            <label for="senha_login">Sua senha</label>
            <input id="senha_login" name="senha_login" required="required" type="password" placeholder="digite a senha" data-validate="password" />
            <span class="error"></span>
          </p>
          <p>
            <input type="checkbox" name="manterlogado" id="manterlogado" value="" />
            <label for="manterlogado">Manter-me logado</label>
          </p>
          <p>
            <input type="submit" class="btn-sub" value="Logar" disabled />
          </p>

          <p class="link">
            Sem conta?
            <a href="login/cadastro">Cadastre-se</a>
          </p>
        </form>
      </div>

      <!--FORMULÁRIO DE CADASTRO-->

    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script type="module" src="app/view/assets/js/validations.js"></script>
  <script type="module" src="app/view/assets/js/token/token.js"></script>
  <script type="module" src="app/view/assets/js/loadingLogin.js"></script>
</body>