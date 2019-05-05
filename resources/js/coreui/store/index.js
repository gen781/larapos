import Vue from 'vue'
import Vuex from 'vuex'
// import EasyAccess from 'vuex-easy-access'

// import state from './state'
// import mutations from './mutations'
// import getter from './getters'
// import actions from './actions'
// import modules from './modules'

Vue.use(Vuex)

// export default new Vuex.Store({
//   state,
//   mutations,
//   getter,
//   actions,
//   modules,
//   plugins: [EasyAccess()],
// })

export default new Vuex.Store({
    state: {
        isLoggedIn: !!localStorage.getItem('token'),
        token: localStorage.getItem('token'),
        id_user: localStorage.getItem('id_user'),
        nama_user: localStorage.getItem('nama_user'),
        email_user: localStorage.getItem('email_user'),
        role_user: localStorage.getItem('role_user')
    },
    mutations: {
        loginUser: (state, data) => {
            state.isLoggedIn = true;
            state.token = data.token;
            localStorage.setItem('token', data.token);
            localStorage.setItem('id_user', data.user.id);
            localStorage.setItem('nama_user', data.user.nama);
            localStorage.setItem('email_user', data.user.email);
            localStorage.setItem('role_user', data.user.role);
        },
        logoutUser: (state) => {
            state.isLoggedIn = false;
            localStorage.clear();
        },
    }
})