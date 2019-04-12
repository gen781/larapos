<template>
  <div class="animated fadeIn">
    <b-row>
      <b-col md="6">
        <b-card>
          <div slot="header">
            <strong>Horizontal</strong> Form
          </div>
          <b-form-group
            :label-cols="3"
            label="Email"
            label-for="horizEmail"
            description="Please enter your email."
          >
            <b-form-input
              id="horizEmail"
              type="email"
              placeholder="Enter Email.."
            />
          </b-form-group>
          <b-form-group
            :label-cols="3"
            label="Password"
            label-for="horizPass"
            description="Please enter your password."
          >
            <b-form-input
              id="horizPass"
              type="password"
              placeholder="Enter Password.."
            />
          </b-form-group>
          <div slot="footer">
            <b-button
              type="submit"
              size="sm"
              variant="primary"
            >
              <i class="fa fa-dot-circle-o" /> Submit
            </b-button>
            <b-button
              type="reset"
              size="sm"
              variant="danger"
            >
              <i class="fa fa-ban" /> Reset
            </b-button>
          </div>
        </b-card>
        <b-card>
          <div slot="header">
            <strong>Normal</strong> Form
          </div>
          <b-form-group
            validated
            label="Email"
            label-for="normalEmail"
            description="Please enter your email."
          >
            <b-form-input
              id="normalEmail"
              type="email"
              placeholder="Enter Email.."
              required
            />
          </b-form-group>
          <b-form-group
            validated
            label="Password"
            label-for="normalPass"
            description="Please enter your password."
          >
            <b-form-input
              id="normalPass"
              type="password"
              placeholder="Enter Password.."
              required
            />
          </b-form-group>
          <div slot="footer">
            <b-button
              type="submit"
              size="sm"
              variant="primary"
            >
              <i class="fa fa-dot-circle-o" /> Submit
            </b-button>
            <b-button
              type="reset"
              size="sm"
              variant="danger"
            >
              <i class="fa fa-ban" /> Reset
            </b-button>
          </div>
        </b-card>
        <b-card
          :no-block="true"
          no-body
        >
          <div slot="header">
            Input <strong>Grid</strong>
          </div>
          <b-card-body>
            <b-row class="form-group">
              <b-col sm="3">
                <b-form-input
                  type="text"
                  placeholder=".col-sm-3"
                />
              </b-col>
            </b-row>
            <b-row class="form-group">
              <b-col sm="4">
                <b-form-input
                  type="text"
                  placeholder=".col-sm-4"
                />
              </b-col>
            </b-row>
            <b-row class="form-group">
              <b-col sm="5">
                <b-form-input
                  type="text"
                  placeholder=".col-sm-5"
                />
              </b-col>
            </b-row>
            <b-row class="form-group">
              <b-col sm="6">
                <b-form-input
                  type="text"
                  placeholder=".col-sm-6"
                />
              </b-col>
            </b-row>
            <b-row class="form-group">
              <b-col sm="7">
                <b-form-input
                  type="text"
                  placeholder=".col-sm-7"
                />
              </b-col>
            </b-row>
            <b-row class="form-group">
              <b-col sm="8">
                <b-form-input
                  type="text"
                  placeholder=".col-sm-8"
                />
              </b-col>
            </b-row>
            <b-row class="form-group">
              <b-col sm="9">
                <b-form-input
                  type="text"
                  placeholder=".col-sm-9"
                />
              </b-col>
            </b-row>
            <b-row class="form-group">
              <b-col sm="10">
                <b-form-input
                  type="text"
                  placeholder=".col-sm-10"
                />
              </b-col>
            </b-row>
            <b-row class="form-group">
              <b-col sm="11">
                <b-form-input
                  type="text"
                  placeholder=".col-sm-11"
                />
              </b-col>
            </b-row>
            <b-row class="form-group">
              <b-col sm="12">
                <b-form-input
                  type="text"
                  placeholder=".col-sm-12"
                />
              </b-col>
            </b-row>
          </b-card-body>
          <div slot="footer">
            <b-button
              type="submit"
              size="sm"
              variant="primary"
            >
              <i class="fa fa-user" /> Login
            </b-button>
            <b-button
              type="reset"
              size="sm"
              variant="danger"
            >
              <i class="fa fa-ban" /> Reset
            </b-button>
          </div>
        </b-card>
        <b-card>
          <div slot="header">
            Input <strong>Sizes</strong>
          </div>
          <b-form-group
            :label-cols="5"
            label="Small input"
            label-for="smInput"
            label-size="sm"
          >
            <b-form-input
              id="smInput"
              type="text"
              size="sm"
              placeholder="size='sm'"
            />
          </b-form-group>
          <b-form-group
            :label-cols="5"
            label="Default input"
            label-for="defaultInput"
          >
            <b-form-input
              id="defaultInput"
              type="text"
              placeholder="normal"
            />
          </b-form-group>
          <b-form-group
            :label-cols="5"
            label="Large input"
            label-for="lgInput"
            label-size="lg"
          >
            <b-form-input
              id="lgInput"
              type="text"
              size="lg"
              placeholder="size='lg'"
            />
          </b-form-group>
          <div slot="footer">
            <b-button
              type="submit"
              size="sm"
              variant="primary"
            >
              <i class="fa fa-dot-circle-o" /> Submit
            </b-button>
            <b-button
              type="reset"
              size="sm"
              variant="danger"
            >
              <i class="fa fa-ban" /> Reset
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
      selected  : [], // Must be an array reference!
      datepicker: new Date(),
      select2   : 'a',
    }
  },
  methods: {
    click () {
      // do nothing
    },
  },
}
</script>