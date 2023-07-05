<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../app/view/assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="../app/view/assets/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="../app/view/assets/css/templatemo-style.css">
  <title>Document</title>
</head>

<body>
  <div class="c-loader-bg">
    <div class="c-loader"></div>
  </div>

  <!-- Page Loader -->
  <div id="loader-wrapper">
    <div id="loader"></div>

    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>

  </div>
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <a class="navbar-brand gradient" href="../">
        <i class="fas fa-film mr-2"></i>
        Cidade do Saber
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link nav-link-1 active" aria-current="page" href="../">Cidade do Saber</a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav-link-2" href="https://www.camacari.ba.gov.br/">Prefeitura</a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav-link-3" href="../historico">Histórico de Senhas</a>
          </li>

        </ul>
      </div>
    </div>
  </nav>

  <div class="container-fluid tm-container-content tm-mt-60">
    <div class="c-confirm">
      <p>Senha adquirida</p>
      <a href="../historico">Mais informações</a>
    </div>
    <div class="row mb-4">
      <h2 class="col-12 tm-text-primary"><?= ucwords(mb_strtolower($dataCourse[0]->nome_curso)) ?></h2>
    </div>
    <div class="row tm-mb-90">
      <div class="col-xl-8 col-lg-7 col-md-6 col-sm-12">
        <img src="<?= $src ?>" width="700" height="400" alt="Image" class="img-fluid">
      </div>
      <div class="col-xl-4 col-lg-5 col-md-6 col-sm-12">
        <div class="tm-bg-gray tm-video-details">

          <?= $fragment ?>
          <button id="btn" class="btn btn-primary tm-btn-big">Retirar Senha</button>
          <p class="total-senhas">Total de senhas: <?= $dataCourse[0]->total_senhas ?></p>
          <div class="error"></div>

        </div>
      </div>
    </div>
    <?= $infosCourse ?>
    <div class="row mb-4">
      <h2 class="col-12 tm-text-primary">
        Mais cursos
      </h2>
    </div>
    <div class="row mb-3 tm-gallery">
      <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
        <figure class="effect-ming tm-video-item">
          <img src="../app/view/assets/imgs/img-01.jpg" alt="Image" class="img-fluid">
          <figcaption class="d-flex align-items-center justify-content-center">
            <h2>Bateria</h2>
            <a href="bateria">View more</a>
          </figcaption>
        </figure>
        <div class="d-flex justify-content-between tm-text-gray">
          <span class="tm-text-gray-light">16 Oct 2020</span>
          <span>12,460 views</span>
        </div>
      </div>
      <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
        <figure class="effect-ming tm-video-item">
          <img src="../app/view/assets/imgs/img-02.jpg" alt="Image" class="img-fluid">
          <figcaption class="d-flex align-items-center justify-content-center">
            <h2>Natação</h2>
            <a href="natacao_escolinha">View more</a>
          </figcaption>
        </figure>
        <div class="d-flex justify-content-between tm-text-gray">
          <span class="tm-text-gray-light">12 Oct 2020</span>
          <span>11,402 views</span>
        </div>
      </div>
      <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
        <figure class="effect-ming tm-video-item">
          <img src="../app/view/assets/imgs/img-03.png" alt="Image" class="img-fluid">
          <figcaption class="d-flex align-items-center justify-content-center">
            <h2>Inglês</h2>
            <a href="ingles">View more</a>
          </figcaption>
        </figure>
        <div class="d-flex justify-content-between tm-text-gray">
          <span class="tm-text-gray-light">8 Oct 2020</span>
          <span>9,906 views</span>
        </div>
      </div>
      <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
        <figure class="effect-ming tm-video-item">
          <img src="../app/view/assets/imgs/img-04.jpg" alt="Image" class="img-fluid">
          <figcaption class="d-flex align-items-center justify-content-center">
            <h2>Canto</h2>
            <a href="canto">View more</a>
          </figcaption>
        </figure>
        <div class="d-flex justify-content-between tm-text-gray">
          <span class="tm-text-gray-light">6 Oct 2020</span>
          <span>16,100 views</span>
        </div>
      </div>
      <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
        <figure class="effect-ming tm-video-item">
          <img src="../app/view/assets/imgs/img-05.jpg" alt="Image" class="img-fluid">
          <figcaption class="d-flex align-items-center justify-content-center">
            <h2>Teclado</h2>
            <a href="teclado">View more</a>
          </figcaption>
        </figure>
        <div class="d-flex justify-content-between tm-text-gray">
          <span class="tm-text-gray-light">26 Sep 2020</span>
          <span>16,008 views</span>
        </div>
      </div>
      <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
        <figure class="effect-ming tm-video-item">
          <img src="../app/view/assets/imgs/img-06.jpg" alt="Image" class="img-fluid">
          <figcaption class="d-flex align-items-center justify-content-center">
            <h2>Ballet</h2>
            <a href="ballet">View more</a>
          </figcaption>
        </figure>
        <div class="d-flex justify-content-between tm-text-gray">
          <span class="tm-text-gray-light">22 Sep 2020</span>
          <span>12,860 views</span>
        </div>
      </div>
      <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
        <figure class="effect-ming tm-video-item">
          <img src="../app/view/assets/imgs/img-07.jpg" alt="Image" class="img-fluid">
          <figcaption class="d-flex align-items-center justify-content-center">
            <h2>Robótica</h2>
            <a href="robotica_lego">View more</a>
          </figcaption>
        </figure>
        <div class="d-flex justify-content-between tm-text-gray">
          <span class="tm-text-gray-light">12 Sep 2020</span>
          <span>10,900 views</span>
        </div>
      </div>
      <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
        <figure class="effect-ming tm-video-item">
          <img src="../app/view/assets/imgs/img-08.jpg" alt="Image" class="img-fluid">
          <figcaption class="d-flex align-items-center justify-content-center">
            <h2>Pilates</h2>
            <a href="pilates">View more</a>
          </figcaption>
        </figure>
        <div class="d-flex justify-content-between tm-text-gray">
          <span class="tm-text-gray-light">4 Sep 2020</span>
          <span>11,300 views</span>
        </div>
      </div>
    </div> <!-- row -->
  </div> <!-- container-fluid, tm-container-content -->

  <footer class="tm-bg-gray pt-5 pb-3 tm-text-gray tm-footer">
    <div class="container-fluid tm-container-small">
      <div class="row">
        <div class="col-lg-6 col-md-12 col-12 px-5 mb-5">
          <h3 class="tm-text-primary mb-4 tm-footer-title">Endereço:</h3>
          <p>Rua do Telegrafo, S/Nº, bairro do Natal, Camaçari - BA</p>
          <p>Tel: (71)3644-9824</p>
          <p>Funcionamento: Seg a Sex das 8h às 17h</p>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 col-12 px-5 mb-5">
          <ul class="tm-social-links d-flex justify-content-end pl-0 mb-5">
            <li class="mb-2"><a href="https://facebook.com"><i class="fab fa-facebook"></i></a></li>
            <li class="mb-2"><a href="https://twitter.com"><i class="fab fa-twitter"></i></a></li>
            <li class="mb-2"><a href="https://instagram.com"><i class="fab fa-instagram"></i></a></li>
            <li class="mb-2"><a href="https://pinterest.com"><i class="fab fa-pinterest"></i></a></li>
          </ul>

        </div>
      </div>
    </div>
  </footer>

  <?php if (!isset($_SESSION['email']) || empty($_SESSION['email'])): ?>
  <div class="update-email-content">
    <form>
      <p>Caso esqueça sua senha, adicione um email válido para entrarmos em contato</p>
      <div class="update-email-content-inputs">
        <input type="text" name="email" id="email">
        <input type="submit" class="btn btn-success btn-sm rounded" value="Confirmar" placeholder="Sua email">
      </div>
    </form>
  </div>
  <?php endif; ?>


  <script src="../app/view/assets/js/token/authToken.js"></script>
  <script type="module" src="../app/view/assets/js/script.js"></script>
</body>

</html>