var Vue = require('vue');
Vue.use(require('vue-resource'));

if(document.querySelector('#x-token')) {
    Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#x-token').getAttribute('content');
}

Vue.component('cartitem', require('./components/Cartitem.vue'));
Vue.component('quickadd-button', require('./components/Quickaddbutton.vue'))

var app = app || {};
var menuManager = require('./components/menumanager.js');

app.cartIcon = new Vue(require('./components/carticon.js'));
app.vueConstructorObjects = {};
app.vueConstructorObjects.product = require('./components/productvue.js');
app.vueConstructorObjects.cart = require('./components/cartvue.js');

var toggles = document.querySelectorAll('.sec-nav-toggle');

Array.prototype.slice.call(toggles).forEach(function(toggle) {
    toggle.addEventListener('click', function(ev) {
        var nav = document.querySelector('#secondary-nav');
        if(nav.classList.contains('open')) {
            return nav.classList.remove('open');
        }

        return nav.classList.add('open');
    }, false);
});



window.Vue = Vue;
window.omashuApp = app;
window.menuManager = menuManager;