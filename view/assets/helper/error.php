<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

  <title>404 HTML Template by Colorlib</title>

  <!-- Google font -->
  <link href="https://fonts.googleapis.com/css?family=Cabin:400,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:900" rel="stylesheet">

  <!-- Custom stlylesheet -->
  <link rel="stylesheet" href="../app/view/assets/css/error/error.css">

</head>

<body>

  <div id="notfound">
    <div class="notfound">
      <div class="notfound-404">
        <h3>Oops! Página não encontrada</h3>
        <h1><span><?= $error[0] ?></span><span><?= $error[1] ?></span><span><?= $error[2] ?></span></h1>
      </div>
      <h2>Desculpe, mas a página que está procurando não foi encontrada</h2>
      <a href="../">Página Inicial</a>
    </div>
  </div>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>