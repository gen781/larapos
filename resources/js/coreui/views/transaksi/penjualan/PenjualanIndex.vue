<template>
  <div class="wrapper">
    <div class="animated fadeIn">
      <b-row>
        <b-col sm="12">
          <div>
            <b-alert
              :show="alertCountDown"
              dismissible
              variant="success"
              @dismissed="alertCountDown=0"
              @dismiss-count-down="alertCountDownChanged"
            >
              Pelanggan "{{modalHapus.nama}}" berhasil dihapus!
            </b-alert>
          </div>
          <produk-table
            :cari-pelanggan="pelanggans"
            hover
            striped
            bordered
            small
            fixed
          >
            <template slot="caption">
              <i class="fa fa-align-justify" /> Transaksi Penjualan
              <div class="row">
                <div class="col-md-4 col-sm-12 mt-2">
                  <b-form-group
                    :label-cols="3"
                    label="Tanggal"
                    label-for="horizTanggal"
                  >
                    <b-form-input
                      id="horizTanggal"
                      type="text"
                      placeholder="Tanggal.."
                    />
                  </b-form-group>
                  <b-form-group
                    :label-cols="3"
                    label="Kasir"
                    label-for="horizKasir"
                  >
                    <b-form-input
                      id="horizKasir"
                      type="text"
                      placeholder="Nama kasir.."
                    />
                  </b-form-group>
                   <b-form-group
                    :label-cols="3"
                    label="Pelanggan"
                    label-for="horizPelanggan"
                  >
                    <b-form-input
                      id="horizPelanggan"
                      type="text"
                      placeholder="Nama pelanggan.."
                    />
                  </b-form-group>
                  <b-input-group>
                    <b-form-input
                      type="text"
                      placeholder="Barcode/nama produk"
                      v-model="cariPelanggan"
                    />
                    <b-input-group-append>
                      <b-input-group-text>
                        <i class="fa fa-search" />
                      </b-input-group-text>
                    </b-input-group-append>
                  </b-input-group>
                  
                </div>
                <div class="col-md-4 col-sm-12 mt-2">
                  <b-form-group
                    :label-cols="3"
                    label="Tanggal"
                    label-for="horizTanggal"
                  >
                    <b-form-input
                      id="horizTanggal"
                      type="text"
                      placeholder="Tanggal.."
                    />
                  </b-form-group>
                  <b-form-group
                    :label-cols="3"
                    label="Kasir"
                    label-for="horizKasir"
                  >
                    <b-form-input
                      id="horizKasir"
                      type="text"
                      placeholder="Nama kasir.."
                    />
                  </b-form-group>
                   <b-form-group
                    :label-cols="3"
                    label="Pelanggan"
                    label-for="horizPelanggan"
                  >
                    <b-form-input
                      id="horizPelanggan"
                      type="text"
                      placeholder="Nama pelanggan.."
                    />
                  </b-form-group>
                  <b-input-group>
                    <b-form-input
                      type="text"
                      placeholder="Barcode/nama produk"
                      v-model="cariPelanggan"
                    />
                    <b-input-group-append>
                      <b-input-group-text>
                        <i class="fa fa-search" />
                      </b-input-group-text>
                    </b-input-group-append>
                  </b-input-group>
                  
                </div>
                <div class="col-md-4 col-sm-12 mt-2">
                  <b-form-group
                    :label-cols="3"
                    label="Tanggal"
                    label-for="horizTanggal"
                  >
                    <b-form-input
                      id="horizTanggal"
                      type="text"
                      placeholder="Tanggal.."
                    />
                  </b-form-group>
                  <b-form-group
                    :label-cols="3"
                    label="Kasir"
                    label-for="horizKasir"
                  >
                    <b-form-input
                      id="horizKasir"
                      type="text"
                      placeholder="Nama kasir.."
                    />
                  </b-form-group>
                   <b-form-group
                    :label-cols="3"
                    label="Pelanggan"
                    label-for="horizPelanggan"
                  >
                    <b-form-input
                      id="horizPelanggan"
                      type="text"
                      placeholder="Nama pelanggan.."
                    />
                  </b-form-group>
                  <b-input-group>
                    <b-form-input
                      type="text"
                      placeholder="Barcode/nama produk"
                      v-model="cariPelanggan"
                    />
                    <b-input-group-append>
                      <b-input-group-text>
                        <i class="fa fa-search" />
                      </b-input-group-text>
                    </b-input-group-append>
                  </b-input-group>
                  
                </div>
              </div>
            </template>
          </produk-table>
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
