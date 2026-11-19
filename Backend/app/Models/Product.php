<?php
declare(strict_types=1);

namespace App\Models;

use Config\Database;
use PDO;

class Product
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function getFeatured(): array
    {
        $sql = "SELECT p.id, p.name, p.price, p.promotional_price, c.name as category,
                (SELECT image_url FROM product_images WHERE product_id = p.id LIMIT 1) as image
                FROM products p
                JOIN categories c ON p.category_id = c.id
                WHERE p.is_featured = 1 AND p.is_active = 1
                LIMIT 4";
        return $this->db->query($sql)->fetchAll();
    }

    public function getAll(): array
    {
        $sql = "SELECT p.id, p.name, p.price, p.promotional_price, c.name as category,
                (SELECT image_url FROM product_images WHERE product_id = p.id LIMIT 1) as image
                FROM products p
                JOIN categories c ON p.category_id = c.id
                WHERE p.is_active = 1";
        return $this->db->query($sql)->fetchAll();
    }
}