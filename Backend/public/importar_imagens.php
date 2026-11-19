<?php
// --- AUTOLOADER NATIVO ---
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
            if (file_exists($file)) require $file;
            break;
        }
    }
});

use App\Helpers\Env;
use Config\Database;

Env::load(__DIR__ . '/../.env');
$db = Database::getConnection();

$baseDir = __DIR__ . '/../../frontend/assets/images/products/';

$folders = [
    '01_KIMONOS' => 1, 
    '02_RASH_GUARDS' => 2
]; 

$imported = 0;
$productsCreated = 0;

$db->exec("TRUNCATE TABLE product_images");

foreach ($folders as $folder => $categoryId) {
    $dir = $baseDir . $folder . '/';
    if (!is_dir($dir)) continue;

    $productFolders = scandir($dir);
    
    foreach ($productFolders as $prodFolder) {
        if (in_array($prodFolder, ['.', '..']) || !is_dir($dir . $prodFolder)) continue;
        
        $productName = ucwords(strtolower(str_replace('-', ' ', $prodFolder)));

        // Verifica se o produto já existe
        $stmt = $db->prepare("SELECT id FROM products WHERE name = ?");
        $stmt->execute([$productName]);
        $produto = $stmt->fetch();

        if (!$produto) {
            $stmtInsert = $db->prepare("INSERT INTO products (category_id, name, price, is_active) VALUES (?, ?, 0.00, 1)");
            $stmtInsert->execute([$categoryId, $productName]);
            $productId = $db->lastInsertId();
            $productsCreated++;
        } else {
            $productId = $produto['id'];
        }

        $imageDir = $dir . $prodFolder . '/';
        $images = scandir($imageDir);
        
        // Ordena as imagens para garantir que 01_frente venha primeiro
        sort($images);
        
        foreach ($images as $img) {
            if (in_array($img, ['.', '..']) || is_dir($imageDir . $img)) continue;
            
            // Pega apenas PNG para evitar duplicar com WEBP
            if (pathinfo($img, PATHINFO_EXTENSION) !== 'png') continue;

            $url = 'assets/images/products/' . $folder . '/' . $prodFolder . '/' . $img;
            
            $stmtImg = $db->prepare("INSERT INTO product_images (product_id, image_url) VALUES (?, ?)");
            $stmtImg->execute([$productId, $url]);
            $imported++;
        }
    }
}
echo "Sucesso!<br>";
echo "<strong>$productsCreated</strong> novos produtos criados.<br>";
echo "<strong>$imported</strong> imagens importadas (apenas arquivos .png).";