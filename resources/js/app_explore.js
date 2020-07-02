require('./bootstrap');

window.Vue = require('vue');

Vue.component('explore-lists', () => import(
    /* webpackChunkName: "app-master" */
    './web_1/explore-lists.vue'
    ));

import VueHolder from 'vue-holderjs';
Vue.use(VueHolder);

import Snotify, { SnotifyPosition } from 'vue-snotify'
const options = {
    toast: {
        position: SnotifyPosition.rightBottom
    }
}
Vue.use(Snotify, options);

const app = new Vue({
    el: '#app',
});
