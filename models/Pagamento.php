<?php

require_once __DIR__ . '/../config/database.php';

class Pagamento
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Realizar pagamento
    public function realizarPagamento($id_conta, $valor)
    {
        try {
            $this->pdo->beginTransaction();

            // Verificar saldo disponível na conta
            $stmt = $this->pdo->prepare(" ");
            $stmt->execute([$id_conta]);
            $conta = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$conta || $conta['saldo'] < $valor) {
                $this->pdo->rollBack();
                return false; // Saldo insuficiente
            }

            // Atualizar saldo da conta
            $novoSaldo = $conta['saldo'] - $valor;
            $stmt = $this->pdo->prepare(" ");
            $stmt->execute([$novoSaldo, $id_conta]);

            // Registrar o pagamento
            $stmt = $this->pdo->prepare(" ");
            $stmt->execute([$id_conta, $valor, 'Concluído']);

            $this->pdo->commit();
            return true;
        } catch (PDOException $e) {
            $this->pdo->rollBack();
            echo "Erro ao realizar pagamento: " . $e->getMessage();
            return false;
        }
    }

    // Listar todos os pagamentos
    public function listarPagamentos()
    {
        try {
            $stmt = $this->pdo->query(" ");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erro ao listar pagamentos: " . $e->getMessage();
            return [];
        }
    }
}
