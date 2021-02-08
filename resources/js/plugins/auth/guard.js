export default (store) => async (to, from, next) =>
{
    if (!store.state.auth.loaded)
    {
        await store.dispatch('auth/checkAuth');
    }

    if (to.matched.some(({meta}) => meta.auth))
    {
        store.getters['auth/authenticated'] ? next() : next({name: 'login'});
    }
    else if (to.matched.some(({meta}) => meta.guest))
    {
        store.getters['auth/guest'] ? next() : next({name: 'dashboard'});
    }
    else
    {
        next();
    }
};
