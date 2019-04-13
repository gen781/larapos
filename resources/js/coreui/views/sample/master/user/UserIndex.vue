<template>
  <div class="animated fadeIn">
    <b-row>
      <b-col sm="12">
        <user-table
          hover
          striped
          bordered
          small
          fixed
        >
          <template slot="caption">
            <i class="fa fa-align-justify" /> Daftar User
            <div class="text-right">
              <b-button
                size="sm"
                variant="success"
                to="user/create"
              >
                <i class="fa fa-plus" />
                Tambah User
              </b-button>
            </div>
          </template>
        </user-table>
      </b-col>
    </b-row>
  </div>
</template>

<script>
import UserTable from './UserTable.vue'

export default {
  name      : 'UserIndex',
  components: { UserTable },
}
</script>
