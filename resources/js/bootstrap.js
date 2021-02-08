import Vue from 'vue';

import router from './router';
import store from './store';
import i18n from './i18n';
import Auth from './plugins/auth';

import navbar from './views/layouts/NavBar';

Vue.use(Auth, store, router);

Vue.component('b-form', require('./components/Form').default);
Vue.component('b-api', require('./components/BrainrApi').default);
Vue.component('date', require('./components/Date').default);

export default new Vue({
    router,
    store,
    i18n,
    components: {
        navbar,
    },
});
