<template>
  <div class="animated fadeIn">
    <b-row>
      <b-col sm="12">
        <user-table
          hover
          striped
          bordered
          small
          fixed
        >
          <template slot="caption">
            <i class="fa fa-align-justify" /> Daftar User
            <div class="row">
              <div class="col-md-4 col-sm-12 mt-2">
                <b-input-group>
                  <b-form-input
                    type="text"
                    placeholder="Cari"
                    v-model="cariUser"
                  />
                  <b-input-group-append>
                    <b-input-group-text>
                      <i class="fa fa-search" />
                    </b-input-group-text>
                  </b-input-group-append>
                </b-input-group>
              </div>
              <div class="col-md-8 col-sm-12">
                <b-button
                  variant="success"
                  to="user/create"
                  size="sm"
                  class="mt-3 float-right"
                >
                  <i class="fa fa-plus" />
                  Tambah User
                </b-button>
                
                
              </div>
            </div>
          </template>
        </user-table>
      </b-col>
    </b-row>
  </div>
</template>

<script>
import UserTable from './UserTable.vue'

export default {
  name      : 'UserIndex',
  components: { UserTable },
  data() {
    return {
      cariUser: '',
    }
  },
  methods: {
    getUser(user) {
      axios.get('/api/user/'+user).then(response => {
        this.cariUser = response.data.user;
        // console.log(this.user);
      }).catch(err => {
        console.log(err)
      })
    }
  },
  mounted() {
  }
}
</script>
