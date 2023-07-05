<ul>
  <?php 
      foreach ($courses as $course) {
        ?>
  <li>
    <a href="<?= 'curso/'.$course->slug ?>">
      <figure>
        <img src="app/view/assets/imgs/curso.png" alt="Ícone curso">
        <figcaption><?= $course->nome_curso ?></figcaption>
      </figure>
    </a>
  </li>
  <?php
      }
    ?>
</ul>