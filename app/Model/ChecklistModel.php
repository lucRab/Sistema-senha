<?php
namespace App\model;
use Core\conexao\Conexao;
use PDO;
require_once "./core/Database.php";
/**
 * Class model resposavel pelos dados dos checklists
 * @author Lucas Rabelp <lucasrabelo@gmail.com>
 * @version ${3:3.5.0
 */
class ChecklistModel {
    /**
     * Função responsavel para criar o checklist
     *
     * @param [stdclass] $data
     * @return int
     */
    public static function createChecklist($data) {
    //Código do método
        //Executa um metodo da classe Conexao
        $conexao = Conexao::conectar();
        //Verifica se a conexão retorna um obejo mysqli
        if(gettype($conexao) == "object") {
            //parametros para execução da query
            $param = ['nome' => $data->nome, 'status' => false,
            'descricao' => $data->descricao, 'idusuario' => $data->id];
            //SQl para inserir no banco de dados
            $insert = $conexao->prepare("INSERT INTO checklist (name, status, descricao, idusuario) 
            VALUES (:nome, :status, :descricao, :idusuario)");
            try {
                //Tenta executar o sql;
                $insert->execute($param);
               //Captura o id gerado no insert      
                $id = $conexao->lastInsertId();
                return $id;
            }catch(\PDOException $e) {
                //retorna o erro
                return $e->getMessage();
            }
        }else {
            //retorna a conexao como erro de conexao 
            return $conexao;
        }
    }
    /**
     * Função para fazer o updade no checklist
     *
     * @param [stdclass] $data
     * @return object
     */
    public static function updateChecklist($data) {
    //Código do método
        //Executa um metodo da classe Conexao
        $conexao = Conexao::conectar();
        //Verifica se a conexão retorna um obejo mysqli
        if(gettype($conexao) == "object") {
            //parametros para execução da query
            $param = ['nome' => $data->nome, 'status' => $data->status,
            'descricao' => $data->descricao, 'id' => $data->id];
            //SQl para updade no banco de dados
            $update = $conexao->prepare("UPDATE checklist SET name=:nome, descricao=:descricao,status=:status  WHERE idchecklist=:id");
            try {
                //Tenta executar o sql;
                $update->execute($param);
                return $update;
            }catch(\PDOException $e) {
                //retorna o erro
                return $e->getMessage();
            }
        }else {
            //retorna a conexao como erro de conexao 
            return $conexao;
        }
    }
    /**
     * Função para deletar o chcklist
     *
     * @param [stdclass] $data
     * @return object
     */
    public static function  deleteChecklist($data) {
    //Código do método
        //Executa um metodo da classe Conexao
        $conexao = Conexao::conectar();
        //Verifica se a conexão retorna um obejo mysqli
        if(gettype($conexao) == "object") {
            //parametros para execução da query
            $param = [ 'id' => $data->id];
            //SQl para delete no banco de dados
            $delete = $conexao->prepare("DELETE FROM checklist WHERE idchecklist = :id");
            try {
                //Tenta executar o sql;
                $delete->execute($param);
                return $delete;
            }catch(\PDOException $e) {
                //retorna o erro
                return $e->getMessage();
            }
        }else {
            //retorna a conexao como erro de conexao 
            return $conexao;
        }
    }
    /**
     * Função para da o select do checklist e os item
     *
     * @param [stdclass] $data
     * @return object
     */
    public static function getAll($data) {
    //Código do método
        //Executa um metodo da classe Conexao
        $conexao = Conexao::conectar();
        //Verifica se a conexão retorna um obejo mysqli
        if(gettype($conexao) == "object") {
            //parametros para execução da query
            $param = [ 'idchecklist' => $data->id];
            //SQl para select no banco de dados
            $select = $conexao->prepare("SELECT * FROM checklist c
            INNER JOIN item i on c.idchecklist = i.idchecklist
            WHERE c.idchecklist = :idchecklist");
             try {
                //Tenta executar o sql;
                $select->execute($param);
                return $select;
            }catch(\PDOException $e) {
                //retorna o erro
                return $e->getMessage();
            }
        }else {
            //retorna a conexao como erro de conexao 
            return $conexao;
        }
    }
    /**
     * Função para criar um item no checklist
     *
     * @param [stdclass] $data
     * @return object
     */
    public static function setItem($data) {
    //Código do método
        //Executa um metodo da classe Conexao
        $conexao = Conexao::conectar();
        //Verifica se a conexão retorna um obejo mysqli
        if(gettype($conexao) == "object") {
            //parametros para execução da query
            $param = ['nome' => $data->nome, 'status' => $data->status,
            'descricao' => $data->descricao, 'idchecklist' => $data->id];
            //SQl para inserir no banco de dados
            $insert = $conexao->prepare("INSERT INTO item (name, status, descricao, idchecklist)
            VALUES (:nome, :status, :descricao, :idchecklist)");
            try {
                //Tenta executar o sql;
                $insert->execute($param);
                return $insert;
            }catch(\PDOException $e) {
                //retorna o erro
                return $e->getMessage();
            }
        }else {
            //retorna a conexao como erro de conexao 
            return $conexao;
        }
    }
    /**
     * Função para fazer o updade do item
     *
     * @param [stdclass] $data
     * @return object
     */
    public static function updateItem($data) {
    //Código do método
        //Executa um metodo da classe Conexao
        $conexao = Conexao::conectar();
        //Verifica se a conexão retorna um obejo mysqli
        if(gettype($conexao) == "object") {
            //parametros para execução da query
            $param = ['nome' => $data->nome, 'status' => $data->status,
            'descricao' => $data->descricao, 'id' => $data->id];
            //SQl para updade no banco de dados
            $update = $conexao->prepare("UPDATE item SET name=:nome, descricao=:descricao,status=:status  WHERE iditem=:id");
            try {
                //Tenta executar o sql;
                $update->execute($param);
                return $update;
            }catch(\PDOException $e) {
                //retorna o erro
                return $e->getMessage();
            }
        }else {
            //retorna a conexao como erro de conexao 
            return $conexao;
        }
    }
    /**
     * Função para deletar o item do checklist
     *
     * @param [stdclass] $data
     * @return object
     */
    public static function deleteItem($data) {
    //Código do método
        //Executa um metodo da classe Conexao
        $conexao = Conexao::conectar();
        //Verifica se a conexão retorna um obejo mysqli
        if(gettype($conexao) == "object") {
            //parametros para execução da query
            $param = [ 'id' => $data->id];
            //SQl para delete no banco de dados
            $delete = $conexao->prepare("DELETE FROM item WHERE iditem = :id");
            try {
                //Tenta executar o sql;
                $delete->execute($param);
                return $delete;
            }catch(\PDOException $e) {
                //retorna o erro
                return $e->getMessage();
            }
        }else {
            //retorna a conexao como erro de conexao 
            return $conexao;
        }
    }
}