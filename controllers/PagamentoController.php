<?php

require_once '../config/database.php';
require_once '../models/Pagamento.php';

class PagamentoController
{
    private $pagamento;

    public function __construct($pdo)
    {
        $this->pagamento = new Pagamento($pdo);
    }

    public function realizar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_conta = $_POST['id_conta'];
            $valor = $_POST['valor'];

            if ($this->pagamento->realizarPagamento($id_conta, $valor)) {
                header("Location: ../templates/consulta_pagamentos.php?success=Pagamento realizado com sucesso!");
                exit;
            } else {
                header("Location: ../templates/consulta_pagamentos.php?error=Saldo insuficiente!");
                exit;
            }
        }
    }

    public function listar()
    {
        return $this->pagamento->listarPagamentos();
    }
}

$controller = new PagamentoController($pdo);

if (isset($_GET['action']) && $_GET['action'] === 'realizar') {
    $controller->realizar();
}
