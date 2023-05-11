<template>
  <div>
    <b-row class="d-flex justify-content-center mt-5">
      <b-col sm="10">
        <router-link
          :to="{name: 'trip-add'}"
          class="mb-2 btn btn-success"
        >
          Tambah Data
        </router-link>

        <b-table
          id="table-trip"
          striped
          hover
          :busy="isBusy"
          api-url="trip.get"
          :items="loadProvider"
          show-empty
          :fields="fields"
        >
          <template v-slot:cell(rownum)="data">
            <span class="no-wrap">{{ getRowNum(data.index) }}</span>
          </template>
          <template #table-busy>
            <div class="text-center text-danger my-2">
              <b-spinner class="align-middle"></b-spinner>
              <strong>Loading...</strong>
            </div>
          </template>
          <template v-slot:cell(rowaction)="data">
            <button
            type="button"
            class="btn btn-info btn-xs rounded"
            @click="detail(data.item)"
            >
            Lihat
            </button>
            <button
            type="button"
            class="btn btn-warning btn-xs"
            @click="updatedata(data.item)"
            >
            Ubah
            </button>
            <button
            type="button"
            class="btn btn-danger btn-xs"
            @click="drop(data.item)"
            >
            Hapus
            </button>
        </template>
        </b-table>
      </b-col>
    </b-row>
  </div>
</template>

<script>
  export default {
    name: 'trip-list',
    data() {
      return {
        dari: 1,
        isBusy: false,
        delay: 250,
        items: [],
        fields: [
          {
            key: 'rowaction',
            label: '',
            class: 'text-center',
          },
          {
            key: 'rownum',
            label: '#',
            class: 'text-center',
          },
          {
            key: 'driver',
            label: 'Driver',
            class: 'text-center',
          },
          {
            key: 'plat_no',
            label: 'Plat No',
            class: 'text-center',
          },
          {
            key: 'date',
            label: 'Date',
            class: 'text-center',
          },
          {
            key: 'point_start',
            label: 'Point Start',
            class: 'text-center',
          },
          {
            key: 'point_end',
            label: 'Point End',
            class: 'text-center',
          },
          {
            key: 'distance',
            label: 'Distance (KM)',
            class: 'text-center',
          },
          {
            key: 'standard_time',
            label: 'standard_time (menit)',
            class: 'text-center',
          },
          {
            key: 'priceper_km',
            label: 'Priceper Km',
            class: 'text-center',
          },
          {
            key: 'actual_time',
            label: 'Actual Time (menit)',
            class: 'text-center',
          },
          {
            key: 'total_cost',
            label: 'total_cost',
            class: 'text-center',
          },
        ],
      }
    },
    methods: {
      getRowNum(idx) {
        return this.dari + idx
      },
      async loadProvider(ctx, callback) {
        let vm = this
        if (ctx.apiUrl) {
          let url = vm.$app.route(ctx.apiUrl)
          vm.isBusy = true
          vm.$http
            .get(url)
            .then(output => {
              setTimeout(() => {
                let res = output.data
                let meta = ('meta' in output.data) ? output.data.meta : res;

                vm.isBusy = false
                vm.totalRows = meta.total
                vm.from = meta.from
                vm.to = meta.to
                callback(res.data || vm.items)
              }, vm.delay)
            })
            .catch(error => {
              vm.isBusy = false
              callback([])
            })
        } else {
          return vm.items || []
        }
      },
      detail(item) {
        this.$router.push({name: 'trip-detail', params: { id: item.id }})
      },
      updatedata(item) {
        this.$router.push({name: 'trip-update', params: { id: item.id }})
      },
      drop(item) {
        let vm = this
        vm.$http.delete(vm.$app.route('trip.drop'), {
            data: { id: item.id }
        })
        .then(response => {
            this.$root.$emit('bv::refresh::table', 'table-trip')
        })
      }
    }
  }
</script>

<style lang="scss" scoped>

</style>

