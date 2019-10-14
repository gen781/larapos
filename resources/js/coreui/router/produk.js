import Produk from '@/views/produk/daftar_produk/ProdukIndex'
import ProdukCreate from '@/views/produk/daftar_produk/ProdukCreate'
import ProdukUpdate from '@/views/produk/daftar_produk/ProdukUpdate'

export default {
  path     : 'produk',
  redirect : '/produk/daftar_produk',
  name     : 'Produk',
  component: {
    render (c) {
      return c('router-view')
    },
  },
  children: [
    {
      path     : 'daftar_produk',
      redirect : 'daftar_produk',
      name     : 'Daftar Produk',
      component: {
        render (c) {
          return c('router-view')
        },
      },
      children: [
        {
          path     : '/',
          name     : 'Index',
          component: Produk,
        },
        {
          path     : 'create',
          name     : 'Tambah Produk',
          component: ProdukCreate,
        },
        {
          path     : 'update/:id',
          name     : 'Ubah Produk',
          component: ProdukUpdate,
        },
      ],
    },
  ],
}
