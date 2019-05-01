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
              Supplier "{{modalHapus.nama}}" berhasil dihapus!
            </b-alert>
          </div>
          <supplier-table
            :cari-supplier="suppliers"
            hover
            striped
            bordered
            small
            fixed
          >
            <template slot="caption">
              <i class="fa fa-align-justify" /> Daftar Supplier
              <div class="row">
                <div class="col-md-4 col-sm-12 mt-2">
                  <b-input-group>
                    <b-form-input
                      type="text"
                      placeholder="Cari"
                      v-model="cariSupplier"
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
                    to="supplier/create"
                    size="sm"
                    class="mt-3 float-right"
                  >
                    <i class="fa fa-plus" />
                    Tambah Supplier
                  </b-button>
                </div>
              </div>
            </template>
          </supplier-table>
        </b-col>
      </b-row>
    </div>
    <b-modal
      v-model="modalHapus.show"
      title="Hapus Supplier"
      class="modal-danger"
      ok-variant="danger"
      @ok="hapusSupplier(modalHapus.id)"
    >
      Hapus {{modalHapus.nama}}?
    </b-modal>
  </div>
</template>

<script>
import SupplierTable from './SupplierTable.vue'

export default {
  name      : 'SupplierIndex',
  components: { SupplierTable },
  data() {
    return {
      cariSupplier: '',
      suppliers: [],
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
    cariSupplier(supplier) {
      this.getSupplier(supplier);
    }
  },
  methods: {
    tampilAlertHapus(supplier) {
      this.modalHapus.show=true;
      this.modalHapus.nama=supplier.nama;
      this.modalHapus.id=supplier.id;
      // console.log(this.modalHapus)
    },
    hapusSupplier(id) {
      this.modalHapus.show = false;
      axios.delete('/api/supplier/'+id).then(response => {
        this.getSupplier('');
        this.alertCountDown = this.alertTime;
        // console.log(response);
      }).catch(err => {
        console.log(err)
      })
    },
    alertCountDownChanged (alertCountDown) {
      this.alertCountDown = alertCountDown
    },
    getSupplier(supplier) {
      if(supplier!='') {
        axios.get('/api/supplier/cari/'+supplier).then(response => {
          this.suppliers = response.data.supplier;
          // console.log(this.suppliers);
        }).catch(err => {
          console.log(err)
        })
      } else {
        axios.get('/api/supplier/').then(response => {
          this.suppliers = response.data.suppliers;
          // console.log(this.suppliers);
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
