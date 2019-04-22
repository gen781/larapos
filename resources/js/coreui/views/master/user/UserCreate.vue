<template>
  <div class="animated fadeIn">
    <b-row>
      <b-col md="6">
        <b-card>
          <div slot="header">
            <strong>Form</strong> Tambah User
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
            description="Silahkan pilih role Anda."
          >
            <b-form-select
              id="daftarRole"
              :plain="true"
              :options="roles"
              v-model="selected_role"
              @change="changeRole(selected_role)"
            />
          </b-form-group>
          <div slot="footer">
            <b-button
              type="submit"
              size="sm"
              variant="primary"
              @click="simpan"
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
  name: 'UserCreate',
  data () {
    return {
      user: {
        password: 'masuk123',
        nama: '',
        email: '',
        role: 2
      },
      roles: [],
      selected_role: 2,
    }
  },
  methods: {
    click () {
      // do nothing
    },
    showRoles() {
      axios.get('/api/role').then(response => {
        this.roles = response.data.roles.map(role => ({ value: role.id, text: role.nama_role }));
        // console.log(this.roles);
      }).catch(err => {
        console.log(err)
      })
    },
    simpan() {
      let data = this.user;
      axios.post('/api/user', data).then(response => {
        // console.log(response.data.user);
        this.$router.push({ name: 'User' })
      }).catch(err => {
        console.log(err)
      })
    },
    changeRole(role) {
      this.user.role=role
    },
    batal() {
      this.$router.go(-1);
    }
  },
  mounted() {
    this.showRoles();
  }
}
</script>