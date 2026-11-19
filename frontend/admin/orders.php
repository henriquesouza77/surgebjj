<?php
session_start();
if (!isset($_SESSION['admin_id'])) { header('Location: index.php'); exit; }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Pedidos | SURGE Admin</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <div class="sidebar">
        <h2>SURGE ADMIN</h2>
        <a href="dashboard.php">Dashboard</a>
        <a href="products.php">Produtos</a>
        <a href="stock.php">Estoque</a>
        <a href="orders.php" class="active">Pedidos</a>
        <a href="#">Sair</a>
    </div>
    <div class="content">
        <h1>Gerenciar Pedidos</h1>
        <div class="card">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>E-mail</th>
                        <th>Data</th>
                        <th>Status Atual</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody id="order-list">
                    <!-- Preenchido via JS -->
                </tbody>
            </table>
        </div>
    </div>

    <script>
        async function loadOrders() {
            const res = await fetch('/surgebjj/Backend/public/api/admin/orders');
            const json = await res.json();
            
            const tbody = document.getElementById('order-list');
            if(json.data) {
                tbody.innerHTML = json.data.map(o => `
                    <tr>
                        <td>#${o.id}</td>
                        <td><strong>${o.customer_name}</strong></td>
                        <td>${o.customer_email}</td>
                        <td>${new Date(o.created_at).toLocaleDateString('pt-BR')}</td>
                        <td>
                            <select onchange="changeStatus(${o.id}, this.value)" style="padding:5px; border-radius:4px;">
                                <option value="pending" ${o.status == 'pending' ? 'selected' : ''}>Pendente</option>
                                <option value="paid" ${o.status == 'paid' ? 'selected' : ''}>Pago</option>
                                <option value="shipped" ${o.status == 'shipped' ? 'selected' : ''}>Enviado</option>
                                <option value="cancelled" ${o.status == 'cancelled' ? 'selected' : ''}>Cancelado</option>
                            </select>
                        </td>
                        <td><a href="#" style="color:#142844;">Ver Detalhes</a></td>
                    </tr>
                `).join('');
            }
        }

        async function changeStatus(id, status) {
            const res = await fetch('/surgebjj/Backend/public/api/admin/orders/status', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ id, status })
            });
            if(res.ok) alert('Status atualizado!');
        }

        document.addEventListener('DOMContentLoaded', loadOrders);
    </script>
</body>
</html>