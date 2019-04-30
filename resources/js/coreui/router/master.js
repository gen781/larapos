import User from '@/views/master/user/UserIndex'
import UserCreate from '@/views/master/user/UserCreate'
import UserUpdate from '@/views/master/user/UserUpdate'
import Produk from '@/views/master/produk/ProdukIndex'
import ProdukCreate from '@/views/master/produk/ProdukCreate'
import ProdukUpdate from '@/views/master/produk/ProdukUpdate'
import Pelanggan from '@/views/master/pelanggan/PelangganIndex'
import PelangganCreate from '@/views/master/pelanggan/PelangganCreate'
import PelangganUpdate from '@/views/master/pelanggan/PelangganUpdate'
import Supplier from '@/views/master/supplier/SupplierIndex'
import SupplierCreate from '@/views/master/supplier/SupplierCreate'
import SupplierUpdate from '@/views/master/supplier/SupplierUpdate'

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
          name     : 'Index-user',
          component: User,
        },
        {
          path     : 'create',
          name     : 'Create-user',
          component: UserCreate,
        },
        {
          path     : 'update/:id',
          name     : 'Update-user',
          component: UserUpdate,
        },
      ],
    },
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
          name     : 'Index-supplier',
          component: Supplier,
        },
        {
          path     : 'create',
          name     : 'Create-supplier',
          component: SupplierCreate,
        },
        {
          path     : 'update/:id',
          name     : 'Update-supplier',
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
          name     : 'Index-pelanggan',
          component: Pelanggan,
        },
        {
          path     : 'create',
          name     : 'Create-pelanggan',
          component: PelangganCreate,
        },
        {
          path     : 'update/:id',
          name     : 'Update-pelanggan',
          component: PelangganUpdate,
        },
      ],
    },
    {
      path     : 'produk',
      redirect : 'produk',
      name     : 'Produk',
      component: {
        render (c) {
          return c('router-view')
        },
      },
      children: [
        {
          path     : '/',
          name     : 'Index-produk',
          component: Produk,
        },
        {
          path     : 'create',
          name     : 'Create-produk',
          component: ProdukCreate,
        },
        {
          path     : 'update/:id',
          name     : 'Update-produk',
          component: ProdukUpdate,
        },
      ],
    },
  ],
}
