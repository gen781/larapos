import User from '@/views/sample/master/user/UserIndex'
import UserCreate from '@/views/sample/master/user/UserCreate'
import UserUpdate from '@/views/sample/master/user/UserUpdate'
import Pelanggan from '@/views/sample/master/Pelanggan'

export default {
  path     : 'master',
  redirect : '/master/user',
  name     : 'Master',
  component: {
    render (c) {
      return c('router-view')
    },
  },
  children: [
    {
      path     : 'user',
      redirect : 'user',
      name     : 'User',
      component: {
        render (c) {
          return c('router-view')
        },
      },
      children: [
        {
          path     : '/',
          name     : 'Index',
          component: User,
        },
        {
          path     : 'create',
          name     : 'Create',
          component: UserCreate,
        },
        {
          path     : 'update/:id',
          name     : 'Update',
          component: UserUpdate,
        },
      ],
    },
    {
      path     : 'pelanggan',
      name     : 'Pelanggan',
      component: Pelanggan,
    },
  ],
}
