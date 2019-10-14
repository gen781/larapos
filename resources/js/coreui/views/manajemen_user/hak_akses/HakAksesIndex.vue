<template>
  <div class="wrapper">
    <div class="animated fadeIn">
      <b-row>
        <b-col sm="12">
          <div>
            <b-alert
              :show="alertCountDown"
              dismissible
              variant="success"
              @dismissed="alertCountDown=0"
              @dismiss-count-down="alertCountDownChanged"
            >
              User "{{modalHapus.nama}}" berhasil dihapus!
            </b-alert>
          </div>
          <hak-akses-table
            :cari-user="users"
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
          </hak-akses-table>
        </b-col>
      </b-row>
    </div>
    <b-modal
      v-model="modalHapus.show"
      title="Hapus User"
      class="modal-danger"
      ok-variant="danger"
      @ok="hapusUser(modalHapus.id)"
    >
      Hapus {{modalHapus.nama}}?
    </b-modal>
  </div>
</template>

<script>
import HakAksesTable from './HakAksesTable.vue'

export default {
  name: 'HakAksesIndex',
  components: { HakAksesTable },
  data() {
    return {
      cariUser: '',
      users: [],
      modalHapus: {
        show: false,
        nama: '',
        id: ''
      },
      alertTime         : 5,
      alertCountDown    : 0,
    }
  },
  watch: {
    cariUser(user) {
      this.getUser(user);
    }
  },
  methods: {
    tampilAlertHapus(user) {
      this.modalHapus.show=true;
      this.modalHapus.nama=user.nama;
      this.modalHapus.id=user.id;
      // console.log(this.modalHapus)
    },
    hapusUser(id) {
      this.modalHapus.show = false;
      axios.delete('/api/user/'+id).then(response => {
        this.getUser('');
        this.alertCountDown = this.alertTime;
        // console.log(response);
      }).catch(err => {
        console.log(err)
      })
    },
    alertCountDownChanged (alertCountDown) {
      this.alertCountDown = alertCountDown
    },
    getUser(user) {
      if(user!='') {
        axios.get('/api/user/cari/'+user).then(response => {
          this.users = response.data.user;
          // console.log(this.users);
        }).catch(err => {
          console.log(err)
        })
      } else {
        axios.get('/api/user/').then(response => {
          this.users = response.data.users;
          // console.log(this.users);
        }).catch(err => {
          console.log(err)
        })
      }
    }
  },
  mounted() {
  }
}
</script>
