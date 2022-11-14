import './bootstrap';

import Alpine from 'alpinejs';
import mask from "inputmask";

window.Alpine = Alpine;

Alpine.start();

$(document).ready(function($) {
    inputmask().mask(document.querySelectorAll("input"));
});
