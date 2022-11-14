import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

$(document).ready(function($) {
    window.$('input[name="telefone"]').mask('(99)99999-9999');
    window.$('input[name="cpf"]').mask('999.999.999-99');
});
