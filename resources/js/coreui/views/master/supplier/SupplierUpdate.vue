<template>
  <div class="animated fadeIn">
    <b-row>
      <b-col md="6">
        <b-card>
          <div slot="header">
            <strong>Form</strong> Edit Pelanggan
          </div>
          <b-form-group
            :label-cols="3"
            label="Nama"
            label-for="horizNama"
            description="Silahkan masukkan nama pelanggan."
          >
            <b-form-input
              v-model="pelanggan.nama"
              id="horizNama"
              type="text"
              placeholder="Nama.."
            />
          </b-form-group>
          <b-form-group
            :label-cols="3"
            label="No.HP"
            label-for="horizHP"
            description="Silahkan masukkan nomor handphone."
          >
            <b-form-input
              v-model="pelanggan.hp"
              id="horizHP"
              type="text"
              placeholder="No.HP.."
            />
          </b-form-group>
          <b-form-group
            :label-cols="3"
            label="Alamat"
            label-for="horizAlamat"
            description="Silahkan masukkan alamat."
          >
            <b-form-textarea
              v-model="pelanggan.alamat"
              id="horizAlamat"
              placeholder="Alamat.."
              rows="4"
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
  name: 'SupplierUpdate',
  data () {
    return {
      pelanggan: {}
    }
  },
  watch: {
    '$route' (to, from) {
      this.showPelanggan();
    }
  },
  methods: {
    showPelanggan() {
      axios.get('/api/pelanggan/'+this.$route.params.id).then(response => {
        this.pelanggan = response.data.pelanggan;
        // console.log(this.pelanggan);
      }).catch(err => {
        console.log(err)
      })
    },
    simpan() {
      let data = {
        nama: this.pelanggan.nama,
        hp: this.pelanggan.hp,
        alamat: this.pelanggan.alamat
      }
      axios.patch('/api/pelanggan/'+this.pelanggan.id, data).then(response => {
        // console.log(response.data.pelanggan);
        this.$router.push({ name: 'Pelanggan' })
      }).catch(err => {
        console.log(err)
      })
    },
    batal() {
      this.$router.go(-1);
    }
  },
  mounted() {
    this.showPelanggan();
  }
}
</script>