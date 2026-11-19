import { fetchAPI } from './api.js';

export async function finalizarCompra() {
    const nome = document.getElementById('checkout-nome').value;
    const email = document.getElementById('checkout-email').value;

    if(!nome || !email) return alert('Preencha nome e e-mail');

    try {
        const res = await fetchAPI('/checkout', {
            method: 'POST',
            body: JSON.stringify({ name: nome, email: email })
        });
        alert(res.message + ' ID do pedido: ' + res.order_id);
        window.location.reload(); // Recarrega para limpar carrinho
    } catch (e) {
        alert(e.message);
    }
}