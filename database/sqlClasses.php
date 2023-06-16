<?php
  function SQL_FILTER_CLASSES($conditions = null) {
    return "SELECT t.cod_turma, m.nome_modulo, c.nome_curso, t.nome_turma, COUNT(1) AS num_senhas , s.validade FROM modulo m
    INNER JOIN turma t on m.cod_modulo = t.cod_modulo
    INNER JOIN curso c on m.cod_curso = c.cod_curso
    INNER JOIN senha s on t.cod_turma = s.cod_turma
    AND s.situacao = 'DISPONIVEL'
    AND s.validade BETWEEN '2023-01-01' AND '2023-12-31'
    AND c.nome_curso = 'BALLET'
    WHERE t.situacao = 'ABERTA'
    {$conditions}
    GROUP BY t.cod_turma
    ORDER BY num_senhas ASC
  ";
  }