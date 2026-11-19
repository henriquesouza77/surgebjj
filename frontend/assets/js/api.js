const API_BASE_URL = '/surgebjj/Backend/public/api'; // Atualizado com o nome da sua pasta

export async function fetchAPI(endpoint, options = {}) {
    try {
        const response = await fetch(`${API_BASE_URL}${endpoint}`, {
            headers: {
                'Content-Type': 'application/json',
                ...options.headers
            },
            ...options
        });
        
        const data = await response.json();
        if (!response.ok) throw new Error(data.error || 'Erro na requisição');
        return data;
    } catch (error) {
        console.error('API Error:', error);
        throw error;
    }
}