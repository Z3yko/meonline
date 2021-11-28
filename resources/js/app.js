/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */



 import axios from 'axios';
 axios.defaults.headers.common = {
  'X-Requested-With': 'XMLHttpRequest',
  'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
};

require('alpinejs')
require('./bootstrap');

import Vue from 'vue';
import Vuex from 'vuex';
Vue.use(Vuex);


require('bulma');
require('../css/sass/bulma.scss');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

const files = require.context('../views/components-vue/', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

 const store = new Vuex.Store({
    state: {
        infoForm:{
          contactPhone: '',
          social: {},
          websites: {},
          sendData: false,


        }
    },
    mutations: {

      updatePhone(state,newPhone){
        state.infoForm.contactPhone = newPhone;
      },
      updateSocial(state,newSocial){
        state.infoForm.social = newSocial
      },
      updateWebsites(state,newWebsites){
        state.infoForm.websites = newWebsites
      },
      updateSendData(state,newSendData){
        state.infoForm.sendData = newSendData
      },

    },
    getters:{
        allStates: (state)=>{
          return state.infoForm;
        }
    }
  })
Vue.config.productionTip = false;
window.app = new Vue({
    el: '#app',
    store,
    data:{

    },
    created(){

    },
    methods: {

    },
    computed:{

    }

})

