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
        <form method="post" id="form1">
          <h1>Senha</h1>
          <p>
            <label for="senha_login">Sua senha</label>
            <input id="senha_login" name="senha_login" required="required" type="password" placeholder="digite a senha" />
          </p>
          <p>
            <input type="checkbox" name="manterlogado" id="manterlogado" value="" />
            <label for="manterlogado">Manter-me logado</label>
          </p>
          <p>
            <input type="submit" class="btn-sub" value="Logar" />
          </p>
        
          <p class="link">
            Sem conta?
            <a href="http://localhost/Sistema-senha/login#paracadastro">Cadastre-se</a>
          </p>
          
        </form>
      </div>
      
      <form id="login">
        <p class="link">
            Criar uma senha?
            <a href="#paracadastro">Cadastre-se</a>
        </p>
      </form>
      
      <div id="cadastro">
        <form method="post" id="form2">
          <h1>Criar sua Senha</h1>
          <p>
            <label for="nome_cad">Crie uma senha</label>
            <input id="nome_cad" name="nome_cad" required="required" type="text" placeholder="Digite a senha" />
          </p>
          <p>
            <label for="senha_cad">Comfirme a senha</label>
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
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script src="app/view/assets/js/script.js"></script>
</body>