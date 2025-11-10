import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Esta é a configuração mais importante para a sua aplicação.
 * Ela garante que o Axios envie os cookies de sessão para a sua API,
 * permitindo que o middleware 'auth:sanctum' funcione corretamente
 * para requisições vindas do seu próprio frontend.
 */
window.axios.defaults.withCredentials = true;

// O restante do seu arquivo bootstrap.js, se houver...
// Por exemplo, a configuração do Echo para websockets.

console.log('Bootstrap.js carregado e configurado.');