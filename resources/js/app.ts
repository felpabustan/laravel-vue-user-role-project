/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import "./bootstrap";

import { createApp } from "vue";
import { createRouter, createWebHashHistory } from 'vue-router';

import App from "./layouts/App.vue";
import Login from './layouts/Login.vue';
import Home from './layouts/Home.vue';
import Users from './layouts/Users.vue';
import Roles from './layouts/Roles.vue';
import CreateUser from './layouts/CreateUser.vue';
import CreateRole from './layouts/CreateRole.vue';
import FormInput from './components/FormInput.vue';

const routes = [
    { path: '', redirect: '/login' },
    { path: '/login', component: Login, name: 'Login' },
    {
        path: '/home',
        component: Home,
        name: 'Home',
        children: [
            { path: 'users', component: Users, name: 'Home-Users' },
            { path: 'roles', component: Roles, name: 'Home-Roles' }
        ]
    }
]

const router = createRouter({
    history: createWebHashHistory(),
    routes,
})

const app = createApp(App);

app.use(router);

app.component('create-user', CreateUser);
app.component('create-role', CreateRole);
app.component('form-input', FormInput);

app.mount('#app');