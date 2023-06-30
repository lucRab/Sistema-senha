<?php 

  var_dump($_SESSION);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="app/view/assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="app/view/assets/css/all.min.css">
  <link rel="stylesheet" href="app/view/assets/css/templatemo-style.css">
</head>

<body>
  <!-- Page Loader -->
  <div id="loader-wrapper">
    <div id="loader"></div>

    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>

  </div>
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <a class="navbar-brand gradient" href="index.html">
        <i class="fas fa-film mr-2"></i>
        Cidade do Saber
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link nav-link-1 active" aria-current="page" href="/">Cidade do Saber</a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav-link-2" href="videos.html">Prefeitura</a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav-link-3" href="historico">Histórico de Senhas</a>
          </li>

        </ul>
      </div>
    </div>
  </nav>

  <div class="tm-hero d-flex justify-content-center align-items-center" data-parallax="scroll" data-image-src="app/view/assets/imgs/hero.jpg">
    <form class="d-flex tm-search-form">
      <input class="form-control tm-search-input" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success tm-search-btn" type="submit">
        <i class="fas fa-search"></i>
      </button>
    </form>
  </div>

  <div class="container-fluid tm-container-content tm-mt-60">
    <div class="row mb-4">
      <h2 class="col-6 tm-text-primary">
        Turmas Abertas
      </h2>
    </div>
    <div class="row tm-mb-90 tm-gallery">
      <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
        <figure class="effect-ming tm-video-item">
          <img src="app/view/assets/imgs/img-03.png" alt="Image" class="img-fluid">
          <figcaption class="d-flex align-items-center justify-content-center">
            <h2>Inglês</h2>
            <a href="curso/ingles">View more</a>
          </figcaption>
        </figure>
        <div class="d-flex justify-content-between tm-text-gray">
          <span class="tm-text-gray-light">18 Oct 2020</span>
          <span>9,906 views</span>
        </div>
      </div>
      <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
        <figure class="effect-ming tm-video-item">
          <img src="app/view/assets/imgs/img-04.jpg" alt="Image" class="img-fluid">
          <figcaption class="d-flex align-items-center justify-content-center">
            <h2>Canto</h2>
            <a href="curso/canto">View more</a>
          </figcaption>
        </figure>
        <div class="d-flex justify-content-between tm-text-gray">
          <span class="tm-text-gray-light">14 Oct 2020</span>
          <span>16,100 views</span>
        </div>
      </div>
      <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
        <figure class="effect-ming tm-video-item">
          <img src="app/view/assets/imgs/img-05.jpg" alt="Image" class="img-fluid">
          <figcaption class="d-flex align-items-center justify-content-center">
            <h2>Teclado</h2>
            <a href="curso/teclado">View more</a>
          </figcaption>
        </figure>
        <div class="d-flex justify-content-between tm-text-gray">
          <span class="tm-text-gray-light">12 Oct 2020</span>
          <span>12,460 views</span>
        </div>
      </div>
      <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
        <figure class="effect-ming tm-video-item">
          <img src="app/view/assets/imgs/img-06.jpg" alt="Image" class="img-fluid">
          <figcaption class="d-flex align-items-center justify-content-center">
            <h2>Ballet</h2>
            <a href="curso/ballet">View more</a>
          </figcaption>
        </figure>
        <div class="d-flex justify-content-between tm-text-gray">
          <span class="tm-text-gray-light">10 Oct 2020</span>
          <span>11,402 views</span>
        </div>
      </div>

      <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
        <figure class="effect-ming tm-video-item">
          <img src="app/view/assets/imgs/img-01.jpg" alt="Image" class="img-fluid">
          <figcaption class="d-flex align-items-center justify-content-center">
            <h2>Bateria</h2>
            <a href="curso/bateria">View more</a>
          </figcaption>
        </figure>
        <div class="d-flex justify-content-between tm-text-gray">
          <span class="tm-text-gray-light">24 Sep 2020</span>
          <span>16,008 views</span>
        </div>
      </div>
      <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
        <figure class="effect-ming tm-video-item">
          <img src="app/view/assets/imgs/img-02.jpg" alt="Image" class="img-fluid">
          <figcaption class="d-flex align-items-center justify-content-center">
            <h2>Natação</h2>
            <a href="curso/natação_escolinha">View more</a>
          </figcaption>
        </figure>
        <div class="d-flex justify-content-between tm-text-gray">
          <span class="tm-text-gray-light">20 Sep 2020</span>
          <span>12,860 views</span>
        </div>
      </div>
      <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
        <figure class="effect-ming tm-video-item">
          <img src="app/view/assets/imgs/img-07.jpg" alt="Image" class="img-fluid">
          <figcaption class="d-flex align-items-center justify-content-center">
            <h2>Robótica (lego)</h2>
            <a href="curso/robotica_lego_">View more</a>
          </figcaption>
        </figure>
        <div class="d-flex justify-content-between tm-text-gray">
          <span class="tm-text-gray-light">16 Sep 2020</span>
          <span>10,900 views</span>
        </div>
      </div>
      <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
        <figure class="effect-ming tm-video-item">
          <img src="app/view/assets/imgs/img-08.jpg" alt="Image" class="img-fluid">
          <figcaption class="d-flex align-items-center justify-content-center">
            <h2>Pilates</h2>
            <a href="curso/pilates">View more</a>
          </figcaption>
        </figure>
        <div class="d-flex justify-content-between tm-text-gray">
          <span class="tm-text-gray-light">12 Sep 2020</span>
          <span>11,300 views</span>
        </div>
      </div>


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
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
      <script type="module" src="app/view/assets/js/loadingLogin.js"></script>
      <script src="app/view/assets/js/plugins/plugins.js"></script>
</body>

</html>