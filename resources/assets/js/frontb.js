var Vue = require('vue');
Vue.use(require('vue-resource'));

if(document.querySelector('#x-token')) {
    Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#x-token').getAttribute('content');
}


var app = app || {};

//app.cartIcon = new Vue({
//
//    el: '#cart-box',
//
//    data: {
//        products: 0,
//        items: 0,
//        total: 0,
//        flash: false
//    },
//
//    ready: function() {
//      this.sync();
//    },
//
//    methods: {
//        sync: function(andFlash) {
//            this.$http.get('/api/cart/summary', function(res) {
//                this.$set('products', res.products);
//                this.$set('items', res.items);
//                this.$set('total', res.total);
//                if(andFlash) {
//                    this.flashDetails();
//                }
//            }).error(function(res) {
//               console.log(res);
//            });
//        },
//
//        flashDetails: function() {
//            var self = this;
//            this.flash = true;
//            window.setTimeout(function() {
//                self.flash = false;
//            }, 2000);
//        }
//    }
//});

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