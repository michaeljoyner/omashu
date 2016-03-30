module.exports = {
    el: '#cart-list-container',

    data: {
        items: [],
        subtotal: null,
        shipping: null,
        total: null
    },

    ready: function () {
        this.fetchItems();
        this.updateTotals();
    },

    methods: {
        fetchItems: function () {
            this.$http.get('/api/cart', function (res) {
                this.$set('items', res);
            }).error(function (res) {
                console.log(res);
            })
        },

        removeItem: function (item) {
            this.$http.delete('/api/cart/' + item.rowid, function () {
                this.items.$remove(item);
                omashuApp.cartIcon.sync(true);
                this.updateTotals();
            }).error(function (res) {
                console.log(res);
            });
        },

        updateTotals: function () {
            this.$http.get('/api/cart/totals', function (res) {
                this.$set('subtotal', res.subtotal);
                this.$set('shipping', res.shipping);
                this.$set('total', res.total);
            })
        }
    },

    events: {
        'quantity-updated': function () {
            this.updateTotals();
        }
    }
};