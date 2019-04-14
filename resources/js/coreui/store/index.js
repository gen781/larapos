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
        token: localStorage.getItem('token')
    },
    mutations: {
        loginUser (state, token) {
            state.isLoggedIn = true;
            localStorage.setItem('token', token);
        },
        logoutUser (state) {
            state.isLoggedIn = false
        },
    }
})