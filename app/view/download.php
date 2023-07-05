<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
  * {
    padding: 0;
    margin: 0;
  }

  body {
    font-family: sans-serif;
    margin: 2rem;
  }

  li {
    list-style: none;
  }

  li {
    margin-top: 1rem;
    font-size: 1rem;
  }

  li p {
    margin-top: 0.3rem;
  }

  h2 {
    margin-top: 0.5rem;
  }


  body>p {
    margin: 1rem 0;
    padding-bottom: 0.1rem;
    font-size: 1.3rem;
    border-bottom: 1px solid #000;
  }
  </style>
</head>

<body>
  <h1>Cidade do Saber - <?= date('d/m/Y') ?></h1>
  <h2>Curso: <?= ucwords(mb_strtolower($infosPassword[0]->nome_curso))  ?></h2>
  <p>Informações da Turma</p>
  <ul>
    <li>
      <p>Turma: <?= $infosPassword[0]->nome_turma ?></p>
      <p>Dias de Aula: <?= ucwords(mb_strtolower($infosPassword[0]->dias_de_aula)) ?></p>
    </li>
    <li>Turno: <?= ucwords(mb_strtolower($infosPassword[0]->turno))  ?></li>
    <li>
      <p>Data Início: <?= $infosPassword[0]->data_inicio ?></p>
      <p>Data Termino: <?= $infosPassword[0]->data_termino ?></p>
    </li>
    <li>
      <p>Hora Início: <?= $infosPassword[0]->hora_inicio ?></p>
      <p>Hora Termino: <?= $infosPassword[0]->hora_termino ?></p>
    </li>
    <li>
      <p>Idade Minima: <?= $infosPassword[0]->idade_minima ?> anos</p>
      <p>Idade Máxima: <?= $infosPassword[0]->idade_maxima ?> anos</p>
    </li>
    <li>
      <p>Autenticação: <?= $infosPassword[0]->autenticacao ?></p>
      <p>Validade: <?= $infosPassword[0]->validade ?></p>
    </li>
  </ul>

  <p>Informações Pessoais</p>
  <ul>
    <li>
      <p>Nome: <?= $_SESSION['nome'] ?></p>
      <p>CPF: <?= $_SESSION['cpf'] ?></p>
      <p>Idade: <?= $_SESSION['idade'] ?> anos</p>
    </li>
  </ul>
</body>

</html>