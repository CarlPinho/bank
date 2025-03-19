<?php

require_once '../config/database.php';
require_once '../models/Banco.php';

class BancoController
{
    private $banco;

    public function __construct($pdo)
    {
        $this->banco = new Banco($pdo);
    }

    // Cadastro de banco
    public function cadastrar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome_banco = $_POST['nome_banco'];
            $codigo_banco = $_POST['codigo_banco'];

            if ($this->banco->cadastrarBanco($nome_banco, $codigo_banco)) {
                header("Location: ../templates/consulta_bancos.php?success=Banco cadastrado com sucesso!");
                exit;
            } else {
                echo "Erro ao cadastrar banco.";
            }
        }
    }

    // Consulta de bancos
    public function listar()
    {
        return $this->banco->listarBancos();
    }

    // Exclusão de banco
    public function excluir()
    {
        if (isset($_GET['id'])) {
            $id_banco = $_GET['id'];
            if ($this->banco->excluirBanco($id_banco)) {
                header("Location: ../templates/consulta_bancos.php?success=Banco excluído com sucesso!");
                exit;
            } else {
                echo "Erro ao excluir banco.";
            }
        }
    }
}

$controller = new BancoController($pdo);

// Roteamento básico para chamadas
if (isset($_GET['action']) && $_GET['action'] === 'cadastrar') {
    $controller->cadastrar();
} elseif (isset($_GET['action']) && $_GET['action'] === 'excluir') {
    $controller->excluir();
}
