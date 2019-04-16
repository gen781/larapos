<template>
  <div class="animated fadeIn">
    <b-row>
      <b-col sm="12">
        <pelanggan-table
          hover
          striped
          bordered
          small
          fixed
        >
          <template slot="caption">
            <i class="fa fa-align-justify" /> Daftar Pelanggan
            <div class="text-right">
              <b-button
                size="sm"
                variant="success"
                to="pelanggan/create"
              >
                <i class="fa fa-plus" />
                Tambah Pelanggan
              </b-button>
            </div>
          </template>
        </pelanggan-table>
      </b-col>
    </b-row>
  </div>
</template>

<script>
import PelangganTable from './PelangganTable.vue'

export default {
  name      : 'PelangganIndex',
  components: { PelangganTable },
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
