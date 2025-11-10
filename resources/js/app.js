import './bootstrap';

import { Livewire } from '../../vendor/livewire/livewire/dist/livewire.esm';
Livewire.start();

// Importar e expor o Axios GLOBALMENTE
import Axios from 'axios';
window.Axios = Axios; // <--- ESTA LINHA CORRIGE O ERRO

// resources/js/app.js
import './bootstrap';
import Alpine from 'alpinejs';

