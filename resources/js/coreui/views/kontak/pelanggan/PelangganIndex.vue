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
          <pelanggan-table
            :cari-pelanggan="pelanggans"
            hover
            striped
            bordered
            small
            fixed
          >
            <template slot="caption">
              <i class="fa fa-align-justify" /> Daftar Pelanggan
              <div class="row">
                <div class="col-md-4 col-sm-12 mt-2">
                  <b-input-group>
                    <b-form-input
                      type="text"
                      placeholder="Cari"
                      v-model="cariPelanggan"
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
                    to="pelanggan/create"
                    size="sm"
                    class="mt-3 float-right"
                  >
                    <i class="fa fa-plus" />
                    Tambah Pelanggan
                  </b-button>
                </div>
              </div>
            </template>
          </pelanggan-table>
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
import PelangganTable from './PelangganTable.vue'

export default {
  name      : 'PelangganIndex',
  components: { PelangganTable },
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
