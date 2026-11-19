<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SURGE | Kimonos & No-Gi</title>
  <link rel="icon" type="image/svg+xml" href="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAxNzEgODciPjxwYXRoIGQ9Ik0xMjggNDggTDg1IDcgTDE2IDcyIEw4IDc2IEgzMiBMODQgMjcgTDEwNyA0NiBaIiBmaWxsPSJjdXJyZW50Q29sb3IiLz48cGF0aCBkPSJNMzggNzYgSDYyIEw3OSA2MSBMODYgNTkgTDEwOSA3NiBIMTYyIEwxNTAgNzAgTDE0MCA2MSBIMTE1IEw4NSA0MyBMNTggNTggWiIgZmlsbD0iY3VycmVudENvbG9yIi8+PC9zdmc+">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <div class="announcement">FRETE GRÁTIS ACIMA DE R$ 500 <span class="announcement-divider">|</span> TROCA FÁCIL EM 30 DIAS</div>

  <header class="site-header">
    <div class="shell header-content">
      <a href="index.php" class="logo">
        <svg class="logo-symbol" viewBox="0 0 171 87" fill="none" xmlns="http://www.w3.org/2000/svg" style="fill: var(--navy)">
          <path d="M128 48 L85 7 L16 72 L8 76 H32 L84 27 L107 46 Z" fill="currentColor"/>
          <path d="M38 76 H62 L79 61 L86 59 L109 76 H162 L150 70 L140 61 H115 L85 43 L58 58 Z" fill="currentColor"/>
        </svg>
        <span class="logo-text" style="color: var(--navy)">SURGE</span>
      </a>
      <nav class="desktop-nav">
        <a href="#" class="active">KIMONOS</a>
        <a href="#">RASH GUARDS</a>
        <a href="#">NO-GI</a>
        <a href="#">COLEÇÃO</a>
      </nav>
      <div class="header-actions">
        <button class="icon-button" aria-label="Buscar">
          <svg class="ico" viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg>
        </button>
        <button class="icon-button" aria-label="Favoritos">
          <svg class="ico" viewBox="0 0 24 24"><path d="M12 21s-6.7-4.3-9.3-8.1C.5 9.5 2.1 5.1 6.1 5.1c2.3 0 3.8 1.3 4.9 2.9 1.1-1.6 2.6-2.9 4.9-2.9 4 0 5.6 4.4 3.4 7.8C18.7 16.7 12 21 12 21z"/></svg>
        </button>
        <a href="checkout.php" class="icon-button" aria-label="Carrinho">
          <svg class="ico" viewBox="0 0 24 24"><path d="M6 7h12l1 12H5L6 7z"/><path d="M9 7V5a3 3 0 0 1 6 0v2"/></svg>
          <span class="count hidden" id="cart-count">0</span>
        </a>
      </div>
    </div>
  </header>

  <main>
    <!-- Hero Section -->
    <section class="hero">
      <div class="shell hero-grid">
        <div class="hero-copy">
          <span class="eyebrow">FLOW COLLECTION / SURGE 01</span>
          <h1>Seu jogo.<br>Seu ritmo.</h1>
          <p>Design limpo, identidade forte e uma coleção feita para acompanhar cada treino. Kimonos e No-Gi para treinar com identidade, conforto e sem excessos.</p>
          <a href="#" class="btn btn-primary">VER KIMONOS <svg class="ico" viewBox="0 0 24 24"><path d="M5 12h14M13 6l6 6-6 6"/></svg></a>
          <div class="hero-sidenote">Flow Collection / Surge 01</div>
        </div>
        
        <!-- Imagem do Hero: Kimono Branco Frente -->
        <div class="hero-image" style="background-image: url('assets/images/products/01_KIMONOS/GI-CORE-WHITE/01_frente.png'); background-size: cover; background-position: center;"></div>
      </div>
    </section>

    <!-- Categorias -->
    <section class="shell category-section">
      <div class="categories">
        <!-- Kimonos: Usando o GI-FLOW-BLACK -->
        <a href="#" class="category-tile">
          <img src="assets/images/products/01_KIMONOS/GI-FLOW-BLACK/01_frente.png" alt="Kimonos">
          <div class="category-label">Kimonos <span>FLOW / CORE / PRO</span></div>
        </a>
        
        <!-- Rash Guards: Usando RASH-FLOW-NAVY -->
        <a href="#" class="category-tile">
          <img src="assets/images/products/02_RASH_GUARDS/RASH-FLOW-NAVY/01_frente.png" alt="Rash Guards">
          <div class="category-label">Rash guards <span>SHORT SLEEVE / LONG SLEEVE</span></div>
        </a>
        
        <!-- No-Gi: Usando RASH-CONTRAST -->
        <a href="#" class="category-tile">
          <img src="assets/images/products/02_RASH_GUARDS/RASH-CONTRAST/01_frente.png" alt="No-Gi">
          <div class="category-label">No-Gi <span>COMPLETE SEU KIT</span></div>
        </a>
      </div>
    </section>

    <!-- Produtos Dinâmicos -->
    <section class="shell products-section">
      <div class="section-header">
        <div>
          <span class="eyebrow">DESTAQUES</span>
          <h2 class="section-title">Coleção Flow</h2>
        </div>
        <a href="#" class="btn btn-outline" style="padding:10px 15px; min-height:auto;">Ver Tudo</a>
      </div>
      
      <div class="product-grid">
        <div style="padding: 40px; text-align: center; grid-column: 1/-1; color: var(--muted);">
            Carregando produtos...
        </div>
      </div>
    </section>
  </main>

  <script type="module" src="assets/js/products.js"></script>
  <script type="module" src="assets/js/cart.js"></script>
</body>
</html>