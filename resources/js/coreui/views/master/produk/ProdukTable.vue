<template>
  <b-card>
    <template slot="header">
      <slot name="caption">
        Table
      </slot>
    </template>
    <b-table
      :hover="hover"
      :striped="striped"
      :bordered="bordered"
      :small="small"
      :fixed="fixed"
      :items="produks"
      :fields="fields"
      :current-page="currentPage"
      :per-page="perPage"
      responsive="sm"
    >
      <template
        slot="satuan"
        slot-scope="data"
      >
        {{ data.item.satuan.nama_satuan }}
      </template>
      <template
        slot="action"
        slot-scope="data"
      >
        <b-button size="sm" variant="warning" :to='"produk/update/"+data.item.id'>
          <i class="fa fa-edit"></i>
          Ubah
        </b-button>

        <b-button size="sm" variant="danger" @click="alertHapus(data.item)">
          <i class="fa fa-trash"></i>
          Hapus
        </b-button>
      </template>
    </b-table>
    <nav>
      <b-pagination
        v-model="currentPage"
        :total-rows="getRowCount(produks)"
        :per-page="perPage"
        prev-text="Prev"
        next-text="Next"
        hide-goto-end-buttons
      />
    </nav>
  </b-card>
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
    cariProduk: ''
  },
  data: () => {
    return {
      produks: [],
      fields: [
        { key: 'kode_produk' },
        { key: 'nama' },
        { key: 'satuan' },
        { key: 'harga_beli' },
        { key: 'harga_jual' },
        { key: 'stok' },
        { key: 'action' }
      ],
      currentPage: 1,
      perPage    : 5,
      totalRows  : 0
    }
  },
  watch: {
    cariProduk(produk) {
      this.produks=produk;
    }
  },
  methods: {
    alertHapus(produk) {
      this.$parent.tampilAlertHapus(produk);
    },
    getProduks() {
      axios.get('/api/produk').then(response => {
        this.produks=response.data.produks;
        // console.log(this.produks);
      }).catch(error => {
        console.log(error);
      });
    },
    getRowCount (items) {
      return items.length
    },
  },
  created() {
    this.getProduks();
  }
}
</script>
