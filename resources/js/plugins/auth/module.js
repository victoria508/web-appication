import brainr from '../../apis/brainr';

export default {
    namespaced: true,

    state    : {
        user  : null,
        loaded: false,
    },
    getters  : {
        guest        : ({user, loaded}) => loaded && user == null,
        authenticated: ({user, loaded}) => loaded && user != null,
    },
    mutations: {
        storeUser(state, user)
        {
            state.user = user;
        },
        clearUser(state)
        {
            state.user = null;
        },
        loaded(state)
        {
            state.loaded = true;
        },
    },
    actions  : {
        async login({commit}, cred)
        {
            await brainr.post('/login', cred);

            const {data} = await brainr.get('/api/user');

            commit('storeUser', data);
            commit('checked');
        },
        logout({commit})
        {
            return brainr.post('/logout').
                then(() => commit('clearUser') && commit('checked'));
        },
        async checkAuth({commit})
        {
            await brainr.get('/spa/csrf-cookie');

            // console.log('')
            await brainr.get('/api/user').
                then(({data}) => commit('storeUser', data)).
                catch(e =>
                {
                    // console.log('Catched');
                    e.status === 401
                        ? commit('clearUser')
                        : null;
                }).
                finally(() => commit('loaded'));
        },
    },
};
