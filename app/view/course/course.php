<?php 

  function teste($element) {
    return $element->nome_dia;
  }
  var_dump(array_map("teste", $days));

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <h1>curso</h1>
  <button id="btn">Pegar senha</button>

  <select name="days" id="days">
    <?php 
      foreach ($days as $day) {
        ?>
    <option value="<?= $day->nome_dia ?>"><?= $day->nome_dia ?></option>
    <?php
      }
    ?>
  </select>

  <select name="shifts" id="shifts">
    <?php 
      foreach ($shifts as $shift) {
        ?>
    <option value="<?= $shift->turno ?>"><?= $shift->turno ?></option>
    <?php
      }
    ?>
  </select>

  <script type="module" src="../app/view/assets/js/script.js"></script>
</body>

</html>