<?php
include 'header.php';
require_once '../config/database.php';
require_once '../models/Cliente.php';
require_once '../models/Banco.php';

$clienteModel = new Cliente($pdo);
$bancoModel = new Banco($pdo);

$clientes = $clienteModel->listarClientes();
$bancos = $bancoModel->listarBancos();
?>

<div class="container mt-5">
    <h2>Cadastrar Conta</h2>
    <form action="../controllers/ContaController.php?action=cadastrar" method="POST">
        <div class="mb-3">
            <label for="id_cliente" class="form-label">Cliente:</label>
            <select name="id_cliente" id="id_cliente" class="form-control" required>
                <?php foreach ($clientes as $cliente): ?>
                    <option value="<?= $cliente['id_cliente'] ?>"><?= $cliente['nome'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="id_banco" class="form-label">Banco:</label>
            <select name="id_banco" id="id_banco" class="form-control" required>
                <?php foreach ($bancos as $banco): ?>
                    <option value="<?= $banco['id_banco'] ?>"><?= $banco['nome_banco'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="tipo_conta" class="form-label">Tipo de Conta:</label>
            <input type="text" name="tipo_conta" id="tipo_conta" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="saldo" class="form-label">Saldo Inicial:</label>
            <input type="number" step="0.01" name="saldo" id="saldo" class="form-control" required>
        </div>
        <a href="../" class="btn btn-danger">CANCELAR</a> 
        <button type="submit" class="btn btn-success">Cadastrar</button>
    </form>
</div>

<?php include 'footer.php'; ?>
