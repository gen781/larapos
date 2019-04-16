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
              v-model="user.name"
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
            label="Password"
            label-for="horizPass"
            description="Silahkan masukkan password Anda."
          >
            <b-form-input
              id="horizPass"
              type="password"
              placeholder="Password.."
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
  name: 'PelangganUpdate',
  data () {
    return {
      user  : {}, 
      datepicker: new Date(),
      select2   : 'a',
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
        // console.log(this.user);
      }).catch(err => {
        console.log(err)
      })
    },
    batal() {
      this.$router.go(-1);
    }
  },
  mounted() {
    this.showUser();
  }
}
</script>