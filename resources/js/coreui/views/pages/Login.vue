<template>
  <div class="app flex-row align-items-center">
    <div class="container">
      <b-row class="justify-content-center">
        <b-col md="8">
          <b-card-group>
            <b-card
              no-body
              class="p-4"
            >
              <b-card-body>
                <h1>Login</h1>
                <p class="text-muted">
                  Sign In to your account
                </p>
                <b-alert :show="loginError" variant="danger">Email atau Password Anda salah!</b-alert>
                <b-input-group class="mb-3">
                  <b-input-group-prepend>
                    <b-input-group-text>
                      <i class="icon-envelope" />
                    </b-input-group-text>
                  </b-input-group-prepend>
                  <b-input
                    v-model="email"
                    :state="$v.email | state"
                    type="text"
                    class="form-control"
                    placeholder="Email"
                    @keyup.enter="submit"
                  />
                  <b-form-invalid-feedback>
                    <span v-if="!$v.email.email">Format email tidak sesuai</span>
                    <span v-else>Email harus diisi</span>
                  </b-form-invalid-feedback>
                </b-input-group>
                <b-input-group class="mb-4">
                  <b-input-group-prepend>
                    <b-input-group-text>
                      <i class="icon-lock" />
                    </b-input-group-text>
                  </b-input-group-prepend>
                  <b-input
                    v-model="password"
                    :state="$v.password | state"
                    type="password"
                    class="form-control"
                    placeholder="Password"
                    @keyup.enter="submit"
                  />
                  <b-form-invalid-feedback>
                    Password harus diisi
                  </b-form-invalid-feedback>
                </b-input-group>
                <b-row>
                  <b-col cols="6">
                    <b-button
                      variant="primary"
                      class="px-4"
                      @click="submit"
                    >
                      Login 
                    </b-button>
                  </b-col>
                  <!-- <b-col
                    cols="6"
                    class="text-right"
                  >
                    <b-button
                      variant="link"
                      class="px-0"
                    >
                      Forgot password?
                    </b-button>
                  </b-col> -->
                </b-row>
              </b-card-body>
            </b-card>
            <b-card
              no-body
              class="text-white bg-primary py-5 d-md-down-none"
              style="width:44%"
            >
              <b-card-body class="text-center">
                <div>
                  <h2>Larapos</h2>
                  <p>The realiable Point of Sale System</p>
                </div>
              </b-card-body>
            </b-card>
          </b-card-group>
        </b-col>
      </b-row>
    </div>
  </div>
</template>

<script>
import { required, email } from 'validators'

export default {
  name: 'Login',
  data () {
    return {
      email: '',
      password: '',
      loginError: false,
    }
  },
  validations () {
    return {
      email: { required, email },
      password: { required },
    }
  },
  methods: {
    submit () {
      this.$v.$touch();
      this.loginError = false;
      if(this.$v.$anyError) return;
      axios.post('/api/login', {
        email: this.email,
        password: this.password
      }).then(response => {
          // login user, store the token and redirect to dashboard
          this.$store.commit('loginUser', response.data)
          this.$router.push({ name: 'Dashboard' })
      }).catch(error => {
          this.loginError = true
      });
    },
  },
}
</script>
