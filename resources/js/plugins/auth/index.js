import authModule from './module';
import authGuard from './guard';
import GuestComponent from './Guest';
import AuthComponent from './Auth';

export default class Auth
{
    static install(Vue, store, router)
    {
        store.registerModule('auth', authModule);

        router.beforeEach(authGuard(store));

        Vue.component('guest', GuestComponent);
        Vue.component('auth', AuthComponent);
    }
}
