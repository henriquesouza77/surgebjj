import { fetchAPI } from './api.js';

export async function updateCartCount() {
    const res = await fetchAPI('/cart');
    const countEl = document.getElementById('cart-count');
    if (countEl) {
        countEl.textContent = res.cart_count;
        countEl.classList.toggle('hidden', res.cart_count === 0);
    }
}

export async function addToCart(productId) {
    try {
        await fetchAPI('/cart/add', {
            method: 'POST',
            body: JSON.stringify({ product_id: productId, quantity: 1 })
        });
        alert('Produto adicionado ao carrinho!');
        updateCartCount();
    } catch (e) {
        alert('Erro ao adicionar produto.');
    }
}

document.addEventListener('DOMContentLoaded', updateCartCount);