<?php
declare(strict_types=1);

namespace App\Controllers;

use Config\Database;
use PDO;

class OrderController
{
    public function checkout(): void
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        
        $input = json_decode(file_get_contents('php://input'), true);
        $cart = $_SESSION['cart'] ?? [];
        
        if (empty($cart)) {
            http_response_code(400);
            echo json_encode(['error' => 'Carrinho vazio']);
            return;
        }

        $db = Database::getConnection();
        $db->beginTransaction(); // Inicia transação para garantir integridade

        try {
            // 1. Cria o Pedido
            $stmt = $db->prepare("INSERT INTO orders (customer_name, customer_email, status) VALUES (?, ?, 'pending')");
            $stmt->execute([$input['name'] ?? 'Cliente Teste', $input['email'] ?? 'teste@teste.com']);
            $orderId = $db->lastInsertId();

            // 2. Processa os Itens e Baixa de Estoque
            foreach ($cart as $productId => $qty) {
                // Busca o preço atual e verifica estoque (pegando o primeiro tamanho como exemplo)
                $stmtProd = $db->prepare("SELECT price, promotional_price FROM products WHERE id = ?");
                $stmtProd->execute([$productId]);
                $prod = $stmtProd->fetch();
                
                $preco = $prod['promotional_price'] ?: $prod['price'];

                // Insere item do pedido
                $stmtItem = $db->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
                $stmtItem->execute([$orderId, $productId, $qty, $preco]);

                // Baixa de Estoque (Simulando que o produto tem 1 variação padrão para teste)
                // Num sistema real, você enviaria o variant_id exato do carrinho
                $stmtEstoque = $db->prepare("UPDATE product_variants SET stock_quantity = stock_quantity - ? WHERE product_id = ? AND stock_quantity >= ?");
                $stmtEstoque->execute([$qty, $productId, $qty]);
                
                if ($stmtEstoque->rowCount() === 0) {
                    throw new \Exception("Estoque insuficiente para o produto ID: $productId");
                }
            }

            $db->commit();
            unset($_SESSION['cart']); // Limpa carrinho
            
            echo json_encode(['status' => 'success', 'message' => 'Pedido realizado com sucesso!', 'order_id' => $orderId]);

        } catch (\Exception $e) {
            $db->rollBack();
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}