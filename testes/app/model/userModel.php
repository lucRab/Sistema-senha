<?php
namespace App\Model;

class UserModel {
    private $nome;


    public function createUser() {

        include('../../conexao.php');
        $nome = "nome";

        $insert = $conexao->prepare("INSERT INTO aluno(nome_aluno) VALUES(:nome)");
        $insert->execute([ 'nome' => $nome ]);

    }
    public function getUser(){}

    public function updateUser() {

        include('../../conexao.php');
        $nome = "nome";

        $update = $conexao->prepare("UPDATE aluno SET nome_aluno = :nome WHERE cod_aluno = :id");
        $update->execute(['nome' => $nome, 'id' => 5]);
    }
}

$teste = new UserModel;
$teste->updateUser();