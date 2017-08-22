
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */



import carwash from './components/Carwash'
import history from './components/History'


import VueRouter from 'vue-router';
Vue.use(VueRouter);

//Vue router definition
const router = new VueRouter({
  routes: [
    {
      //Carwash Main App
      path: '/',
      name:'homepage',
      component: carwash,
    },
    {
      //History
      path:'/History',
      name:'history',
      component: history,
    },
  ]
});

const app = new Vue({
    el: '#app',
    router,
    data:{

    },
    template:'<router-view></router-view>'
});
