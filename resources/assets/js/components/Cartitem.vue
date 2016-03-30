<style>

</style>

<template>
    <div class="cart-item">
        <img v-bind:src="thumb" alt="" class="product-thumb">
        <div class="cart-item-detail-container">
            <span class="item-description">{{ description }}</span>
            <span class="item-price">NT${{ actualqty * price }}</span>
            <div class="editing-block">
                <input type="number" min="1" v-model="newqty" class="newqty-input" :disabled="!editing">
                <div class="edit-btn" :class="{'edit': editing}" v-on:click="handleEditClick">
                    <svg class="edit-svg" fill="#428D90" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
                        <path d="M0 0h24v24H0z" fill="none"/>
                    </svg>
                    <svg class="save-svg" fill="#428D90" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 0h24v24H0z" fill="none"/>
                        <path d="M9 16.2L4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4L9 16.2z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    module.exports = {

        props: ['rowid', 'id', 'description', 'quantity', 'thumb', 'price'],


        data: function () {
            return {
                newqty: 1,
                actualqty: 1,
                editing: false
            }
        },

        computed: {
            editTxt: function () {
                return this.editing ? 'Save' : 'Edit';
            }
        },

        ready: function () {
            this.$set('newqty', this.quantity);
            this.$set('actualqty', this.quantity);
        },

        methods: {
            handleEditClick: function () {
                if (!this.editing) {
                    this.editing = true;
                    return;
                }

                this.updateQuantity();
            },



            updateQuantity: function () {
                this.$http.put('api/cart/' + this.rowid, {quantity: this.newqty}, function () {
                    this.editing = false;
                    this.actualqty = this.newqty;
                    window.omashuApp.cartIcon.sync(true);
                    this.$dispatch('quantity-updated');
                }).error(function (res) {
                    console.log(res);
                });
            }
        }
    }
</script>