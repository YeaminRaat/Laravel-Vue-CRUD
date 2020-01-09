require('./bootstrap');

window.Vue = require('vue');

import { Form, HasError, AlertError } from 'vform'
window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

Vue.component('pagination', require('laravel-vue-pagination'))

import Swal from 'sweetalert2'
window.Swal = Swal;
const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
})
window.Toast = Toast;

Vue.component('home-component', require('./components/HomeComponent.vue').default);

const app = new Vue({
    el: '#app',
});
