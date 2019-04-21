<template>
  <div class="animated fadeIn">
    <b-row>
      <b-col md="6">
        <b-card>
          <div slot="header">
            <strong>Form</strong> Edit User
          </div>
          <b-form-group
            :label-cols="3"
            label="Nama"
            label-for="horizEmail"
            description="Silahkan masukkan nama Anda."
          >
            <b-form-input
              v-model="user.nama"
              id="horizEmail"
              type="text"
              placeholder="Nama.."
            />
          </b-form-group>
          <b-form-group
            :label-cols="3"
            label="Email"
            label-for="horizEmail"
            description="Silahkan masukkan email Anda."
          >
            <b-form-input
              v-model="user.email"
              id="horizEmail"
              type="email"
              placeholder="Email.."
            />
          </b-form-group>
          <b-form-group
            :label-cols="3"
            label="Role"
            label-for="daftarRole"
          >
            <b-form-select
              id="daftarRole"
              :plain="true"
              :options="[roles[0].id, roles[1].id]"
              :value="roles[0].nama_role"
              v-model="selected_role"
              @change="changeRole(selected_role)"
            />
          </b-form-group>
          <div slot="footer">
            <b-button
              type="submit"
              size="sm"
              variant="primary"
            >
              <i class="fa fa-dot-circle-o" /> Simpan
            </b-button>
            <b-button
              type="reset"
              size="sm"
              variant="danger"
              @click="batal"
            >
              <i class="fa fa-ban" /> Batal
            </b-button>
          </div>
        </b-card>
      </b-col>
    </b-row>
  </div>
</template>

<script>
export default {
  name: 'UserUpdate',
  data () {
    return {
      user: {}, 
      role_user: '',
      roles: [],
      selected_role: '',
    }
  },
  watch: {
    '$route' (to, from) {
      this.showUser();
    }
  },
  methods: {
    click () {
      // do nothing
    },
    showUser() {
      axios.get('/api/user/'+this.$route.params.id).then(response => {
        this.user = response.data.user;
        this.role_user = this.user.role;
        this.selected_role = this.role_user.id;
        // console.log(this.user);
      }).catch(err => {
        console.log(err)
      })
    },
    showRoles() {
      axios.get('/api/role').then(response => {
        this.roles = response.data.roles;
        console.log(this.roles);
      }).catch(err => {
        console.log(err)
      })
    },
    batal() {
      this.$router.go(-1);
    },
    changeRole(role) {
      console.log(role);
    }
  },
  mounted() {
    this.showUser();
    this.showRoles();
  }
}
</script>