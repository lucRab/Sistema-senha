<div>
  <ul>
    <?php if ($dataCourse[0]->informacoes_curso) { ?>
    <li>
      <p>Informações</p>
      <p><?= $dataCourse[0]->informacoes_curso ?></p>
    </li>
    <?php } ?>

    <?php if ($dataCourse[0]->ementa) { ?>
    <li>
      <p>Ementa</p>
      <p><?= $dataCourse[0]->ementa ?></p>
    </li>
    <?php } ?>

    <?php if ($dataCourse[0]->objetivo) { ?>
    <li>
      <p>Objetivo</p>
      <p><?= $dataCourse[0]->objetivo ?></p>
    </li>
    <?php } ?>

    <?php if ($dataCourse[0]->conteudo_programatico) { ?>
    <li>
      <p>Conteúdo Programático</p>
      <p><?= $dataCourse[0]->conteudo_programatico ?></p>
    </li>
    <?php } ?>

    <?php if ($dataCourse[0]->metodologia) { ?>
    <li>
      <p>Metodologia</p>
      <p><?= $dataCourse[0]->metodologia ?></p>
    </li>
    <?php } ?>
  </ul>
</div>