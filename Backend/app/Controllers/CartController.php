<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Models\Product;

class CartController
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
    }

    public function add(): void
    {
        $input = json_decode(file_get_contents('php://input'), true);
        $productId = (int)($input['product_id'] ?? 0);
        $qty = (int)($input['quantity'] ?? 1);

        if ($productId <= 0) {
            http_response_code(400);
            echo json_encode(['error' => 'Produto inválido']);
            return;
        }

        if (isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId] += $qty;
        } else {
            $_SESSION['cart'][$productId] = $qty;
        }

        echo json_encode(['status' => 'success', 'cart_count' => array_sum($_SESSION['cart'])]);
    }

    public function index(): void
    {
        $cartItems = [];
        $total = 0;
        
        if (!empty($_SESSION['cart'])) {
            $productModel = new Product();
            // Para simplificar, vamos buscar todos e filtrar (num sistema real, faria um WHERE id IN)
            $allProducts = $productModel->getAll();
            
            foreach ($_SESSION['cart'] as $id => $qty) {
                foreach ($allProducts as $p) {
                    if ($p['id'] == $id) {
                        $price = $p['promotional_price'] ?: $p['price'];
                        $subtotal = $price * $qty;
                        $total += $subtotal;
                        $cartItems[] = [
                            'product' => $p,
                            'quantity' => $qty,
                            'subtotal' => $subtotal
                        ];
                        break;
                    }
                }
            }
        }

        echo json_encode([
            'status' => 'success', 
            'data' => $cartItems, 
            'total' => number_format($total, 2, ',', '.'),
            'cart_count' => array_sum($_SESSION['cart'])
        ]);
    }
}