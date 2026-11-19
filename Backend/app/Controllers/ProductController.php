<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Models\Product;

class ProductController
{
    public function featured(): void
    {
        $product = new Product();
        $data = $product->getFeatured();
        echo json_encode(['status' => 'success', 'data' => $data]);
    }

    public function index(): void
    {
        $product = new Product();
        $data = $product->getAll();
        echo json_encode(['status' => 'success', 'data' => $data]);
    }
}