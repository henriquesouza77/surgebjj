<?php
declare(strict_types=1);

namespace App\Controllers\Admin;

use Config\Database;

class AuthController
{
    public function login(): void
    {
        $input = json_decode(file_get_contents('php://input'), true);
        $email = $input['email'] ?? '';
        $password = $input['password'] ?? '';

        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT id, name, password_hash FROM users WHERE email = ? AND role_id IN (1, 2) LIMIT 1");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password_hash'])) {
            $_SESSION['admin_id'] = $user['id'];
            $_SESSION['admin_name'] = $user['name'];
            echo json_encode(['status' => 'success', 'message' => 'Login OK']);
        } else {
            http_response_code(401);
            echo json_encode(['error' => 'Credenciais inválidas']);
        }
    }
}