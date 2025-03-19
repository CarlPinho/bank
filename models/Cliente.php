<?php

require_once __DIR__ . '/../config/database.php';

class Cliente
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Cadastro de cliente
    public function cadastrarCliente($nome, $email, $cpf, $telefone)
    {
        try {
            $stmt = $this->pdo->prepare(" ");
            $stmt->execute([$nome, $email, $cpf, $telefone]);
            return true;
        } catch (PDOException $e) {
            echo "Erro ao cadastrar cliente: " . $e->getMessage();
            return false;
        }
    }
    // Atualiza de cliente
    public function atualizarCliente($nome, $email, $cpf, $telefone, $id_cliente)
    {
        try {
            $stmt = $this->pdo->prepare(" ");
            $stmt->execute([$nome, $email, $cpf, $telefone, $id_cliente]);
            return true;
        } catch (PDOException $e) {
            echo "Erro ao cadastrar cliente: " . $e->getMessage();
            return false;
        }
    }

    public function listarClienteId($id)
    {
        try {
            $stmt = $this->pdo->prepare(" ");
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erro ao listar cliente por ID: " . $e->getMessage();
            return [];
        }
    }
    // Listar todos os clientes
    public function listarClientes()
    {
        try {
            $stmt = $this->pdo->query(" ");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erro ao listar clientes: " . $e->getMessage();
            return [];
        }
    }

    // Excluir cliente
    public function excluirCliente($id_cliente)
    {
        try {
            $stmt = $this->pdo->prepare(" ");
            $stmt->execute([$id_cliente]);
            return true;
        } catch (PDOException $e) {
            echo "Erro ao excluir cliente: " . $e->getMessage();
            return false;
        }
    }
}
