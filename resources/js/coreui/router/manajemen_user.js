import User from '@/views/manajemen_user/user/UserIndex'
import UserCreate from '@/views/manajemen_user/user/UserCreate'
import UserUpdate from '@/views/manajemen_user/user/UserUpdate'
import HakAkses from '@/views/manajemen_user/hak_akses/HakAksesIndex'
import HakAksesCreate from '@/views/manajemen_user/hak_akses/HakAksesCreate'
import HakAksesUpdate from '@/views/manajemen_user/hak_akses/HakAksesUpdate'

export default {
  path     : 'manajemen_user',
  redirect : '/manajemen_user/user',
  name     : 'Manajemen User',
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
          name     : 'Daftar User',
          component: User,
        },
        {
          path     : 'create',
          name     : 'Tambah User',
          component: UserCreate,
        },
        {
          path     : 'update/:id',
          name     : 'Ubah User',
          component: UserUpdate,
        },
      ],
    },
    {
      path     : 'hak_akses',
      redirect : 'hak_akses',
      name     : 'Hak Akses',
      component: {
        render (c) {
          return c('router-view')
        },
      },
      children: [
        {
          path     : '/',
          name     : 'Daftar Hak Akses',
          component: HakAkses,
        },
        {
          path     : 'create',
          name     : 'Tambah Hak Akses',
          component: HakAksesCreate,
        },
        {
          path     : 'update/:id',
          name     : 'Ubah Hak Akses',
          component: HakAksesUpdate,
        },
      ],
    },
  ],
}
