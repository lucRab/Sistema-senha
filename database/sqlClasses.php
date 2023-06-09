<?php

/*
  Retorna as turmas em ordem:
  - Com senhas disponiveis
  - De 2023
  - Turmas abertas
  - Condições de filtragem (idade e turno)
  - Retorna a primeira turma com o menor número de senhas
*/
function SQL_FILTER_CLASSES($courseName, $conditions = null)
{
    return "SELECT t.cod_turma, m.nome_modulo, c.nome_curso, t.nome_turma, COUNT(s.cod_turma) AS num_senhas , s.validade, t.turno, d.nome_dia FROM modulo m
    INNER JOIN turma t on m.cod_modulo = t.cod_modulo
    INNER JOIN curso c on m.cod_curso = c.cod_curso
    INNER JOIN senha s on t.cod_turma = s.cod_turma
    INNER JOIN dia d on t.dias_de_aula = d.id_dia
    AND s.situacao = 'DISPONIVEL'
    AND s.validade BETWEEN '2023-01-01' AND '2023-12-31'
    AND c.slug = '{$courseName}'
    WHERE t.situacao = 'ABERTA'
    AND t.cod_periodo_letivo = (SELECT max(t.cod_periodo_letivo) from turma)
    {$conditions}
    GROUP BY t.cod_turma
    ORDER BY num_senhas ASC
    LIMIT 1
  ";
}

function SQL_AVAILABLE_COURSE_DAYS($condition = null)
{
    return "SELECT DISTINCT d.nome_dia {$condition} FROM modulo m 
    INNER JOIN turma t on m.cod_modulo = t.cod_modulo 
    INNER JOIN curso c on m.cod_curso = c.cod_curso 
    INNER JOIN senha s on t.cod_turma = s.cod_turma 
    INNER JOIN dia d on t.dias_de_aula = d.id_dia 
    AND s.situacao = 'DISPONIVEL' 
    AND s.validade BETWEEN '2023-01-01' AND '2023-12-31' 
    AND c.slug = :course 
    AND :idade BETWEEN idade_minima AND idade_maxima
    AND t.situacao = 'ABERTA'
    WHERE t.cod_periodo_letivo = (SELECT max(t.cod_periodo_letivo) from turma)
    ";
}

function SQL_AVAILABLE_SHIFT_DAYS()
{
    return "SELECT DISTINCT t.turno FROM modulo m 
    INNER JOIN turma t on m.cod_modulo = t.cod_modulo 
    INNER JOIN curso c on m.cod_curso = c.cod_curso 
    INNER JOIN senha s on t.cod_turma = s.cod_turma
    AND s.situacao = 'DISPONIVEL' 
    AND s.validade BETWEEN '2023-01-01' AND '2023-12-31' 
    AND c.slug = :course
    AND t.dias_de_aula = (SELECT dia.id_dia FROM dia WHERE dia.nome_dia = :dayName)
    AND :idade BETWEEN idade_minima AND idade_maxima
    WHERE t.situacao = 'ABERTA'
    AND t.cod_periodo_letivo = (SELECT max(t.cod_periodo_letivo) from turma)
    ";
}

function SQL_CREATE_USER()
{
    return "INSERT INTO aluno(
    nome_aluno, data_nascimento, cpf, senha_login)               
    VALUES(:nome_aluno, :data_nascimento, :cpf, :senha_login)";
}

function SQL_GET_USER()
{
    return "SELECT * FROM aluno Where cod_aluno = :id";
}

function SQL_GET_USER_CPF()
{
    return "SELECT * FROM aluno Where cpf = :cpf";
}

function SQL_UPDATE_USER()
{
    return "UPDATE aluno SET nome_aluno = :nome, 
    data_nascimento = :data_nascimento, nome_pai = :nome_pai, nome_mae = :nome_mae, sexo = :sexo,
    cpf = :cpf, telefone_celular = :telefone, email = :email, endereco = :rua,
    numero_endereco = :numero_casa, responsavel_cpf = :responsavel_cpf WHERE cod_aluno = :id";
}

