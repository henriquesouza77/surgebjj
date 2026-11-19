USE `surge_db`;

-- Inserindo Produtos
INSERT INTO `products` (`id`, `category_id`, `name`, `description`, `price`, `promotional_price`, `is_featured`, `is_active`) VALUES
(1, 1, 'Kimono Flow Black', 'Kimono de Jiu-Jitsu competitivo.', 899.90, 799.90, 1, 1),
(2, 2, 'Rash Guard Core', 'Rash guard manga longa.', 249.90, NULL, 1, 1),
(3, 3, 'No-Gi Shorts Pro', 'Shorts para treino No-Gi.', 299.90, 279.90, 1, 1),
(4, 1, 'Kimono Core White', 'Kimono leve para treinos diários.', 699.90, NULL, 1, 1);

-- Inserindo Variações (Tamanhos e Estoque)
INSERT INTO `product_variants` (`product_id`, `size`, `color`, `sku`, `stock_quantity`) VALUES
(1, 'A1', 'Preto', 'KIM-FLW-A1', 10),
(1, 'A2', 'Preto', 'KIM-FLW-A2', 5),
(2, 'M', 'Azul Marinho', 'RAS-COR-M', 15),
(2, 'G', 'Azul Marinho', 'RAS-COR-G', 8),
(3, 'M', 'Preto', 'NOG-PRO-M', 20),
(4, 'A1', 'Branco', 'KIM-COR-A1', 7);

-- Inserindo Imagens
INSERT INTO `product_images` (`product_id`, `image_url`, `sort_order`) VALUES
(1, 'assets/images/products/kimono-black.jpg', 0),
(2, 'assets/images/products/rashguard-blue.jpg', 0),
(3, 'assets/images/products/shorts-black.jpg', 0),
(4, 'assets/images/products/kimono-white.jpg', 0);