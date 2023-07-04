<?php 

  var_dump($_SESSION);

?>


<!DOCTYPE html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="../app/view/assets/css/login.css">
</head>

<body>
  <div class="c-loader"></div>
  <h1 class="gradient">Cidade do Saber</h1>
  <div class="container">
    <div class="content">
      <!--FORMULÁRIO DE LOGIN-->
      <div id="login">
        <form method="post" >
          <h1>Atualizar Senha</h1>
          <p>
            <label for="senha_login">Senha nova</label>
            <input id="senha_login" required="required" type="password" placeholder="digite a senha" data-validate="password" />
            <span class="error"></span>
          </p>
          <p>
            <label for="senha_login">Comfirmar senha</label>
            <input id="confirma_senha" required="required" type="password" placeholder="digite a senha" data-validate="password" />
            <span class="error"></span>
          </p>
          <p>
            <button class="btn-sub" id="atualizar">Atualizar Senha</button>
          </p>
          <div id="alerta">
          </div>
        </form>
      </div>

      <!--FORMULÁRIO DE CADASTRO-->

    </div>
  </div>
  <!--<script src="../app/view/assets/js/token/authToken.js"></script>-->
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script type="module" src="../app/view/assets/js/atualizar.js"></script>
</body>