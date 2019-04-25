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
              Produk "{{modalHapus.nama}}" berhasil dihapus!
            </b-alert>
          </div>
          <produk-table
            :cari-produk="produks"
            hover
            striped
            bordered
            small
            fixed
          >
            <template slot="caption">
              <i class="fa fa-align-justify" /> Daftar Produk
              <div class="row">
                <div class="col-md-4 col-sm-12 mt-2">
                  <b-input-group>
                    <b-form-input
                      type="text"
                      placeholder="Cari"
                      v-model="cariProduk"
                    />
                    <b-input-group-append>
                      <b-input-group-text>
                        <i class="fa fa-search" />
                      </b-input-group-text>
                    </b-input-group-append>
                  </b-input-group>
                </div>
                <div class="col-md-8 col-sm-12">
                  <b-button
                    variant="success"
                    to="produk/create"
                    size="sm"
                    class="mt-3 float-right"
                  >
                    <i class="fa fa-plus" />
                    Tambah Produk
                  </b-button>
                </div>
              </div>
            </template>
          </produk-table>
        </b-col>
      </b-row>
    </div>
    <b-modal
      v-model="modalHapus.show"
      title="Hapus Produk"
      class="modal-danger"
      ok-variant="danger"
      @ok="hapusProduk(modalHapus.id)"
    >
      Hapus {{modalHapus.nama}}?
    </b-modal>
  </div>
</template>

<script>
import ProdukTable from './ProdukTable.vue'

export default {
  name      : 'produkIndex',
  components: { ProdukTable },
  data() {
    return {
      cariProduk: '',
      produks: [],
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
    cariProduk(produk) {
      this.getProduk(produk);
    }
  },
  methods: {
    tampilAlertHapus(produk) {
      this.modalHapus.show=true;
      this.modalHapus.nama=produk.nama;
      this.modalHapus.id=produk.id;
      // console.log(this.modalHapus)
    },
    hapusProduk(id) {
      this.modalHapus.show = false;
      axios.delete('/api/produk/'+id).then(response => {
        this.getProduk('');
        this.alertCountDown = this.alertTime;
        // console.log(response);
      }).catch(err => {
        console.log(err)
      })
    },
    alertCountDownChanged (alertCountDown) {
      this.alertCountDown = alertCountDown
    },
    getProduk(produk) {
      if(produk!='') {
        axios.get('/api/produk/cari/'+produk).then(response => {
          this.produks = response.data.produk;
          // console.log(this.produks);
        }).catch(err => {
          console.log(err)
        })
      } else {
        axios.get('/api/produk/').then(response => {
          this.produks = response.data.produks;
          // console.log(this.produks);
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
