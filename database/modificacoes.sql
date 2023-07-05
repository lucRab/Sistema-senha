-- ALTERAÇÕES NO BANCO - NOMES DOS DIAS

INSERT INTO `dia`(`nome_dia`) VALUES
('SEGUNDA E QUARTA'),
('SEGUNDA E TERÇA'),
('TERÇA E SEXTA'),
('TERÇA E QUINTA'),
('SEGUNDA, QUARTA E SEXTA'),
('SEGUNDA E QUINTA'),
('QUARTA E SEXTA'),
('SÁBADO'),
('SEXTA-FEIRA'),
('SEGUNDA A SEXTA'),
('TERÇA-FEIRA'),
('SEGUNDA-FEIRA'),
('QUARTA-FEIRA'),
('QUINTA-FEIRA'),
('QUINTA E SEXTA'),
('TERÇA E QUARTA'),
('SEXTA E SÁBADO'),
('SEGUNDA, QUINTA, SEXTA E SÁBADO'),
('DOMINGO');

-- ALTERAÇÕES NO BANCO - MODIFICANDO NOMES ESCRITOS ERRADOS

UPDATE turma
SET dias_de_aula = CASE
  WHEN dias_de_aula IN (
    'SEGUNDA E QUARTA', 'SENGUDA E QUARTA', 'SEUNDA E QUARTA', ' SEGUNDA E QUARTA', 'SEGUINDA E QUARTA', 'SEGUNDA E QUANTA', 'SEGUNDO E QUARTA', 'SEGUNDA/QUARTA', 'SEGUNDA E QUARTA FEIRA', 'SEGUNDA -QUARTA ', 'SEG E QUA', 'SEGUNDA E QUARTA-FEIRA'
  ) THEN (SELECT id_dia FROM dia WHERE nome_dia = 'SEGUNDA E QUARTA')
  WHEN dias_de_aula IN (
    'TERÇA E QUINTA', ' TERÇA E QUINTA', 'TERÇAS E QUINTAS', 'TERÇA-QUINTA', 'TERÇA/QUINTA', 'TERÇA E QUNTA', 'TERÇA E QUINTA FEIRA', 'TERÇA-QUINTA', 'TERÇAS E QUITAS'
  ) THEN (SELECT id_dia FROM dia WHERE nome_dia = 'TERÇA E QUINTA')
  WHEN dias_de_aula IN (
    'SEGUNDA, QUARTA E SEXTA', 'SEGUNDA,QUARTA E SEXTA', 'SEGUNDA /QUATA E SEXTA', 'SEGUNDA /QUATA E SEXTA', ' SEGUNDA QUARTA E SEXTA', 'SEGUNDA QUARTA E SEXTA '
  ) THEN (SELECT id_dia FROM dia WHERE nome_dia = 'SEGUNDA, QUARTA E SEXTA')
  WHEN dias_de_aula IN ('SÁBADO', 'SÁBADOS') THEN (SELECT id_dia FROM dia WHERE nome_dia = 'SÁBADO')
  WHEN dias_de_aula IN ('QUARTA E SEXTA', 'QUARTA/SEXTA', 'QUARTA E SEXTA FEIRA', 'QUARTAS E SEXTAS') THEN (SELECT id_dia FROM dia WHERE nome_dia = 'QUARTA E SEXTA')
  WHEN dias_de_aula IN ('SEXTA', 'SEXTA-FEIRA', 'SEXTA FEIRA') THEN (SELECT id_dia FROM dia WHERE nome_dia = 'SEXTA-FEIRA')
  WHEN dias_de_aula = 'SEGUNDA E QUINTA' THEN (SELECT id_dia FROM dia WHERE nome_dia = 'SEGUNDA E QUINTA')
  WHEN dias_de_aula IN ('SEGUNDA, TERÇA, QUARTA, QUINTA E SEXTA', 'SEG, TER, QUA, QUI E SEX', 'SEGUNDA A SEXTA') THEN (SELECT id_dia FROM dia WHERE nome_dia = 'SEGUNDA A SEXTA')
  WHEN dias_de_aula IN ('TERÇA-FEIRA', 'TERÇA', 'TERÇAS', 'TERÇA FEIRA', 'TREÇA') THEN (SELECT id_dia FROM dia WHERE nome_dia = 'TERÇA-FEIRA')
  WHEN dias_de_aula IN ('QUARTA-FEIRA', 'QUARTA', 'QUART-AFEIRA', 'QUARTAS', '') THEN (SELECT id_dia FROM dia WHERE nome_dia = 'QUARTA-FEIRA')
  WHEN dias_de_aula IN ('QUINTA-FEIRA', 'QUINTA', ' QUINTA', 'QUINTAS', 'QUINTA FEIRA') THEN (SELECT id_dia FROM dia WHERE nome_dia = 'QUINTA-FEIRA')
  WHEN dias_de_aula IN ('SEGUNDA-FEIRA', 'SEGUNDA', 'SEGUNDAS', 'SEGUNDA FEIRA') THEN (SELECT id_dia FROM dia WHERE nome_dia = 'SEGUNDA-FEIRA')
  WHEN dias_de_aula = 'TERÇA E QUARTA' THEN (SELECT id_dia FROM dia WHERE nome_dia = 'TERÇA E QUARTA')
  WHEN dias_de_aula = 'QUINTA E SEXTA' THEN (SELECT id_dia FROM dia WHERE nome_dia = 'QUINTA E SEXTA')
  WHEN dias_de_aula = 'SEXTA E SÁBADO' THEN (SELECT id_dia FROM dia WHERE nome_dia = 'SEXTA E SÁBADO')
  WHEN dias_de_aula = 'TERÇA E SEXTA' THEN (SELECT id_diaFROM dia WHERE nome_dia = 'TERÇA E SEXTA')
  WHEN dias_de_aula REGEXP '^SEGUNDA\\D+QUARTA\\D+SEXTA$' THEN (SELECT id_dia FROM dia WHERE nome_dia = 'SEGUNDA, QUARTA E SEXTA')
  WHEN dias_de_aula = 'DOMINGO' THEN (SELECT id_dia FROM dia WHERE nome_dia = 'DOMINGO')
