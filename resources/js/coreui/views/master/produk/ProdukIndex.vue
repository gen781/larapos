<template>
  <div class="animated fadeIn">
    <b-row>
      <b-col sm="12">
        <produk-table
          hover
          striped
          bordered
          small
          fixed
        >
          <template slot="caption">
            <i class="fa fa-align-justify" /> Daftar Produk
            <div class="text-right">
              <b-button
                size="sm"
                variant="success"
                to="produk/create"
              >
                <i class="fa fa-plus" />
                Tambah Produk
              </b-button>
            </div>
          </template>
        </produk-table>
      </b-col>
    </b-row>
  </div>
</template>

<script>
import ProdukTable from './ProdukTable.vue'

export default {
  name      : 'ProdukIndex',
  components: { ProdukTable },
  // data() {
  //   return {
  //     users: '',
  //   }
  // },
  // methods: {
  //   getUsers() {
  //     axios.get('/api/user',{
  //       headers: {
  //         'Authorization': 'Bearer ' + localStorage.getItem('token'),
  //         'Content-Type': 'application/json'
  //       }
  //     }).then(response => {
  //         this.users=response.data.users;
  //         console.log(this.users);
  //     }).catch(error => {
  //         console.log(error);
  //     });
  //   }
  // },
  // mounted() {
  //   this.getUsers();
  // }
}
</script>
