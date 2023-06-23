<?php
class validConnection
{
    public function __construct()
    {
    }
    /**
        Essa função serve para substituir os try/catch toda vez
        que precisar executar uma query no banco, evita repetições e fica mais legível
        Exemplo na classe: ClassesModel.class.php
     */
    public static function isValidConnection($conexao, $query, $params = null)
    {
        try {
            if (gettype($conexao)!== 'string' and get_class($conexao) === 'PDO') {
                $consulta = $conexao->prepare($query);
                $consulta->execute($params);
                return $consulta;
            } else {
                throw new \PDOException($conexao);
            }
        } catch(PDOException $e) {
            return 'ERROR: ' . $e->getMessage();
        }
    }

}