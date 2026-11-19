<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Checkout | SURGE</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    .checkout-container { max-width: 600px; margin: 50px auto; padding: 20px; background: #fff; border: 1px solid var(--line); border-radius: 4px; }
    .checkout-container h1 { font-size: 24px; margin-bottom: 20px; }
    .form-group { margin-bottom: 15px; }
    .form-group label { display: block; font-size: 12px; font-weight: bold; margin-bottom: 5px; text-transform: uppercase; }
    .form-group input { width: 100%; padding: 12px; border: 1px solid var(--line); border-radius: 3px; }
  </style>
</head>
<body>
  <header class="site-header">
    <div class="shell header-content" style="display: flex; justify-content: center;">
      <a href="index.php" class="logo">
        <span class="logo-text" style="color: var(--navy)">SURGE</span>
      </a>
    </div>
  </header>

  <main class="checkout-container">
    <h1>Finalizar Pedido</h1>
    <div class="form-group">
      <label>Nome Completo</label>
      <input type="text" id="checkout-nome" placeholder="Seu nome">
    </div>
    <div class="form-group">
      <label>E-mail</label>
      <input type="email" id="checkout-email" placeholder="seu@email.com">
    </div>
    <button class="btn btn-primary" style="width:100%;" onclick="window.checkout()">Pagar e Finalizar</button>
  </main>

  <script type="module">
    import { finalizarCompra } from './assets/js/checkout.js';
    window.checkout = finalizarCompra;
  </script>
</body>
</html>