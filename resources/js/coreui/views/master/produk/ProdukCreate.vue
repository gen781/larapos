<template>
  <div class="animated fadeIn">
    <b-row>
      <b-col md="6">
        <b-card>
          <div slot="header">
            <strong>Form</strong> Tambah Produk
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
            label="Kode Produk"
            label-for="horizProduk"
            description="Silahkan masukkan kode produk."
          >
            <b-form-input
              v-model="produk.kode_produk"
              id="horizProduk"
              type="text"
              placeholder="Kode produk.."
            />
          </b-form-group>
          <b-form-group
            :label-cols="3"
            label="Nama Produk"
            label-for="horizNama"
            description="Silahkan masukkan nama produk."
          >
            <b-form-input
              v-model="produk.nama"
              id="horizNama"
              type="text"
              placeholder="Nama produk.."
            />
          </b-form-group>
          <b-form-group
            :label-cols="3"
            label="Satuan"
            label-for="horizSatuan"
            description="Silahkan masukkan satuan."
          >
            <b-form-input
              v-model="produk.satuan"
              id="horizSatuan"
              type="number"
              placeholder="Satuan.."
            />
          </b-form-group>
          <b-form-group
            :label-cols="3"
            label="Harga beli"
            label-for="horizBeli"
            description="Silahkan masukkan harga beli."
          >
            <b-form-input
              v-model="produk.harga_beli"
              id="horizBeli"
              type="number"
              placeholder="Harga beli.."
            />
          </b-form-group>
          <b-form-group
            :label-cols="3"
            label="Harga jual"
            label-for="horizJual"
            description="Silahkan masukkan harga jual."
          >
            <b-form-input
              v-model="produk.harga_jual"
              id="horizJual"
              type="number"
              placeholder="Harga jual.."
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
  name: 'ProdukCreate',
  data () {
    return {
      produk: {
        kode_produk: '',
        nama: '',
        satuan: null,
        harga_beli: null,
        harga_jual: null,
        stok: 0
      },
      alertTime         : 5,
      alertCountDown    : 0,
    }
  },
  methods: {
    simpan() {
      if(this.produk.nama!=''&&this.produk.kode_produk!=''&&this.produk.satuan!=null
      &&this.produk.nama!=''&&this.produk.harga_beli!=null&&this.produk.harga_jual!=null) {
        let data = this.produk;
        axios.post('/api/produk', data).then(response => {
          // console.log(response.data.produk);
          this.$router.push({ name: 'Produk' })
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
}
</script>