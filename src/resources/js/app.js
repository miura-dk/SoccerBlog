/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./csrf'); //CSRFトークン：Axiosでの非同期通信時必要

window.Vue = require('vue').default;

import Vue from 'vue';
import vuetify from './vuetify';

import route from '../../vendor/tightenco/ziggy/src/js/Route';
import { Ziggy } from './ziggy';

Vue.mixin({
    methods: {
        route: (name, params, absolute) => route(name, params, absolute, Ziggy),
    },
});

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
import ExampleComponent from './components/ExampleComponent.vue';
import ArticleIndex from './components/ArticleIndex.vue';
import RegisterAsUser from './components/RegisterAsUser.vue';
import LoginForm from './components/LoginForm';
import ArticleCreate from './components/ArticleCreate.vue';
import ArticleEdit from './components/ArticleEdit.vue';
import ArticleShow from './components/ArticleShow.vue';

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    vuetify,
    components:{
        "example-component": ExampleComponent,
        ArticleIndex,
        RegisterAsUser,
        LoginForm,
        ArticleCreate,
        ArticleEdit,
        ArticleShow,
    },
});

