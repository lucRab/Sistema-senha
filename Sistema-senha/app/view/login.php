<!DOCTYPE html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cidade do Saber</title>
  <link rel="stylesheet" href="app/view/assets/css/login.css">
</head>

<body>
  <h1 class="gradient">Cidade do Saber</h1>
  <div class="container">
    <a class="links" id="paracadastro"></a>
    <a class="links" id="paralogin"></a>

    <div class="content">
      <!--FORMULÁRIO DE LOGIN-->
      <div id="login">
        <form method="post" action="">
          <h1>Login</h1>
          <p>
            <label for="cpf_login">Seu CPF</label>
            <input id="cpf_login" name="cpf_login" required="required" type="text" placeholder="000.000.000-00" />
          </p>

          <p>
            <label for="senha_login">Sua senha</label>
            <input id="senha_login" name="senha_login" required="required" type="password" placeholder="digite a senha" />
          </p>

          <p>
            <input type="checkbox" name="manterlogado" id="manterlogado" value="" />
            <label for="manterlogado">Manter-me logado</label>
          </p>

          <p>
            <input type="submit" value="Logar" />
          </p>

          <p class="link">
            Sem conta?
            <a href="#paracadastro">Cadastre-se</a>
          </p>
        </form>
      </div>
      <script> src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"</script>
      <script> 
        const form = document.querySelector("#form");

        form.addEventListener("submit", function(event){
          event.preventDefault();
          console.log('submit');
        })
    </script>

      <!--FORMULÁRIO DE CADASTRO-->
      <div id="cadastro">
        <form method="post" action="">
          <h1>Cadastro</h1>

          <p>
            <label for="nome_cad">Seu nome</label>
            <input id="nome_cad" name="nome_cad" required="required" type="text" placeholder="Digite seu nome" />
          </p>

          <p>
            <label for="cpf_cad">Seu CPF</label>
            <input id="cpf_cad" name="cpf_cad" required="required" type="text" placeholder="000.000.000-00" />
          </p>

          <p>
            <label for="senha_cad">Sua senha</label>
            <input id="senha_cad" name="senha_cad" required="required" type="password" placeholder="Digite a senha" />
          </p>

          <p>
            <input type="submit" value="Cadastrar" />
          </p>

          <p class="link">
            Possui conta?
            <a href="#paralogin"> Ir para Login </a>
          </p>
        </form>
      </div>
    </div>
  </div>
</body>