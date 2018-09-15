import VueRouter from 'vue-router';
import Editor from '@tinymce/tinymce-vue';
import tinymce from 'tinymce/tinymce';
import 'tinymce/themes/modern/theme';
import { library } from '@fortawesome/fontawesome-svg-core'
import { faCoffee,
         faSave,
         faStickyNote,
         faTrash
} from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

// Pages
import homePageComponent from './components/pages/HomeComponent'

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap')
window.Vue = require('vue')


// Font awesome configuration
library.add(
    faCoffee, faSave, faStickyNote,
    faTrash
)
Vue.component('fa', FontAwesomeIcon)


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.use(VueRouter);
Vue.component('editor', Editor);
Vue.component('example-component', require('./components/ExampleComponent.vue'));


const routes = [
  { path: '/', component: homePageComponent },
];

const router = new VueRouter({
  routes // short for `routes: routes`
});

const app = new Vue({
    el: '#app',
    router
});
