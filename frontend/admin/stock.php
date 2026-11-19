<?php
session_start();
if (!isset($_SESSION['admin_id'])) { header('Location: index.php'); exit; }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Estoque | SURGE Admin</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <div class="sidebar">
        <h2>SURGE ADMIN</h2>
        <a href="dashboard.php">Dashboard</a>
        <a href="products.php">Produtos</a>
        <a href="stock.php" class="active">Estoque</a>
        <a href="#">Pedidos</a>
        <a href="#">Sair</a>
    </div>
    <div class="content">
        <h1>Controle de Estoque</h1>
        <div class="card">
            <table>
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Tamanho</th>
                        <th>Cor</th>
                        <th>SKU</th>
                        <th>Qtd em Estoque</th>
                    </tr>
                </thead>
                <tbody id="stock-list">
                    <!-- Preenchido via JS -->
                </tbody>
            </table>
        </div>
    </div>

    <script>
        async function loadStock() {
            const res = await fetch('/SURGE/Backend/public/api/admin/stock');
            const json = await res.json();
            
            const tbody = document.getElementById('stock-list');
            if(json.data) {
                tbody.innerHTML = json.data.map(v => `
                    <tr>
                        <td><strong>${v.name}</strong></td>
                        <td>${v.size}</td>
                        <td>${v.color}</td>
                        <td>${v.sku}</td>
                        <td style="color: ${v.stock_quantity < 5 ? 'red' : 'green'}; font-weight: bold;">
                            ${v.stock_quantity} un.
                        </td>
                    </tr>
                `).join('');
            }
        }
        document.addEventListener('DOMContentLoaded', loadStock);
    </script>
</body>
</html>