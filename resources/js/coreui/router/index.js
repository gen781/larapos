import Vue from 'vue'
import Router from 'vue-router'

// Containers
import Full from '@/containers/Full'

// Views
import Dashboard from '@/views/sample/Dashboard'

// Views - Pages
import Page404 from '@/views/pages/Page404'
import Page500 from '@/views/pages/Page500'
import Login from '@/views/pages/Login'
import Logout from '@/views/pages/Logout'
import Register from '@/views/pages/Register'

// Sample route
import sample from './sample'

// Master route
import master from './master'

//vuex store
import store from '@/store'

Vue.use(Router)

const routes = [
  {
    path     : '/',
    redirect : '/dashboard',
    name     : 'Home',
    component: Full,
    meta: { requiresAuth: true },
    children : [
      {
        path     : 'dashboard',
        name     : 'Dashboard',
        component: Dashboard,
      },
      master,
      ...sample,
    ],
  },
  {
    path     : '/pages',
    redirect : '/pages/404',
    name     : 'Pages',
    component: { render (c) { return c('router-view') } },
    children : [
      {
        path     : '404',
        name     : 'Page404',
        component: Page404,
      },
      {
        path     : '500',
        name     : 'Page500',
        component: Page500,
      },
      {
        path     : 'login',
        name     : 'Login',
        component: Login,
      },
      {
        path     : 'logout',
        name     : 'Logout',
        component: Logout,
      },
      {
        path     : 'register',
        name     : 'Register',
        component: Register,
      },
    ],
  },
  {
    path     : '*',
    name     : '404',
    component: Page404,
  }
]

const router = new Router({
  mode           : 'history',
  linkActiveClass: 'open active',
  scrollBehavior : () => ({ y: 0 }),
  routes
});

router.beforeEach((to, from, next) => {
  if (to.matched.some(route => route.meta.requiresAuth) && !store.state.isLoggedIn) {
      next({ name: 'Login' })
  } else if(to.path === '/pages/login' && store.state.isLoggedIn) {
      next({ name: 'Dashboard' })
  } else {
    next()
  }
});

export default router