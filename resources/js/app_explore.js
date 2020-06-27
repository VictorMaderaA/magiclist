require('./bootstrap');

window.Vue = require('vue');

Vue.component('explore-lists', () => import(
    /* webpackChunkName: "app-master" */
    './web_1/explore-lists.vue'
    ));

import VueHolder from 'vue-holderjs';
Vue.use(VueHolder);

const app = new Vue({
    el: '#app',
    methods: {
        reqGetLists(){
            return axios.get(GET_LISTS)
                .then((resp) => this.onRequest(resp))
                .catch((err) => this.onRequestError(err));
        },
    }
});
