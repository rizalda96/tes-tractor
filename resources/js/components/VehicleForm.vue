<template>
    <div>
        <b-row class="d-flex justify-content-center mt-5">
            <b-col sm="5">
                <ValidationObserver v-slot="{ passes }" :slim="true">
                   <form @submit.prevent="passes(submit)">
                   <template>
                       <b-form-group
                       label-for="plat_no"
                       label="Plat No"
                       >
                       <input type="hidden" v-model="model.plat_no">
                       <ValidationProvider
                           rules="required"
                           v-slot="{ valid, errors }"
                           name="Nama"
                           :debounce="250"
                       >
                           <b-form-input
                           id="plat_no"
                           v-model="model.plat_no"
                           :state="errors[0] ? false : (valid ? true : null)"
                           autofocus
                           :disabled="isDetail"
                           ></b-form-input>
                           <b-form-invalid-feedback>{{ errors[0] }}</b-form-invalid-feedback>
                       </ValidationProvider>
                       </b-form-group>
                   </template>
                   <template>
                       <b-form-group
                       label-for="tipe"
                       label="Tipe"
                       >
                       <input type="hidden" v-model="model.tipe">
                       <ValidationProvider
                           rules="required"
                           v-slot="{ valid, errors }"
                           name="tipe"
                           :debounce="250"
                       >
                           <b-form-input
                           id="tipe"
                           v-model="model.tipe"
                           :state="errors[0] ? false : (valid ? true : null)"
                           autofocus
                           :disabled="isDetail"
                           ></b-form-input>
                           <b-form-invalid-feedback>{{ errors[0] }}</b-form-invalid-feedback>
                       </ValidationProvider>
                       </b-form-group>
                   </template>
                   <div class="text-right mt-4 pt-3">
                       <b-button ref="closebtn" variant="secondary" @click="$router.go(-1)">
                       kembali
                       </b-button>
                       <b-button type="submit" variant="primary" v-if="!isDetail">
                       simpan
                       </b-button>
                   </div>
                   </form>
               </ValidationObserver>
            </b-col>
        </b-row>
    </div>
</template>

<script>
    import { extend } from 'vee-validate'

    export default {
        name: 'vehicle-form',
        props: {
            id: null,
            // isDetail: false
        },
        data() {
            return {
                modelName: 'id',
                model: {
                    plat_no: null,
                    tipe: null,
                },
            }
        },
        computed: {
            isNew() {
                return this.id === undefined || this.id === null
            },
            isDetail() {
                if (!this.isNew) {
                    let route = this.$route.path.split('/').pop()
                    if (route == 'detail') {
                        return true
                    }
                }
                return false
            }
        },
        async created() {
            if (!this.isNew) {
                this.fetchData(this.id)
            }
        },
        methods: {
            async submit(){
                let action = this.isNew
                ? this.$app.route('vehicle.store')
                : this.$app.route('vehicle.update', {
                    'id': this.$route.params
                })

                let formData = this.$app.objectToFormData(this.model)

                if (!this.isNew) {
                    formData.append('_method', 'PUT')
                }

                this.$http.post(action, formData)
                .then(response => {
                    this.$router.push({name: 'vehicle-list'})
                    this.$root.$emit('bv::refresh::table', 'table-vehicle')
                })

            },
            async fetchData(params) {
                try {
                    if (!this.isNew) {
                        let { data } = await this.$http.get(
                            this.$app.route('vehicle.show', {
                                id: params
                            })
                        )

                        this.model.plat_no = data.data.vehicle_plate_no
                        this.model.tipe = data.data.vehicle_type

                    }
                } catch (error) {
                    console.log(error);
                }
            },
        }
    }
</script>

<style lang="scss" scoped>

</style>
