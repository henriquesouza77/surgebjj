<?php
session_start();
if (!isset($_SESSION['admin_id'])) { header('Location: index.php'); exit; }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Produtos | SURGE Admin</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <div class="sidebar">
        <h2>SURGE ADMIN</h2>
        <a href="dashboard.php">Dashboard</a>
        <a href="products.php" class="active">Produtos</a>
        <a href="#">Pedidos</a>
        <a href="#">Clientes</a>
        <a href="#">Sair</a>
    </div>
    <div class="content">
        <h1>Gerenciar Produtos</h1>
        
        <div class="card">
            <h3>Novo Produto</h3>
            <div class="form-group">
                <label>Nome do Produto</label>
                <input type="text" id="prod-name">
            </div>
            <div class="form-group">
                <label>Preço (R$)</label>
                <input type="number" id="prod-price" step="0.01">
            </div>
            <div class="form-group">
                <label>Categoria</label>
                <select id="prod-cat">
                    <option value="1">Kimonos</option>
                    <option value="2">Rash Guards</option>
                    <option value="3">No-Gi</option>
                </select>
            </div>
            <button class="btn" onclick="saveProduct()">Salvar Produto</button>
        </div>

        <div class="card">
            <h3>Lista de Produtos</h3>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Categoria</th>
                        <th>Preço</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="product-list">
                    <!-- Preenchido via JS -->
                </tbody>
            </table>
        </div>
    </div>

    <script>
        async function loadProducts() {
            const res = await fetch('/SURGE/Backend/public/api/admin/products');
            const json = await res.json();
            
            const tbody = document.getElementById('product-list');
            if(json.data) {
                tbody.innerHTML = json.data.map(p => `
                    <tr>
                        <td>#${p.id}</td>
                        <td><strong>${p.name}</strong></td>
                        <td>${p.category_name}</td>
                        <td>R$ ${parseFloat(p.price).toFixed(2)}</td>
                        <td>${p.is_active == 1 ? 'Ativo' : 'Inativo'}</td>
                    </tr>
                `).join('');
            }
        }

        async function saveProduct() {
            const name = document.getElementById('prod-name').value;
            const price = document.getElementById('prod-price').value;
            const cat = document.getElementById('prod-cat').value;

            if(!name || !price) return alert('Preencha todos os campos');

            const res = await fetch('/SURGE/Backend/public/api/admin/products', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ name, price, category_id: cat })
            });

            if(res.ok) {
                alert('Produto salvo com sucesso!');
                document.getElementById('prod-name').value = '';
                document.getElementById('prod-price').value = '';
                loadProducts();
            }
        }

        document.addEventListener('DOMContentLoaded', loadProducts);
    </script>
</body>
</html>