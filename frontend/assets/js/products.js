import { fetchAPI } from './api.js';

export async function loadFeaturedProducts() {
    const grid = document.querySelector('.product-grid');
    if (!grid) return;

    try {
        const res = await fetchAPI('/products/featured');
        
        if(res.data.length === 0) {
            grid.innerHTML = '<p style="grid-column:1/-1; text-align:center;">Nenhum produto em destaque. Cadastre produtos no Admin.</p>';
            return;
        }

        grid.innerHTML = res.data.map(product => {
            // Corrige o caminho da imagem para o navegador achar a pasta
            const imgUrl = product.image ? `/surgebjj/frontend/${product.image}` : 'https://via.placeholder.com/300x300?text=SURGE';
            
            const priceHtml = product.promotional_price 
                ? `<span style="text-decoration:line-through;color:#888;font-size:12px;margin-right:5px;">R$ ${parseFloat(product.price).toFixed(2).replace('.', ',')}</span> R$ ${parseFloat(product.promotional_price).toFixed(2).replace('.', ',')}`
                : `R$ ${parseFloat(product.price).toFixed(2).replace('.', ',')}`;

            return `
            <article class="product-card">
                <div class="product-media">
                    <img src="${imgUrl}" alt="${product.name}" onerror="this.src='https://via.placeholder.com/300x300?text=Sem+Foto'">
                </div>
                <div class="product-info">
                    <span class="product-subtitle">${product.category}</span>
                    <h3 class="product-name">${product.name}</h3>
                    <div class="product-price">${priceHtml}</div>
                    <button class="btn btn-primary" style="margin-top:15px; width:100%; min-height:40px; padding:10px;" onclick="window.addToCartClick(${product.id})">
                        Adicionar
                    </button>
                </div>
            </article>
        `}).join('');

        import('./cart.js').then(cartModule => {
            window.addToCartClick = cartModule.addToCart;
        });

    } catch (error) {
        console.error("Falha ao carregar produtos", error);
    }
}

document.addEventListener('DOMContentLoaded', () => {
    loadFeaturedProducts();
});