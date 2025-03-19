<?php

require_once __DIR__ . '/../config/database.php';

class Conta
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Cadastrar nova conta
    public function cadastrarConta($id_cliente, $id_banco, $tipo_conta, $saldo)
    {
        try {
            $stmt = $this->pdo->prepare(" ");
            $stmt->execute([$id_cliente, $id_banco, $tipo_conta, $saldo]);
            return true;
        } catch (PDOException $e) {
            echo "Erro ao cadastrar conta: " . $e->getMessage();
            return false;
        }
    }

    // Listar todas as contas
    public function listarContas()
    {
        try {
            $stmt = $this->pdo->query("  ");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erro ao listar contas: " . $e->getMessage();
            return [];
        }
    }

    // Excluir conta
    public function excluirConta($id_conta)
    {
        try {
            $stmt = $this->pdo->prepare("  ");
            $stmt->execute([$id_conta]);
            return true;
        } catch (PDOException $e) {
            echo "Erro ao excluir conta: " . $e->getMessage();
            return false;
        }
    }
}
