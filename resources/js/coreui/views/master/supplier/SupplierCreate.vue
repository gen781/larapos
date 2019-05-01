<template>
  <div class="animated fadeIn">
    <b-row>
      <b-col md="6">
        <b-card>
          <div slot="header">
            <strong>Form</strong> Tambah Supplier
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
            description="Silahkan masukkan nama supplier."
          >
            <b-form-input
              v-model="supplier.nama"
              id="horizNama"
              type="text"
              placeholder="Nama.."
            />
          </b-form-group>
          <b-form-group
            :label-cols="3"
            label="No.Telepon"
            label-for="horizTelepon"
            description="Silahkan masukkan nomor telepon."
          >
            <b-form-input
              v-model="supplier.telepon"
              id="horizTelepon"
              type="text"
              placeholder="No.Telepon.."
            />
          </b-form-group>
          <b-form-group
            :label-cols="3"
            label="Alamat"
            label-for="horizAlamat"
            description="Silahkan masukkan alamat."
          >
            <b-form-textarea
              v-model="supplier.alamat"
              id="horizAlamat"
              placeholder="Alamat.."
              rows="4"
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
  name: 'SupplierCreate',
  data () {
    return {
      supplier: {
        nama: '',
        telepon: '',
        alamat: ''
      },
      alertTime         : 5,
      alertCountDown    : 0,
    }
  },
  methods: {
    simpan() {
      if(this.supplier.nama!=''&&this.supplier.telepon!=''&&this.supplier.alamat!=null) {
        let data = this.supplier;
        axios.post('/api/supplier', data).then(response => {
          // console.log(response.data.supplier);
          this.$router.push({ name: 'Supplier' })
        }).catch(err => {
          console.log(err)
        })
      } else {
        this.alertCountDown = this.alertTime;
        // this.$swal('Data belum lengkap', 'Silahkan lengkapi data terlebih dahulu!', 'warning')
      }
      
    },
    batal() {
      this.$router.go(-1);
    },
    alertCountDownChanged (alertCountDown) {
      this.alertCountDown = alertCountDown
    },
  },
  mounted() {
  }
}
</script>