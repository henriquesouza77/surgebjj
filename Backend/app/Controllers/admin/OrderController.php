<?php
declare(strict_types=1);

namespace App\Controllers\Admin;

use Config\Database;

class OrderController
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
        $stmt = $db->query("SELECT * FROM orders ORDER BY id DESC");
        echo json_encode(['status' => 'success', 'data' => $stmt->fetchAll()]);
    }

    public function updateStatus(): void
    {
        $this->checkAuth();
        $input = json_decode(file_get_contents('php://input'), true);
        
        if (!isset($input['id']) || !isset($input['status'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Dados inválidos']);
            return;
        }

        $db = Database::getConnection();
        $stmt = $db->prepare("UPDATE orders SET status = ? WHERE id = ?");
        $stmt->execute([$input['status'], $input['id']]);
        
        echo json_encode(['status' => 'success', 'message' => 'Status atualizado']);
    }
}