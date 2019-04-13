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
                  />
                  <b-form-invalid-feedback>
                    Required
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
                  />
                  <b-form-invalid-feedback>
                    Required
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
                  <b-col
                    cols="6"
                    class="text-right"
                  >
                    <b-button
                      variant="link"
                      class="px-0"
                    >
                      Forgot password?
                    </b-button>
                  </b-col>
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
                  <h2>Sign up</h2>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                  <b-button
                    variant="primary"
                    class="active mt-3"
                  >
                    Register Now!
                  </b-button>
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
import { required } from 'validators'
import store from '@/store'

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
      email: { required },
      password: { required },
    }
  },
  methods: {
    submit () {
      this.$v.$touch();
      this.loginError = false;
      if(this.email!=''&&this.password!='') {
        axios.post('/api/auth/login', {
          email: this.email,
          password: this.password
        }).then(response => {
            // login user, store the token and redirect to dashboard
            store.commit('loginUser')
            localStorage.setItem('token', response.data.access_token)
            this.$router.push({ name: 'Dashboard' })
        }).catch(error => {
            this.loginError = true
        });
      }
    },
  },
}
</script>
