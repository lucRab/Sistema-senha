<?php 

var_dump($allPasswords);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
  table td,
  table th {
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
  }

  .card {
    border-radius: .5rem;
  }

  .mask-custom {
    border-radius: 2em;
    backdrop-filter: blur(25px);
    border: 2px solid rgba(255, 255, 255, 0.05);
    background-clip: padding-box;
    box-shadow: 10px 10px 10px rgba(46, 54, 68, 0.03);
  }
  </style>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
  <h1>senhas</h1>

  <section class="intro">
    <div class="bg-image">
      <div class="mask d-flex align-items-center">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-12">
              <div class="card shadow-2-strong">
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-borderless mb-0">
                      <thead>
                        <tr>
                          <th scope="col">
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                            </div>
                          </th>
                          <th scope="col">AUTENTICAÇÃO</th>
                          <th scope="col">VALIDADE</th>
                          <th scope="col">REMOVER</th>
                        </tr>
                      </thead>
                      <tbody class="content">

                        <?php 
          foreach ($allPasswords as $password) {
            ?>
                        <tr>
                          <th scope="row">
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault2" />
                            </div>
                          </th>
                          <td><?= $password->autenticacao ?></td>
                          <td><?= $password->validade ?></td>
                          <td>
                            <button id=<?= $password->cod_senha ?> type="button" class="btn btn-danger btn-sm px-3">
                              <i class="fas fa-times"></i>
                            </button>
                          </td>
                        </tr>
                        <?php
                }
              ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <script src="app/view/assets/js/deletePassword.js"></script>
</body>

</html>