import store from '@/store'
import router from '@/router'

export default function interceptorsSetup() {
    axios.interceptors.request.use(function(config) {
        const token = store.state.token;
        console.log(token);
        if(token) {
            config.headers.Authorization = `Bearer ${token}`;
        }
        return config;
    }, function(err) {
        return Promise.reject(err);
    });

    axios.interceptors.response.use(function(config) {
        return config;
    },
    function(err) {
        const originalRequest = err.config;
        if (err.response.status===401&&store.state.isLoggedIn) {
            if (!originalRequest._retry) {
                originalRequest._retry = true;
                return axios.post('/api/refresh').then(response => {
                    console.log(response.data.token);
                    originalRequest['Authorization'] = 'Bearer ' + token;
                    store.commit('loginUser', response.data.token);
                    return Promise.resolve(originalRequest);
                });
            } else {
                // localStorage.removeItem('token')
                // store.commit('logoutUser')
                // router.push({ name: 'Login' })
                console.log('coba');
            }
        }
        return Promise.reject(err);
    });
}