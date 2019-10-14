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
          >
            <b-form-input
              v-model="user.nama"
              :state="$v.user.nama | state"
              id="horizEmail"
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
  name: 'HakAksesUpdate',
  data () {
    return {
      user: {
        nama: '',
        email: '',
        role: ''
      }, 
      roles: [],
      selected_role: null,
    }
  },
  validations () {
    return {
      user: {
        email: { required, email },
        nama: { required },
      },
      selected_role: { required }
    }
  },
  watch: {
    '$route' (to, from) {
      this.showUser();
    }
  },
  methods: {
    showUser() {
      axios.get('/api/user/'+this.$route.params.id).then(response => {
        this.user = response.data.user;
        this.selected_role = this.user.role.id;
        // console.log(this.user);
      }).catch(err => {
        console.log(err)
      })
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
      this.$v.$touch();
      if(this.$v.$anyError) return;
      let data = {
        nama: this.user.nama,
        email: this.user.email,
        role: this.selected_role,
      }
      axios.patch('/api/user/'+this.user.id, data).then(response => {
        // console.log(response.data.user);
        this.$router.push({ name: 'User' })
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