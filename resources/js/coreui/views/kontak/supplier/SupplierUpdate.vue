<template>
  <div class="animated fadeIn">
    <b-row>
      <b-col md="6">
        <b-card>
          <div slot="header">
            <strong>Form</strong> Edit Supplier
          </div>
          <b-form-group
            :label-cols="3"
            label="Nama"
            label-for="horizNama"
          >
            <b-form-input
              v-model="supplier.nama"
              :state="$v.supplier.nama | state"
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
            label="No.Telepon"
            label-for="horizTelepon"
          >
            <b-form-input
              v-model="supplier.telepon"
              :state="$v.supplier.telepon | state"
              id="horizTelepon"
              type="text"
              placeholder="No.Telepon.."
            />
            <b-form-invalid-feedback>
              Nomor telepon harus diisi
            </b-form-invalid-feedback>
          </b-form-group>
          <b-form-group
            :label-cols="3"
            label="Alamat"
            label-for="horizAlamat"
          >
            <b-form-textarea
              v-model="supplier.alamat"
              :state="$v.supplier.alamat | state"
              id="horizAlamat"
              placeholder="Alamat.."
              rows="4"
            />
            <b-form-invalid-feedback>
              Alamat harus diisi
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
import { required } from 'validators'
export default {
  name: 'SupplierUpdate',
  data () {
    return {
      supplier: {}
    }
  },
  validations () {
    return {
      supplier: {
        nama: { required },
        telepon: { required },
        alamat: { required }
      }
    }
  },
  watch: {
    '$route' (to, from) {
      this.showSupplier();
    },
    'supplier.telepon'(newValue) {
      const result = newValue.replace(/\D/g, "");
      this.$nextTick(() => this.supplier.telepon = result);
    },
  },
  methods: {
    showSupplier() {
      axios.get('/api/supplier/'+this.$route.params.id).then(response => {
        this.supplier = response.data.supplier;
        // console.log(this.supplier);
      }).catch(err => {
        console.log(err)
      })
    },
    simpan() {
      this.$v.$touch();
      if(this.$v.$anyError) return;
      let data = {
        nama: this.supplier.nama,
        telepon: this.supplier.telepon,
        alamat: this.supplier.alamat
      }
      axios.patch('/api/supplier/'+this.supplier.id, data).then(response => {
        // console.log(response.data.supplier);
        this.$router.push({ name: 'Supplier' })
      }).catch(err => {
        console.log(err)
      })
    },
    batal() {
      this.$router.go(-1);
    }
  },
  mounted() {
    this.showSupplier();
  }
}
</script>