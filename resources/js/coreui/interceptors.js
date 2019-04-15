import store from '@/store'

export default function interceptorsSetup() {
    axios.interceptors.request.use(function(config) {
        const token = store.state.token;
        // console.log(token);
        if(token) {
            config.headers.Authorization = `Bearer ${token}`;
        }
        return config;
    }, function(err) {
        return Promise.reject(err);
    });

    let isRefreshing = false;
    let subscribers = [];

    axios.interceptors.response.use(undefined, err => {
        const { config, response: { status } } = err;
        const originalRequest = config;
      
        if (status===401&&store.state.isLoggedIn) {
          if (!isRefreshing) {
            isRefreshing = true;
            axios.post('/api/refresh').then(response => {
                const { data } = response;
                isRefreshing = false;
                onRrefreshed(data.access_token);
                store.commit('loginUser', data.token);
                subscribers = [];
            });
          }
          const requestSubscribers = new Promise(resolve => {
            subscribeTokenRefresh(token => {
              originalRequest.headers.Authorization = `Bearer ${token}`;
              resolve(axios(originalRequest));
            });
          });
          return requestSubscribers;
        }
        return Promise.reject(err);
    });
    
    function subscribeTokenRefresh(cb) {
        subscribers.push(cb);
    }
    
    function onRrefreshed(token) {
        subscribers.map(cb => cb(token));
    }  
}