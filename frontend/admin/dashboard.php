<?php
session_start();
if (!isset($_SESSION['admin_id'])) { header('Location: index.php'); exit; }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Dashboard | SURGE Admin</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <div class="sidebar">
        <h2>SURGE ADMIN</h2>
        <a href="dashboard.php" class="active">Dashboard</a>
        <a href="products.php">Produtos</a>
        <a href="#">Pedidos</a>
        <a href="#">Clientes</a>
        <a href="#">Sair</a>
    </div>
    <div class="content">
        <h1>Olá, <?= $_SESSION['admin_name'] ?></h1>
        <div class="card">
            <h3>Visão Geral (Dados Reais do Banco)</h3>
            <p>Selecione "Produtos" no menu lateral para gerenciar o catálogo.</p>
        </div>
    </div>
</body>
</html>