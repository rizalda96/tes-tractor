<template>
    <div>
        <b-row class="d-flex justify-content-center mt-5">
            <b-col sm="5">
                <ValidationObserver v-slot="{ passes }" :slim="true">
                   <form @submit.prevent="passes(submit)">
                   <template>
                       <b-form-group
                       label-for="driver"
                       label="Driver"
                       >
                       <input type="hidden" v-model="model.driver">
                       <ValidationProvider
                           rules="required"
                           v-slot="{ valid, errors }"
                           name="Driver"
                           :debounce="250"
                       >
                           <b-form-select
                           v-model="model.driver"
                           :state="errors[0] ? false : (valid ? true : null)"
                           :disabled="isDetail"
                           :options="optionsDriver"
                           ></b-form-select>
                           <b-form-invalid-feedback>{{ errors[0] }}</b-form-invalid-feedback>
                       </ValidationProvider>
                       </b-form-group>
                   </template>
                   <template>
                       <b-form-group
                       label-for="plat_no"
                       label="Plat No"
                       >
                       <input type="hidden" v-model="model.plat_no">
                       <ValidationProvider
                           rules="required"
                           v-slot="{ valid, errors }"
                           name="Plat No"
                           :debounce="250"
                       >
                           <b-form-select
                           v-model="model.plat_no"
                           :state="errors[0] ? false : (valid ? true : null)"
                           :disabled="isDetail"
                           :options="optionsPlatNo"
                           ></b-form-select>
                           <b-form-invalid-feedback>{{ errors[0] }}</b-form-invalid-feedback>
                       </ValidationProvider>
                       </b-form-group>
                   </template>
                   <template>
                       <b-form-group
                       label-for="date"
                       label="Tanggal"
                       >
                       <input type="hidden" v-model="model.date">
                       <ValidationProvider
                           rules="required"
                           v-slot="{ valid, errors }"
                           name="date"
                           :debounce="250"
                       >
                           <b-form-input
                           id="date"
                           type="date"
                           v-model="model.date"
                           :state="errors[0] ? false : (valid ? true : null)"
                           :disabled="isDetail"
                           ></b-form-input>
                           <b-form-invalid-feedback>{{ errors[0] }}</b-form-invalid-feedback>
                       </ValidationProvider>
                       </b-form-group>
                   </template>
                   <template>
                       <b-form-group
                       label-for="point_start"
                       label="Point Start"
                       >
                       <input type="hidden" v-model="model.point_start">
                       <ValidationProvider
                           rules="required"
                           v-slot="{ valid, errors }"
                           name="Point Start"
                           :debounce="250"
                       >
                           <b-form-input
                           id="point_start"
                           v-model="model.point_start"
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
                       label-for="point_end"
                       label="Point End"
                       >
                       <input type="hidden" v-model="model.point_end">
                       <ValidationProvider
                           rules="required"
                           v-slot="{ valid, errors }"
                           name="Point End"
                           :debounce="250"
                       >
                           <b-form-input
                           id="point_end"
                           v-model="model.point_end"
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
                       label-for="distance"
                       label="Distance"
                       >
                       <input type="hidden" v-model="model.distance">
                       <ValidationProvider
                           rules="required|integer"
                           v-slot="{ valid, errors }"
                           name="Distance"
                           :debounce="250"
                       >
                           <b-form-input
                           id="distance"
                           v-model="model.distance"
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
                       label-for="standard_time"
                       label="Standard Time"
                       >
                       <input type="hidden" v-model="model.standard_time">
                       <ValidationProvider
                           rules="required|integer"
                           v-slot="{ valid, errors }"
                           name="Standard Time"
                           :debounce="250"
                       >
                           <b-form-input
                           id="standard_time"
                           v-model="model.standard_time"
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
                       label-for="priceper_km"
                       label="Priceper Km"
                       >
                       <input type="hidden" v-model="model.priceper_km">
                       <ValidationProvider
                           rules="required"
                           v-slot="{ valid, errors }"
                           name="Priceper Km"
                           :debounce="250"
                       >
                           <b-form-input
                           id="priceper_km"
                           v-model="model.priceper_km"
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
                       label-for="actual_time"
                       label="Actual Time"
                       >
                       <input type="hidden" v-model="model.actual_time">
                       <ValidationProvider
                           rules="required|integer"
                           v-slot="{ valid, errors }"
                           name="Actual Time"
                           :debounce="250"
                       >
                           <b-form-input
                           id="actual_time"
                           v-model="model.actual_time"
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
                       label-for="total_cost"
                       label="Total Cost"
                       >
                       <input type="hidden" v-model="model.total_cost">
                       <ValidationProvider
                           rules="required"
                           v-slot="{ valid, errors }"
                           name="Total Cost"
                           :debounce="250"
                       >
                           <b-form-input
                           id="total_cost"
                           v-model="model.total_cost"
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
        name: 'student-form',
        props: {
            id: null,
            // isDetail: false
        },
        data() {
            return {
                modelName: 'id',
                model: {
                    driver: null,
                    plat_no: null,
                    date: null,
                    point_start: null,
                    point_end: null,
                    distance: null,
                    standard_time: null,
                    priceper_km: null,
                    actual_time: null,
                    total_cost: null,
                },
                optionsDriver: [
                    { value: null, text: 'Please select an option' },
                    // { value: 'Jakarta', text: 'Jakarta' },
                ],
                optionsPlatNo: [
                    { value: null, text: 'Please select an option' },
                    // { value: 'Jakarta', text: 'Jakarta' },
                ]
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
            this.fetchDriver()
            this.fetchPlatNo()
            if (!this.isNew) {
                this.fetchData(this.id)
            }
        },
        methods: {
            async submit(){
                let action = this.isNew
                ? this.$app.route('trip.store')
                : this.$app.route('trip.update', {
                    'id': this.$route.params
                })

                let formData = this.$app.objectToFormData(this.model)

                if (!this.isNew) {
                    formData.append('_method', 'PUT')
                }

                this.$http.post(action, formData)
                .then(response => {
                    this.$router.push({name: 'trip-list'})
                    this.$root.$emit('bv::refresh::table', 'table-trip')
                })

            },
            async fetchData(params) {
                try {
                    if (!this.isNew) {
                        let { data } = await this.$http.get(
                            this.$app.route('trip.show', {
                                id: params
                            })
                        )

                        this.model.driver = data.data.driver_id
                        this.model.plat_no = data.data.vehicle_id
                        this.model.date = data.data.date
                        this.model.point_start = data.data.point_start
                        this.model.point_end = data.data.point_end
                        this.model.distance = data.data.distance
                        this.model.standard_time = data.data.standard_time
                        this.model.priceper_km = data.data.priceper_km
                        this.model.actual_time = data.data.actual_time
                        this.model.total_cost = data.data.total_cost

                    }
                } catch (error) {
                    console.log(error);
                }
            },
            async fetchDriver() {
                try {
                    if (!this.isDetail) {
                        let { data } = await this.$http.get(
                            this.$app.route('driver.get')
                        )
                        if (data.data.length > 0) {
                            _.map(data.data, el => {
                                this.optionsDriver.push({
                                    value: el.id,
                                    text: el.driver_name,
                                })
                            })
                        }
                    }
                } catch (error) {
                    console.log(error);
                }
            },
            async fetchPlatNo() {
                try {
                    if (!this.isDetail) {
                        let { data } = await this.$http.get(
                            this.$app.route('vehicle.get')
                        )
                        if (data.data.length > 0) {
                            _.map(data.data, el => {
                                this.optionsPlatNo.push({
                                    value: el.id,
                                    text: el.vehicle_plate_no,
                                })
                            })
                        }
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
