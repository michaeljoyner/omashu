module.exports = {
    el: '#product-container',

    data: {
        productId: null,
        quantity: 1
    },

    ready: function() {
        var id = document.querySelector('#product-container').getAttribute('data-product');
        this.$set('productId', id);
    },

    methods: {
        addToCart: function() {
            if(this.quantity < 1) {
                return;
            }
            this.$http.post('/api/cart', {product_id: this.productId, quantity: this.quantity}, function(res) {
                window.omashuApp.cartIcon.sync(true);
            }).error(function(res) {
                console.log(res);
            })
        }
    }
};