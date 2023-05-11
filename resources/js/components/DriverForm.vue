<template>
    <div>
        <b-row class="d-flex justify-content-center mt-5">
            <b-col sm="5">
                <ValidationObserver v-slot="{ passes }" :slim="true">
                   <form @submit.prevent="passes(submit)">
                   <template>
                       <b-form-group
                       label-for="fullname"
                       label="Nama"
                       >
                       <input type="hidden" v-model="model.fullname">
                       <ValidationProvider
                           rules="required|min:3"
                           v-slot="{ valid, errors }"
                           name="Nama"
                           :debounce="250"
                       >
                           <b-form-input
                           id="fullname"
                           v-model="model.fullname"
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
                       label-for="telp"
                       label="Telp"
                       >
                       <input type="hidden" v-model="model.telp">
                       <ValidationProvider
                           rules="required|integer|max:14"
                           v-slot="{ valid, errors }"
                           name="Telp"
                           :debounce="250"
                       >
                           <b-form-input
                           id="telp"
                           v-model="model.telp"
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
        name: 'driver-form',
        props: {
            id: null,
            // isDetail: false
        },
        data() {
            return {
                modelName: 'id',
                model: {
                    fullname: null,
                    telp: null,
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
                ? this.$app.route('driver.store')
                : this.$app.route('driver.update', {
                    'id': this.$route.params
                })

                let formData = this.$app.objectToFormData(this.model)

                if (!this.isNew) {
                    formData.append('_method', 'PUT')
                }

                this.$http.post(action, formData)
                .then(response => {
                    this.$router.push({name: 'driver-list'})
                    this.$root.$emit('bv::refresh::table', 'table-driver')
                })

            },
            async fetchData(params) {
                try {
                    if (!this.isNew) {
                        let { data } = await this.$http.get(
                            this.$app.route('driver.show', {
                                id: params
                            })
                        )

                        this.model.fullname = data.data.driver_name
                        this.model.telp = data.data.driver_phone

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
