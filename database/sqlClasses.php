<?php
  /* 
    Retorna as turmas em ordem:
    - Com senhas disponiveis
    - De 2023
    - Turmas abertas
    - Condições de filtragem (idade e turno)
    - Retorna a primeira turma com o menor número de senhas
  */
  function SQL_FILTER_CLASSES($courseName, $conditions = null) {
    return "SELECT t.cod_turma, m.nome_modulo, c.nome_curso, t.nome_turma, COUNT(s.cod_turma) AS num_senhas , s.validade, t.turno, d.nome_dia FROM modulo m
    INNER JOIN turma t on m.cod_modulo = t.cod_modulo
    INNER JOIN curso c on m.cod_curso = c.cod_curso
    INNER JOIN senha s on t.cod_turma = s.cod_turma
    INNER JOIN dia d on t.dias_de_aula = d.id_dia
    AND s.situacao = 'DISPONIVEL'
    AND s.validade BETWEEN '2023-01-01' AND '2023-12-31'
    AND c.nome_curso = '{$courseName}'
    WHERE t.situacao = 'ABERTA'
    AND t.cod_periodo_letivo = (SELECT max(t.cod_periodo_letivo) from turma)
    {$conditions}
    GROUP BY t.cod_turma
    ORDER BY num_senhas ASC
    LIMIT 1
  ";
  }

  function SQL_AVAILABLE_COURSE_DAYS($condition = null) {
    return "SELECT DISTINCT d.nome_dia {$condition} FROM modulo m 
    INNER JOIN turma t on m.cod_modulo = t.cod_modulo 
    INNER JOIN curso c on m.cod_curso = c.cod_curso 
    INNER JOIN senha s on t.cod_turma = s.cod_turma 
    INNER JOIN dia d on t.dias_de_aula = d.id_dia 
    AND s.situacao = 'DISPONIVEL' 
    AND s.validade BETWEEN '2023-01-01' AND '2023-12-31' 
    AND c.nome_curso = :course 
    AND :idade BETWEEN idade_minima AND idade_maxima
    AND t.situacao = 'ABERTA'
    WHERE t.cod_periodo_letivo = (SELECT max(t.cod_periodo_letivo) from turma)
    ";
  }

  function SQL_AVAILABLE_SHIFT_DAYS() {
    return "SELECT DISTINCT t.turno FROM modulo m 
    INNER JOIN turma t on m.cod_modulo = t.cod_modulo 
    INNER JOIN curso c on m.cod_curso = c.cod_curso 
    INNER JOIN senha s on t.cod_turma = s.cod_turma
    AND s.situacao = 'DISPONIVEL' 
    AND s.validade BETWEEN '2023-01-01' AND '2023-12-31' 
    AND c.nome_curso = :course
    AND t.dias_de_aula = (SELECT dia.id_dia FROM dia WHERE dia.nome_dia = :dayName)
    AND :idade BETWEEN idade_minima AND idade_maxima
    WHERE t.situacao = 'ABERTA'
    AND t.cod_periodo_letivo = (SELECT max(t.cod_periodo_letivo) from turma)
    ";
  }
  
  function SQL_CREATE_USER() {
    return "INSERT INTO aluno(
    nome_aluno, data_nascimento, cpf, senha_login)               
    VALUES(:nome_aluno, :data_nascimento, :cpf, :senha_login)";
  }

  function SQL_GET_USER() {
    return "SELECT * FROM aluno Where cod_aluno = :id";
  }

  function SQL_UPDATE_USER() {
    return "UPDATE aluno SET nome_aluno = :nome, 
    data_nascimento = :data_nascimento, nome_pai = :nome_pai, nome_mae = :nome_mae, sexo = :sexo,
    cpf = :cpf, telefone_celular = :telefone, email = :email, endereco = :rua,
    numero_endereco = :numero_casa, responsavel_cpf = :responsavel_cpf WHERE cod_aluno = :id";
  }

  
  function SQL_UPDATE_AGE_USER() {
    return "UPDATE aluno SET data_nascimento = :data_nascimento WHERE cod_aluno = :id";
  }

  function SQL_UPDATE_PASSWORD_USER() {
    return "UPDATE senha SET cod_aluno = :cod_aluno, data_atualizado = :data_atualizado, situacao = :situacao WHERE cod_senha = :cod_senha";
  }

  function SQL_GET_USER_PASSWORDS() {
    return "SELECT cod_senha FROM `senha` WHERE data_atualizado = :data_hoje AND cod_aluno = :cod_aluno";
  }

  function SQL_SELECT_COURSES(){
    return "SELECT * FROM curso";
  }

  function SQL_SELECT_COURSE(){
    return "SELECT * FROM curso WHERE slug = :nome_curso";
  }

  function SQL_SELECT_PASSWORDS(){
    return "SELECT * FROM senha WHERE cod_aluno = :cod_aluno";
  }

  function SQL_DELETE_PASSWORD() {
    return "UPDATE senha SET cod_aluno = null, situacao = 'DISPONIVEL' WHERE cod_aluno = :cod_aluno";
  }