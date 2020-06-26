/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('app-master', () => import(
    /* webpackChunkName: "app-master" */
    './web_1/app-master.vue'
    ));
Vue.component('main-component', () => import(
    /* webpackChunkName: "main-component" */
    './web_1/main-component.vue'
    ));

Vue.component('create-item', () => import(
    /* webpackChunkName: "create-item" */
    './web_1/components/create-item.vue'
    ));
Vue.component('create-list', () => import(
    /* webpackChunkName: "create-list" */
    './web_1/components/create-list.vue'
    ));
Vue.component('edit-item', () => import(
    /* webpackChunkName: "edit-item" */
    './web_1/components/edit-item.vue'
    ));
Vue.component('show-item', () => import(
    /* webpackChunkName: "show-item" */
    './web_1/components/show-item.vue'
    ));
Vue.component('show-list', () => import(
    /* webpackChunkName: "show-list" */
    './web_1/components/show-list.vue'
    ));
Vue.component('edit-list', () => import(
    /* webpackChunkName: "edit-list" */
    './web_1/components/edit-list.vue'
    ));

Vue.component('sidebar-ul', () => import(
    /* webpackChunkName: "sidebar-ul" */
    './web_1/components/sidebar-ul.vue'
    ));


import vSelect from 'vue-select';
Vue.component('v-select', vSelect);

import Snotify, { SnotifyPosition } from 'vue-snotify'
const options = {
    toast: {
        position: SnotifyPosition.rightBottom
    }
}
Vue.use(Snotify, options);

// Vue.component('create', require('./web_1/components/NULL.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
