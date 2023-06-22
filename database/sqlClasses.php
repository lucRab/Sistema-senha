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
    return "SELECT t.cod_turma, m.nome_modulo, c.nome_curso, t.nome_turma, COUNT(s.cod_turma) AS num_senhas , s.validade FROM modulo m
    INNER JOIN turma t on m.cod_modulo = t.cod_modulo
    INNER JOIN curso c on m.cod_curso = c.cod_curso
    INNER JOIN senha s on t.cod_turma = s.cod_turma
    AND s.situacao = 'DISPONIVEL'
    AND s.validade BETWEEN '2023-01-01' AND '2023-12-31'
    AND c.nome_curso = '{$courseName}'
    WHERE t.situacao = 'ABERTA'
    {$conditions}
    GROUP BY t.cod_turma
    ORDER BY num_senhas ASC
    LIMIT 1
  ";
  }
  
  function SQL_CREATE_USER() {
    return "INSERT INTO aluno(
    nome_aluno, data_nascimento, nome_pai, nome_mae, sexo, cpf, telefone_celular, email,
    endereco, numero_endereco, responsavel_cpf)               
    VALUES( :nome_aluno, :data_nascimento, :nome_pai, :nome_mae,
    :sexo, :cpf, :telefone_celular, :email, :endereco, :numero_endereco, :responsavel_cpf)";
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

  function SQL_SELECT_COURSES(){
    return "SELECT * FROM curso";
  }