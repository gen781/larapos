<template>
  <div class="animated fadeIn">
    <b-row>
      <b-col md="6">
        <b-card>
          <div slot="header">
            <strong>Form</strong> Tambah User
          </div>
          <div>
            <b-alert
              :show="alertCountDown"
              dismissible
              variant="warning"
              @dismissed="alertCountDown=0"
              @dismiss-count-down="alertCountDownChanged"
            >
              Data belum lengkap, silahkan lengkapi data terlebih dahulu!
            </b-alert>
          </div>
          <b-form-group
            :label-cols="3"
            label="Nama"
            label-for="horizNama"
          >
            <b-form-input
              v-model="user.nama"
              :state="$v.user.nama | state"
              id="horizNama"
              type="text"
              placeholder="Nama.."
            />
            <b-form-invalid-feedback>
              Nama harus diisi
            </b-form-invalid-feedback>
          </b-form-group>
          <b-form-group
            :label-cols="3"
            label="Email"
            label-for="horizEmail"
          >
            <b-form-input
              v-model="user.email"
              :state="$v.user.email | state"
              id="horizEmail"
              type="email"
              placeholder="Email.."
            />
            <b-form-invalid-feedback>
              <span v-if="!$v.user.email.email">Format email tidak sesuai</span>
              <span v-else>Email harus diisi</span>
            </b-form-invalid-feedback>
          </b-form-group>
          <b-form-group
            :label-cols="3"
            label="Role"
            label-for="daftarRole"
          >
            <b-form-select
              id="daftarRole"
              :plain="true"
              :options="roles"
              v-model="selected_role"
              :state="$v.selected_role | state"
              @change="changeRole(selected_role)"
            />
            <b-form-invalid-feedback>
              Role harus dipilih
            </b-form-invalid-feedback>
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
import { required, email } from 'validators'
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
      alertTime         : 5,
      alertCountDown    : 0,
    }
  },
  validations () {
    return {
      user: {
        email: { required, email },
        password: { required },
        nama: { required },
      },
      selected_role: { required }
    }
  },
  methods: {
    showRoles() {
      axios.get('/api/role').then(response => {
        this.roles = response.data.roles.map(role => ({ value: role.id, text: role.nama_role }));
        // console.log(this.roles);
      }).catch(err => {
        console.log(err)
      })
    },
    simpan() {
      this.$v.$touch();
      if(this.$v.$anyError) return;
      let data = this.user;
      axios.post('/api/user', data).then(response => {
        // console.log(response.data.user);
        this.$router.push({ name: 'User' })
      }).catch(err => {
        console.log(err)
      })
      
      // this.alertCountDown = this.alertTime;
      // this.$swal('Data belum lengkap', 'Silahkan lengkapi data terlebih dahulu!', 'warning')
    },
    changeRole(role) {
      this.user.role=role
    },
    batal() {
      this.$router.go(-1);
    },
    alertCountDownChanged (alertCountDown) {
      this.alertCountDown = alertCountDown
    },
  },
  mounted() {
    this.showRoles();
  }
}
</script>