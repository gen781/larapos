<template>
  <div class="wrapper">
    <div class="animated fadeIn">
      <b-row>
        <b-col sm="12">
          <b-card>
            <div slot="header">
              <i class="fa fa-align-justify" /> Transaksi Penjualan
            </div>
            <div class="row">
              <div class="col-md-3 col-sm-12 mt-2">
                <b-form-group>
                  <b-input-group>
                    <b-input-group-prepend>
                      <b-input-group-text><i class="fa fa-check-square" /></b-input-group-text>
                    </b-input-group-prepend>
                    <b-form-input
                      type="text"
                      placeholder="No. Faktur.."
                    />
                  </b-input-group>
                </b-form-group>                     
              </div>
              <div class="col-md-3 col-sm-12 mt-2">
                <b-form-group>
                  <b-input-group>
                    <b-input-group-prepend>
                      <b-input-group-text><i class="fa fa-calendar-check-o" /></b-input-group-text>
                    </b-input-group-prepend>
                    <b-form-input
                      type="text"
                      placeholder="Tanggal.."
                    />
                  </b-input-group>
                </b-form-group>                  
              </div>
              <div class="col-md-3 col-sm-12 mt-2">
                <b-form-group>
                  <b-input-group>
                    <b-input-group-prepend>
                      <b-input-group-text><i class="fa fa-id-badge" /></b-input-group-text>
                    </b-input-group-prepend>
                    <b-form-input
                      type="text"
                      placeholder="Kasir.."
                    />
                  </b-input-group>
                </b-form-group>                     
              </div>
              <div class="col-md-3 col-sm-12 mt-2">
                <b-form-group>
                  <b-input-group>
                    <b-input-group-prepend>
                      <b-input-group-text><i class="fa fa-user" /></b-input-group-text>
                    </b-input-group-prepend>
                    <b-form-input
                      type="text"
                      placeholder="Pelanggan.."
                    />
                    <b-input-group-append>
                      <b-button variant="primary">
                        <i class="fa fa-plus" />
                      </b-button>
                    </b-input-group-append>
                  </b-input-group>
                </b-form-group>                     
              </div>
              <div class="col-md-12 col-sm-12 mt-2">
                <b-form-group>
                  <b-input-group>
                    <b-input-group-prepend>
                      <b-input-group-text><i class="fa fa-search" /></b-input-group-text>
                    </b-input-group-prepend>
                    <b-form-input
                      type="text"
                      placeholder="Barcode/nama produk.."
                    />
                    <b-input-group-append>
                      <b-button variant="primary">
                        <i class="fa fa-plus" />
                      </b-button>
                    </b-input-group-append>
                  </b-input-group>
                </b-form-group>
              </div>
            </div>
            <div class="row">
              <b-col sm="12">
                <produk-table
                  hover
                >
                </produk-table>
              </b-col>
            </div>
            <div class="row">
              <b-col sm="12">
                <div class="float-right">
                  <b-form-group>
                  <b-input-group>
                    <b-input-group-prepend>
                      <b-input-group-text><i class="fa fa-check-square" /></b-input-group-text>
                    </b-input-group-prepend>
                    <b-form-input
                      readonly
                      type="text"
                      placeholder="No. Faktur.."
                    />
                  </b-input-group>
                </b-form-group>   
                  <b>Sub total</b>
                  <br>
                  <b>Diskon</b>
                  <br>
                  <b>Pajak</b>
                  <br>
                  <b>Total</b>
                </div>>
              </b-col>
            </div>
            <div slot="footer">
              <!-- <b-button
                type="reset"
                size="sm"
                variant="danger"
              >
                <i class="fa fa-ban" /> Batal
              </b-button> -->
              <b-button
                type="submit"
                size="lg"
                variant="success"
                class="float-right"
              >
                Bayar
              </b-button>
            </div>
          </b-card>
        </b-col>
      </b-row>
    </div>
    <b-modal
      v-model="modalHapus.show"
      title="Hapus Pelanggan"
      class="modal-danger"
      ok-variant="danger"
      @ok="hapuspelanggan(modalHapus.id)"
    >
      Hapus {{modalHapus.nama}}?
    </b-modal>
  </div>
</template>

<script>
import ProdukTable from './ProdukTable.vue'

export default {
  name      : 'PenjualanIndex',
  components: { ProdukTable },
  data() {
    return {
      cariPelanggan: '',
      pelanggans: [],
      modalHapus: {
        show: false,
        nama: '',
        id: ''
      },
      alertTime         : 5,
      alertCountDown    : 0,
    }
  },
  watch: {
    cariPelanggan(pelanggan) {
      this.getPelanggan(pelanggan);
    }
  },
  methods: {
    tampilAlertHapus(pelanggan) {
      this.modalHapus.show=true;
      this.modalHapus.nama=pelanggan.nama;
      this.modalHapus.id=pelanggan.id;
      // console.log(this.modalHapus)
    },
    hapuspelanggan(id) {
      this.modalHapus.show = false;
      axios.delete('/api/pelanggan/'+id).then(response => {
        this.getPelanggan('');
        this.alertCountDown = this.alertTime;
        // console.log(response);
      }).catch(err => {
        console.log(err)
      })
    },
    alertCountDownChanged (alertCountDown) {
      this.alertCountDown = alertCountDown
    },
    getPelanggan(pelanggan) {
      if(pelanggan!='') {
        axios.get('/api/pelanggan/cari/'+pelanggan).then(response => {
          this.pelanggans = response.data.pelanggan;
          // console.log(this.pelanggans);
        }).catch(err => {
          console.log(err)
        })
      } else {
        axios.get('/api/pelanggan/').then(response => {
          this.pelanggans = response.data.pelanggans;
          // console.log(this.pelanggans);
        }).catch(err => {
          console.log(err)
        })
      }
    }
  },
  mounted() {
  }
}
</script>
