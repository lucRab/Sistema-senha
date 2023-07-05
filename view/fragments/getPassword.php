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