<!DOCTYPE html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro</title>
  <link rel="stylesheet" href="../app/view/assets/css/login.css">
</head>

<body>
  <div class="c-loader"></div>
  <h1 class="gradient">Cidade do Saber</h1>
  <div class="container">
    <div class="content">
      <!--FORMULÁRIO DE CADASTRO-->
      <div id="cadastro">
        <form method="post" id="form2" data-action="cad">
          <h1>Cadastro</h1>
          <p>
            <label for="nome_cad">Seu nome</label>
            <input id="nome_cad" name="nome_cad" type="text" placeholder="Digite seu nome" data-validate="name" />
            <span class="error"></span>
          </p>
          <p>
            <label for="cpf_cad">Seu CPF</label>
            <input id="cpf_cad" name="cpf_cad" type="text" placeholder="000.000.000-00" data-validate="cpf" />
            <span class="error"></span>
          </p>
          <p>
            <label for="data_cad">Data de Nascimento</label>
            <input id="data_cad" name="data_cad" data-validate="date" type="date" placeholder="Data de Nascimento" max="<?= date("Y-m-d") ?>" />
            <span class="error"></span>
          </p>
          <p>
            <label for="senha_cad">Sua senha</label>
            <input id="senha_cad" name="senha_cad" type="password" placeholder="Digite a senha" data-validate="password" />
            <span class="error"></span>
          </p>
          <p>
            <input type="submit" disabled value="Cadastrar" />
          </p>
          <div id="alerta">
          </div>
          <p class="link">
            Possui conta?
            <a href="../login"> Ir para Login </a>
          </p>
        </form>
      </div>
    </div>
  </div>

  <script src="../app/view/assets/js/token/authToken.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script type="module" src="../app/view/assets/js/validations.js"></script>
  <script type="module" src="../app/view/assets/js/token/token.js"></script>
</body>