END;

-- ALTERAÇÕES NO BANCO - SLUG COMO IDENTIFICADOR DO CURSO

ALTER TABLE curso ADD COLUMN slug varchar(80);

UPDATE curso
SET slug = LOWER(REGEXP_REPLACE(REGEXP_REPLACE(curso.nome_curso, '-', '_'), '[^a-zA-ZÀ-ÖØ-öø-ÿ-ç_]+', '_'));

-- ALTERAÇÕES NO BANCO - ADICIONANDO SENHA DO USUARIO

ALTER TABLE aluno
ADD senha_aluno VARCHAR(200) DEFAULT '123456',
MODIFY COLUMN data_atualizado TIMESTAMP NOT NULL DEFAULT NOW();

-- ALTERAÇÕES NO BANCO - RETIRANDO ACENTOS DO SLUG

UPDATE curso
SET slug = REPLACE(slug, 'Š', 'S')
    REPLACE(slug, 'š', 's')
    REPLACE(slug, 'Ð', 'Dj')
    REPLACE(slug, 'Ž', 'Z')
    REPLACE(slug, 'ž', 'z')
    REPLACE(slug, 'À', 'A')
    REPLACE(slug, 'Á', 'A')
    REPLACE(slug, 'Â', 'A')
    REPLACE(slug, 'Ã', 'A')
    REPLACE(slug, 'Ä', 'A')
    REPLACE(slug, 'Å', 'A')
    REPLACE(slug, 'Æ', 'A')
    REPLACE(slug, 'Ç', 'C')
    REPLACE(slug, 'È', 'E')
    REPLACE(slug, 'É', 'E')
    REPLACE(slug, 'Ê', 'E')
    REPLACE(slug, 'Ë', 'E')
    REPLACE(slug, 'Ì', 'I')
    REPLACE(slug, 'Í', 'I')
    REPLACE(slug, 'Î', 'I')
    REPLACE(slug, 'Ï', 'I')
    REPLACE(slug, 'Ñ', 'N')
    REPLACE(slug, 'Ò', 'O')
    REPLACE(slug, 'Ó', 'O')
    REPLACE(slug, 'Ô', 'O')
    REPLACE(slug, 'Õ', 'O')
    REPLACE(slug, 'Ö', 'O')
    REPLACE(slug, 'Ø', 'O')
    REPLACE(slug, 'Ù', 'U')
    REPLACE(slug, 'Ú', 'U')
    REPLACE(slug, 'Û', 'U')
    REPLACE(slug, 'Ü', 'U')
    REPLACE(slug, 'Ý', 'Y')
    REPLACE(slug, 'Þ', 'B')
    REPLACE(slug, 'ß', 'Ss')
    REPLACE(slug, 'à', 'a')
    REPLACE(slug, 'á', 'a')
    REPLACE(slug, 'â', 'a')
    REPLACE(slug, 'ã', 'a')
    REPLACE(slug, 'ä', 'a')
    REPLACE(slug, 'å', 'a')
    REPLACE(slug, 'æ', 'a')
    REPLACE(slug, 'ç', 'c')
    REPLACE(slug, 'è', 'e')
    REPLACE(slug, 'é', 'e')
    REPLACE(slug, 'ê', 'e')
    REPLACE(slug, 'ë', 'e')
    REPLACE(slug, 'ì', 'i')
    REPLACE(slug, 'í', 'i')
    REPLACE(slug, 'î', 'i')
    REPLACE(slug, 'ï', 'i')
    REPLACE(slug, 'ð', 'o')
    REPLACE(slug, 'ñ', 'n')
    REPLACE(slug, 'ò', 'o')
    REPLACE(slug, 'ó', 'o')
    REPLACE(slug, 'ô', 'o')
    REPLACE(slug, 'õ', 'o')
    REPLACE(slug, 'ö', 'o')
    REPLACE(slug, 'ø', 'o')
    REPLACE(slug, 'ù', 'u')
    REPLACE(slug, 'ú', 'u')
    REPLACE(slug, 'û', 'u')
    REPLACE(slug, 'ý', 'y')
    REPLACE(slug, 'ý', 'y')
    REPLACE(slug, 'þ', 'b')
    REPLACE(slug, 'ÿ', 'y')
    REPLACE(slug, 'ƒ', 'f')
    REPLACE(slug, 'ě', 'e')
    REPLACE(slug, 'ž', 'z')
    REPLACE(slug, 'š', 's')
    REPLACE(slug, 'č', 'c')
    REPLACE(slug, 'ř', 'r')
    REPLACE(slug, 'ď', 'd')
    REPLACE(slug, 'ť', 't')
    REPLACE(slug, 'ň', 'n')
    REPLACE(slug, 'ů', 'u')
    REPLACE(slug, 'Ě', 'E')
    REPLACE(slug, 'Ž', 'Z')
    REPLACE(slug, 'Š', 'S')
    REPLACE(slug, 'Č', 'C')
    REPLACE(slug, 'Ř', 'R')
    REPLACE(slug, 'Ď', 'D')
    REPLACE(slug, 'Ť', 'T')
    REPLACE(slug, 'Ň', 'N')
    REPLACE(slug, 'Ů', 'U');