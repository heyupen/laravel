/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('jquery');
//require('bootstrap-material-design');
var Autocomplete = require('vue2-autocomplete-js');
import 'vue2-autocomplete-js/dist/style/vue2-autocomplete.css';
import 'bootstrap-material-design/dist/css/bootstrap-material-design.css';
import vueSignature from 'vue-signature';
import VuejsDialog from 'vuejs-dialog';

$.ajaxSetup({
  headers: {
    Authorization: 'e3b1333ed9c54d3dce3e25c8db6c4a36',
  },
});


window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.use(vueSignature);
Vue.use(VuejsDialog, {
  html: true,
  okText: 'Continua',
  cancelText: 'Annulla',
});

Vue.component('loader', require('./components/Loader.vue'));
Vue.component('login-component', require('./components/LoginComponent.vue'));
Vue.component(
  'offer-view-component',
  require('./components/OfferViewComponent.vue'),
);
Vue.component(
  'offer-list-component',
  require('./components/OfferListComponent.vue'),
);
Vue.component('address-modal', {
  template: '#address-modal',
})

const app = new Vue({
  el: '#app',
  methods: {
    showModal() {
      let element = this.$refs.modal.$el
      $(element).modal('show')
    }
  }
});
