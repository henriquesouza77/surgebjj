<?php
declare(strict_types=1);

namespace App\Controllers\Admin;

use Config\Database;

class ProductController
{
    private function checkAuth() {
        if (!isset($_SESSION['admin_id'])) {
            http_response_code(403);
            echo json_encode(['error' => 'Acesso negado']);
            exit;
        }
    }

    public function index(): void
    {
        $this->checkAuth();
        $db = Database::getConnection();
        $stmt = $db->query("SELECT p.*, c.name as category_name FROM products p JOIN categories c ON p.category_id = c.id ORDER BY p.id DESC");
        echo json_encode(['status' => 'success', 'data' => $stmt->fetchAll()]);
    }

    public function store(): void
    {
        $this->checkAuth();
        $input = json_decode(file_get_contents('php://input'), true);
        $db = Database::getConnection();
        $stmt = $db->prepare("INSERT INTO products (category_id, name, price, is_active) VALUES (?, ?, ?, 1)");
        $stmt->execute([$input['category_id'] ?? 1, $input['name'], $input['price']]);
        echo json_encode(['status' => 'success', 'message' => 'Produto criado']);
    }

    public function stock(): void
    {
        $this->checkAuth();
        $db = Database::getConnection();
        $stmt = $db->query("SELECT v.id, p.name, v.size, v.color, v.sku, v.stock_quantity 
                            FROM product_variants v 
                            JOIN products p ON v.product_id = p.id 
                            ORDER BY p.name ASC");
        echo json_encode(['status' => 'success', 'data' => $stmt->fetchAll()]);
    }
}