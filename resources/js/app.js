import VueRouter from 'vue-router';

import Editor from '@tinymce/tinymce-vue';
import tinymce from 'tinymce/tinymce';
import 'tinymce/themes/modern/theme';

import { library } from '@fortawesome/fontawesome-svg-core'
import { faCoffee,
         faSave,
         faStickyNote,
         faTrash,
         faTimes,
         faCog
} from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

import { loadProgressBar } from 'axios-progress-bar'
import 'axios-progress-bar/dist/nprogress.css'

import Vuelidate from 'vuelidate'

import { Modal, 
        FormGroup, 
        FormInput, 
        Alert,
        Button } from 'bootstrap-vue/es/components';

// Pages
import homePageComponent from './components/pages/HomeComponent'

// Modals
import exportModalComponent from './components/modals/ExportModalComponent'
import alertComponent from './components/modals/AlertComponent'
import changePasswordModalComponent from './components/modals/ChangePasswordModalComponent'

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap')
window.Vue = require('vue')
loadProgressBar()

// Font awesome configuration
library.add(
    faCoffee, faSave, faStickyNote,
    faTrash, faTimes, faCog
)
Vue.component('fa', FontAwesomeIcon)


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.use(VueRouter);
Vue.use(Vuelidate);
Vue.use(Modal);
Vue.use(FormGroup);
Vue.use(FormInput);
Vue.use(Alert);
Vue.use(Button);

Vue.component('editor', Editor);
Vue.component('exportModal', exportModalComponent);
Vue.component('alertModal', alertComponent);
Vue.component('changePasswordModal', changePasswordModalComponent);
Vue.component('example-component', require('./components/ExampleComponent.vue'));


const routes = [
  { path: '/', component: homePageComponent },
];

const router = new VueRouter({
  routes // short for `routes: routes`
});

const app = new Vue({
    el: '#app',
    router,
    data() {
      return {
        alertModalMessage: '',
        alertModalTitle: '',
        alertModalHeaderVariant: '',
        alertModalType: '',
        alertModalConfirmLastValue: ''
      }
    }

});
window.VueRoot = app;
