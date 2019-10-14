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
      :items="users"
      :fields="fields"
      :current-page="currentPage"
      :per-page="perPage"
      responsive="sm"
    >
      <template
        slot="role"
        slot-scope="data"
      >
        <b-badge :variant="getBadge(data.item.role.id)">
          {{ data.item.role.nama_role }}
        </b-badge>
      </template>
      <template
        slot="action"
        slot-scope="data"
      >
        <b-button size="sm" variant="warning" :to='"user/update/"+data.item.id'>
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
        :total-rows="getRowCount(users)"
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
  name : 'HakAksesTable',
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
    cariUser: ''
  },
  data: () => {
    return {
      users: [],
      fields: [
        { key: 'nama' },
        { key: 'email' },
        { key: 'role' },
        { key: 'action' }
      ],
      currentPage: 1,
      perPage    : 5,
      totalRows  : 0
    }
  },
  watch: {
    cariUser(user) {
      this.users=user;
    }
  },
  methods: {
    alertHapus(user) {
      this.$parent.tampilAlertHapus(user);
    },
    getUsers() {
      axios.get('/api/user').then(response => {
        this.users=response.data.users;
        // console.log(this.users);
      }).catch(error => {
        console.log(error);
      });
    },
    getBadge (role) {
      return role === 1 ? 'success' : 'primary'
    },
    getRowCount (items) {
      return items.length
    },
  },
  created() {
    this.getUsers();
  }
}
</script>