function SQL_GET_EMAIL_USER()
{
    return "SELECT email FROM aluno WHERE cpf = :cpf";
}

function SQL_UPDATE_EMAIL_USER()
{
    return "UPDATE aluno SET email = :email WHERE cod_aluno = :cod_aluno";
}

function SQL_UPDATE_PASSWORD_USER()
{
    return "UPDATE senha SET cod_aluno = :cod_aluno, data_atualizado = :data_atualizado, situacao = :situacao WHERE cod_senha = :cod_senha";
}

function SQL_UPDATE_NEW_PASSWORD_USER()
{
    return "UPDATE aluno SET senha_login = :senha_login, data_atualizado = :data_atualizado WHERE cpf = :cpf AND email = :email";
}

function SQL_GET_USER_PASSWORDS()
{
    return "SELECT cod_senha FROM `senha` WHERE data_atualizado = :data_hoje AND cod_aluno = :cod_aluno";
}

function SQL_SELECT_COURSES($condition = null)
{
    return "SELECT DISTINCT c.nome_curso, c.slug FROM modulo m 
    INNER JOIN turma t on m.cod_modulo = t.cod_modulo 
    INNER JOIN curso c on m.cod_curso = c.cod_curso 
    INNER JOIN senha s on t.cod_turma = s.cod_turma 
    AND s.situacao = 'DISPONIVEL' 
    AND s.validade BETWEEN '2023-01-01' AND '2023-12-31' 
    AND t.situacao = 'ABERTA'
    {$condition}
    WHERE t.cod_periodo_letivo = (SELECT max(t.cod_periodo_letivo) from turma);";
}

function SQL_SELECT_COURSE()
{
    return "SELECT c.*, 
    (SELECT COUNT(s.cod_senha)
    FROM modulo m 
        INNER JOIN turma t on m.cod_modulo = t.cod_modulo 
        INNER JOIN senha s on t.cod_turma = s.cod_turma
        AND s.situacao = 'DISPONIVEL' 
        AND s.validade BETWEEN '2023-01-01' AND '2023-12-31' 
        AND :idade BETWEEN idade_minima AND idade_maxima
        WHERE t.situacao = 'ABERTA'
        AND t.cod_periodo_letivo = (SELECT max(t.cod_periodo_letivo) from turma)
        AND m.cod_curso = c.cod_curso
    ) as total_senhas
FROM curso c 
WHERE c.slug = :nome_curso
HAVING total_senhas > 0";
}

function SQL_SELECT_PASSWORDS()
{
    return "SELECT s.autenticacao, DATE_FORMAT(s.validade, '%d/%m/%Y') as validade, s.cod_senha FROM senha s WHERE cod_aluno = :cod_aluno";
}

function SQL_SELECT_PASSWORD()
{
    return "SELECT c.nome_curso, t.nome_turma, (SELECT dia.nome_dia FROM dia WHERE dia.id_dia = t.dias_de_aula) as dias_de_aula, DATE_FORMAT(t.data_inicio, '%d/%m/%Y') as data_inicio, DATE_FORMAT(t.data_termino, '%d/%m/%Y') as data_termino, t.hora_inicio, t.hora_termino, t.turno, t.idade_minima, t.idade_maxima, s.autenticacao, DATE_FORMAT(s.validade, '%d/%m/%Y') as validade FROM modulo m 
    INNER JOIN turma t on m.cod_modulo = t.cod_modulo 
    INNER JOIN senha s on t.cod_turma = s.cod_turma 
    INNER JOIN curso c on m.cod_curso = c.cod_curso 
   	WHERE s.autenticacao = :autenticacao
    AND s.cod_aluno = :cod_aluno
";
}

function SQL_DELETE_PASSWORD()
{
    return "UPDATE senha SET cod_aluno = null, situacao = 'DISPONIVEL' WHERE cod_aluno = :cod_aluno AND cod_senha = :cod_senha";
}
