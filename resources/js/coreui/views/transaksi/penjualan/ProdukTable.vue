<template>
  <!-- <b-card> -->
    <b-table
      :hover="hover"
      :striped="striped"
      :bordered="bordered"
      :small="small"
      :fixed="fixed"
      :items="keranjang_produks"
      :fields="fields"
      :current-page="currentPage"
      :per-page="perPage"
      responsive="sm"
    >
      <template
        slot="jumlah"
        slot-scope="data"
      >
        <b-button size="sm" variant="success" @click="kurangiJumlah(data.index)">
          <i class="fa fa-minus"></i>
        </b-button>
        &nbsp;{{ data.item.jumlah }}&nbsp;
        <b-button size="sm" variant="success" @click="tambahiJumlah(data.index)">
          <i class="fa fa-plus"></i>
        </b-button>
      </template>
      <template
        slot="harga"
        slot-scope="data"
      >
        {{ formatAngka(data.item.harga) }}
      </template>
      <template
        slot="diskon"
        slot-scope="data"
      > 
        <b-input
          v-model="keranjangProduk[data.index].diskon"
          type="number"
          class="col-xs-2"
          @input="hitungTotal(keranjangProduk[data.index].diskon, data.index)"
        />
        <!-- {{ data.item.diskon }}&nbsp;
        <b-button size="sm" variant="primary" @click="tambahDiskon(data.index)">
          <i class="fa fa-edit"></i>
        </b-button> -->
      </template>
      <template
        slot="total"
        slot-scope="data"
      >
        {{ formatAngka(data.item.total) }}
      </template>
      <template
        slot="hapus"
        slot-scope="data"
      >
        <b-button size="sm" variant="danger" @click="hapusItem(data.index)">
          <i class="fa fa-trash"></i>
          Hapus
        </b-button>
      </template>
    </b-table>
    <!-- <nav>
      <b-pagination
        v-model="currentPage"
        :total-rows="getRowCount(keranjang_produks)"
        :per-page="perPage"
        prev-text="Prev"
        next-text="Next"
        hide-goto-end-buttons
      />
    </nav> -->
  <!-- </b-card> -->
</template>

<script>

export default {
  name : 'ProdukTable',
  props: {
    hover: {
      type   : Boolean,
      default: false,
    },
    striped: {
      type   : Boolean,
      default: false,
    },
    bordered: {
      type   : Boolean,
      default: false,
    },
    small: {
      type   : Boolean,
      default: false,
    },
    fixed: {
      type   : Boolean,
      default: false,
    },
    keranjangProduk: ''
  },
  data: () => {
    return {
      keranjang_produks: [],
      fields: [
        { key: 'kode_produk' },
        { key: 'nama' },
        { key: 'jumlah' },
        { key: 'harga', label: 'Harga (Rp.)' },
        { key: 'diskon', label: 'Diskon (%)', thStyle: {width: '100px !important'} },
        { key: 'total', label: 'Total (Rp.)'},
        { key: 'hapus' }
      ],
      currentPage: 1,
      perPage    : 10,
      totalRows  : 0
    }
  },
  watch: {
    keranjangProduk(produk) {
      this.keranjang_produks=produk;
      console.log(produk);
    }
  },
  methods: {
    hitungTotal(diskon, index) {
      var jumlah = this.keranjangProduk[index].jumlah;
      var harga = this.keranjangProduk[index].harga;
      if (diskon < 0) {
        Vue.nextTick(() => {
          this.keranjangProduk[index].diskon = 0;
          this.keranjangProduk[index].total = (harga-harga*this.keranjangProduk[index].diskon/100)*jumlah;
        });
      } else if (diskon > 100) {
        Vue.nextTick(() => {
          this.keranjangProduk[index].diskon = 100;
          this.keranjangProduk[index].total = (harga-harga*this.keranjangProduk[index].diskon/100)*jumlah;
        });
      } else {
        this.keranjangProduk[index].total = (harga-harga*diskon/100)*jumlah;
      }
    },
    formatAngka(angka) {
      return angka.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    },
    tambahiJumlah(index) {
      this.keranjangProduk[index].jumlah += 1;
      let jumlah = this.keranjangProduk[index].jumlah;
      let harga = this.keranjangProduk[index].harga;
      let diskon = this.keranjangProduk[index].diskon;
      this.keranjangProduk[index].total = (harga-harga*diskon/100)*jumlah;
    },
    kurangiJumlah(index) {
      if(this.keranjangProduk[index].jumlah>=2) {
        this.keranjangProduk[index].jumlah -= 1;
        let jumlah = this.keranjangProduk[index].jumlah;
        let harga = this.keranjangProduk[index].harga;
        let diskon = this.keranjangProduk[index].diskon;
        this.keranjangProduk[index].total = (harga-harga*diskon/100)*jumlah;
      }
    },
    hapusItem(index) {
      this.keranjang_produks.splice(index, 1);
    },
    alertHapus(produk) {
      this.$parent.tampilAlertHapus(produk);
    },
    getRowCount (items) {
      return items.length
    },
  },
  created() {

  }
}
</script>
