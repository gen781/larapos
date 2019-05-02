import Penjualan from '@/views/transaksi/penjualan/PenjualanIndex'

export default {
  path     : 'transaksi',
  redirect : '/transaksi/penjualan',
  name     : 'Transaksi',
  component: {
    render (c) {
      return c('router-view')
    },
  },
  children: [
    {
      path     : 'penjualan',
      redirect : 'penjualan',
      name     : 'Penjualan',
      component: {
        render (c) {
          return c('router-view')
        },
      },
      children: [
        {
          path     : '/',
          name     : 'Index-penjualan',
          component: Penjualan,
        }
      ],
    },
  ],
}
