var Vue = require('vue');
Vue.use(require('vue-resource'));

if(document.querySelector('#x-token')) {
    Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#x-token').getAttribute('content');
}



Vue.component('singleupload', require('./components/Singleupload.vue'));
Vue.component('togglebutton', require('./components/Togglebutton.vue'));

window.Vue = Vue;