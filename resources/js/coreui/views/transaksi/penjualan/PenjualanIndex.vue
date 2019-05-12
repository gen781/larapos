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
                      <b-input-group-text>#</b-input-group-text>
                    </b-input-group-prepend>
                    <b-form-input
                      readonly
                      v-model="no_faktur"
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
                      readonly
                      v-model="tgl_sekarang"
                      type="date"
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
                      readonly
                      v-model="kasir"
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
                    <b-form-select
                      id="daftarPelanggan"
                      :plain="true"
                      :options="pelanggans"
                      v-model="selected_pelanggan"
                      @change="gantiPelanggan(selected_pelanggan)"
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
                      id="selectedProduk"
                      list="daftarProduk"
                      v-model="cariProduk"
                      placeholder="Barcode/nama produk.."
                      @change="masukkanProduk"
                    ></b-form-input>
                    <datalist id="daftarProduk">
                      <option 
                        v-for="produk in produks" 
                        :data-value="produk.value"  
                        :value="produk.text"
                      >
                      </option>
                    </datalist>
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
                  :keranjang-produk="keranjang_produk"
                  hover
                >
                </produk-table>
              </b-col>
            </div>
            <div class="row">
              <b-col sm="12">
                <div class="float-right">
                  <b>Sub total: Rp.{{ formatAngka(subTotal) }}</b>
                  <br>
                  <b>Diskon: {{ total_diskon }}%</b>
                  <br>
                  <b>Pajak: {{ pajak }}%</b>
                  <br>
                  <b>Total: Rp.{{ formatAngka(grandTotal) }}</b>
                </div>
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
      modalHapus: {
        show: false,
        nama: '',
        id: ''
      },
      alertTime         : 5,
      alertCountDown    : 0,
      tgl_sekarang: moment(new Date()).format('YYYY-MM-DD'),
      no_faktur: 'npt-20190504-0001',
      kasir: this.$store.state.nama_user,
      pelanggans: [],
      selected_pelanggan: 1,
      produk:'',
      produks: [],
      original_produks: [],
      cariProduk: '',
      keranjang_produk: [],
      total_diskon: 0,
      pajak: 0,
    }
  },
  watch: {
    cariProduk(produk) {
      this.getProduk(produk);
    }
  },
  computed: {
    subTotal() {
      var subTotal=0;
      for(var i=0; i<this.keranjang_produk.length; i++) {
        subTotal+=this.keranjang_produk[i].total
      }
      return subTotal;
    },
    grandTotal() {
      var grandTotal=this.subTotal+this.total_diskon+this.pajak;
      return grandTotal;
    }
  },
  methods: {
    gantiPelanggan() {

    },
    formatAngka(angka) {
      return angka.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    },
    masukkanProduk() {
      let value = $('#selectedProduk').val();
      let selectedProdukId = $('#daftarProduk [value="' + value + '"]').data('value')
      // console.log(selectedProdukId);
      let itemProduk = this.original_produks.filter( newItem => newItem.id === selectedProdukId );
      let cekKeranjang = this.keranjang_produk.filter( newItem => newItem.id === selectedProdukId );
      if(cekKeranjang.length==0) {
        this.keranjang_produk.push(itemProduk[0]);
      } else {
        let index = this.keranjang_produk.indexOf(cekKeranjang[0]);
        this.keranjang_produk[index].jumlah+=1;
        this.keranjang_produk[index].total=this.keranjang_produk[index].jumlah*this.keranjang_produk[index].harga;
      }
      // console.log(itemProduk);
      this.cariProduk='';
    },
    tampilPelanggans() {
      axios.get('/api/pelanggan').then(response => {
        this.pelanggans = response.data.pelanggans.map(pelanggan => ({ value: pelanggan.id, text: pelanggan.nama }));
        // console.log(this.pelanggans);
      }).catch(err => {
        console.log(err)
      })
    },
    tampilAlertHapus(pelanggan) {
      this.modalHapus.show=true;
      this.modalHapus.nama=pelanggan.nama;
      this.modalHapus.id=pelanggan.id;
      // console.log(this.modalHapus)
    },
    getProduk(produk) {
      if(produk!='') {
        axios.get('/api/produk/cari/'+produk).then(response => {
          this.produks = response.data.produk.map(produk => ({ value: produk.id, text: produk.kode_produk+" - "+produk.nama }));
          // console.log(this.produks);
        }).catch(err => {
          console.log(err)
        })
      } else {
        this.getProduks();
      }
    },
    getProduks() {
      axios.get('/api/produk/').then(response => {
          this.original_produks = response.data.produks.map(produk => ({ 
            id: produk.id, 
            kode_produk: produk.kode_produk,
            nama: produk.nama,
            jumlah: 1,
            harga: produk.harga_jual,
            diskon: 0,
            total: produk.harga_jual
          }));
          this.produks = response.data.produks.map(produk => ({ value: produk.id, text: produk.kode_produk+" - "+produk.nama }));
          // console.log(this.original_produks);
        }).catch(err => {
          console.log(err)
        })
    },
    alertCountDownChanged (alertCountDown) {
      this.alertCountDown = alertCountDown
    }
  },
  mounted() {
    this.tampilPelanggans();
    this.getProduks();
  }
}
</script>
