
module.exports = {

    el: '#cart-box',

    data: {
        products: 0,
        items: 0,
        total: 0,
        flash: false
    },

    ready: function() {
        this.sync();
    },

    methods: {
        sync: function(andFlash) {
            this.$http.get('/api/cart/summary', function(res) {
                this.$set('products', res.products);
                this.$set('items', res.items);
                this.$set('total', res.total);
                if(andFlash) {
                    this.flashDetails();
                }
            }).error(function(res) {
                console.log(res);
            });
        },

        flashDetails: function() {
            var self = this;
            this.flash = true;
            window.setTimeout(function() {
                self.flash = false;
            }, 2000);
        }
    }
};