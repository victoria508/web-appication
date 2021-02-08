import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

export default new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: require('../views/Home').default,
        },
        {
            path: '/login',
            name: 'login',
            component: require('../views/auth/Login').default,
            meta: {
                guest: true,
            },
        },
        {
            path: '/register',
            name: 'register',
            component: require('../views/auth/Register').default,
            meta: {
                guest: true,
            },
        },
        {
            path: '/dashboard',
            name: 'dashboard',
            component: require('../views/Dashboard').default,
            meta: {
                auth: true,
            },
        },
        {
            path: '/profiles/create',
            name: 'profiles.create',
            component: require('../views/profile/Create').default,
            meta: {
                auth: true,
            },
        },
        {
            path: '/profiles/:profile',
            name: 'profiles.show',
            component: require('../views/profile/Show').default,
            meta: {
                auth: true,
            },
        },
        {
            path: '/profiles/:profile/edit',
            name: 'profiles.edit',
            component: require('../views/profile/Edit').default,
            meta: {
                auth: true,
            },
        },
        {
            path: '*',
            component: require('../views/PageNotFound').default,
        },
    ],
});
