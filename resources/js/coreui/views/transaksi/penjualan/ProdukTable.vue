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
        { key: 'diskon', label: 'Diskon (%)' },
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
    }
  },
  methods: {
    tambahiJumlah(index) {
      this.keranjangProduk[index].jumlah += 1;
      let jumlah = this.keranjangProduk[index].jumlah;
      let harga = this.keranjangProduk[index].harga;
      this.keranjangProduk[index].total = harga*jumlah;
    },
    kurangiJumlah(index) {
      if(this.keranjangProduk[index].jumlah>=2) {
        this.keranjangProduk[index].jumlah -= 1;
        let jumlah = this.keranjangProduk[index].jumlah;
        let harga = this.keranjangProduk[index].harga;
        this.keranjangProduk[index].total = harga*jumlah;
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
