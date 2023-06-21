<?php
namespace app\model;
class PasswordModel {

    public function passwordOpen() {

    }
    public function selectPassword() {

    }
    public function userPassword() {

    }
    public function alterarPassword($conexao,$data) {

        $params = array(
            'cod_aluno' => $data->cod_aluno, 'situacao' => $data->situacao, 'cod_senha' => $data->cod_senha
        );
      
        $query ="UPDATE senha SET cod_aluno = :cod_aluno,situacao = :situacao WHERE cod_senha = :cod_senha";
        $con = \validConnection::isValidConnection($conexao, $query, $params);
        return $con;
    }
    
    public function getUser() {

    }
}

