<!DOCTYPE html>
<html>
    <header>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <title>Login</title>
    </header>
    <body>
        <div class = "container">
            <h1>Sitema de Checklist</h1>
            <div class="row">
                <form>
                    <h1>Olá!</h1>
                    <div class="col-md-6">
                        <label for="username" class="form-label">Usuario</label><br>
                        <input id="username" type="text" class="form-control" placeholder="Informe seu usuario"/>
                    </div>
                    <div class="col-md-6">
                        <label for="senha" class="form-label">Senha</label><br>
                        <input id="senha" type="text" class="form-control" placeholder="Informe sua senha"/>
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-primary">Logar</button>
                    </div>
                    <p class="link">
                        Sem conta?
                        <a href="login/cadastro">Cadastre-se</a>
                    </p>s
                </form>
            </div>
        </div>
    </body>
</html>