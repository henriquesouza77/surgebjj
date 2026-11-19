<?php
declare(strict_types=1);
ini_set('display_errors', '1');
error_reporting(E_ALL);

// --- AUTOLOADER NATIVO CORRIGIDO ---
spl_autoload_register(function ($class) {
    $prefixes = [
        'App\\' => __DIR__ . '/../app/',
        'Config\\' => __DIR__ . '/../config/'
    ];

    foreach ($prefixes as $prefix => $base_dir) {
        $len = strlen($prefix);
        if (strncmp($prefix, $class, $len) === 0) {
            $relative_class = substr($class, $len);
            $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
            if (file_exists($file)) {
                require $file;
            }
            break;
        }
    }
});

use App\Helpers\Env;
use App\Controllers\ProductController;
use App\Controllers\CartController;
use App\Controllers\OrderController;
use App\Controllers\Admin\AuthController;
use App\Controllers\Admin\ProductController as AdminProductController;
use App\Controllers\Admin\OrderController as AdminOrderController;

Env::load(__DIR__ . '/../.env');
session_start();

$requestUri = $_SERVER['REQUEST_URI'];
$basePath = '/surgebjj/Backend/public';
$route = str_replace($basePath, '', parse_url($requestUri, PHP_URL_PATH));
$method = $_SERVER['REQUEST_METHOD'];

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

if ($method === 'OPTIONS') { http_response_code(200); exit; }

// Públicas
if ($route === '/api/products/featured' && $method === 'GET') (new ProductController())->featured();
elseif ($route === '/api/products' && $method === 'GET') (new ProductController())->index();
elseif ($route === '/api/cart' && $method === 'GET') (new CartController())->index();
elseif ($route === '/api/cart/add' && $method === 'POST') (new CartController())->add();
elseif ($route === '/api/checkout' && $method === 'POST') (new OrderController())->checkout();

// Admin
elseif ($route === '/api/admin/login' && $method === 'POST') (new AuthController())->login();
elseif ($route === '/api/admin/products' && $method === 'GET') (new AdminProductController())->index();
elseif ($route === '/api/admin/products' && $method === 'POST') (new AdminProductController())->store();
elseif ($route === '/api/admin/stock' && $method === 'GET') (new AdminProductController())->stock();
elseif ($route === '/api/admin/orders' && $method === 'GET') (new AdminOrderController())->index();
elseif ($route === '/api/admin/orders/status' && $method === 'POST') (new AdminOrderController())->updateStatus();

else {
    http_response_code(404);
    echo json_encode(['error' => 'Rota não encontrada: ' . $route]);
}