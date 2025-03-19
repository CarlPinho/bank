<?php

require_once '../config/database.php';
require_once '../models/Conta.php';

class ContaController
{
    private $conta;

    public function __construct($pdo)
    {
        $this->conta = new Conta($pdo);
    }

    public function cadastrar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_cliente = $_POST['id_cliente'];
            $id_banco = $_POST['id_banco'];
            $tipo_conta = $_POST['tipo_conta'];
            $saldo = $_POST['saldo'];

            if ($this->conta->cadastrarConta($id_cliente, $id_banco, $tipo_conta, $saldo)) {
                header("Location: ../templates/consulta_contas.php?success=Conta cadastrada com sucesso!");
                exit;
            } else {
                echo "Erro ao cadastrar conta.";
            }
        }
    }

    public function listar()
    {
        return $this->conta->listarContas();
    }

    public function excluir()
    {
        if (isset($_GET['id'])) {
            $id_conta = $_GET['id'];

            if ($this->conta->excluirConta($id_conta)) {
                header("Location: ../templates/consulta_contas.php?success=Conta excluída com sucesso!");
                exit;
            } else {
                echo "Erro ao excluir conta.";
            }
        }
    }
}

$controller = new ContaController($pdo);

if (isset($_GET['action']) && $_GET['action'] === 'cadastrar') {
    $controller->cadastrar();
} elseif (isset($_GET['action']) && $_GET['action'] === 'excluir') {
    $controller->excluir();
}
