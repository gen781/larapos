import Pelanggan from '@/views/kontak/pelanggan/PelangganIndex'
import PelangganCreate from '@/views/kontak/pelanggan/PelangganCreate'
import PelangganUpdate from '@/views/kontak/pelanggan/PelangganUpdate'
import Supplier from '@/views/kontak/supplier/SupplierIndex'
import SupplierCreate from '@/views/kontak/supplier/SupplierCreate'
import SupplierUpdate from '@/views/kontak/supplier/SupplierUpdate'

export default {
  path     : 'kontak',
  redirect : '/kontak/pelanggan',
  name     : 'Kontak',
  component: {
    render (c) {
      return c('router-view')
    },
  },
  children: [
    {
      path     : 'supplier',
      redirect : 'supplier',
      name     : 'Supplier',
      component: {
        render (c) {
          return c('router-view')
        },
      },
      children: [
        {
          path     : '/',
          name     : 'Daftar Supplier',
          component: Supplier,
        },
        {
          path     : 'create',
          name     : 'Tambah Supplier',
          component: SupplierCreate,
        },
        {
          path     : 'update/:id',
          name     : 'Ubah Supplier',
          component: SupplierUpdate,
        },
      ],
    },
    {
      path     : 'pelanggan',
      redirect : 'pelanggan',
      name     : 'Pelanggan',
      component: {
        render (c) {
          return c('router-view')
        },
      },
      children: [
        {
          path     : '/',
          name     : 'Daftar Pelanggan',
          component: Pelanggan,
        },
        {
          path     : 'create',
          name     : 'Tambah Pelanggan',
          component: PelangganCreate,
        },
        {
          path     : 'update/:id',
          name     : 'Ubah Pelanggan',
          component: PelangganUpdate,
        },
      ],
    },
  ],
}
