<template>
    <div>
        <b-row class="d-flex justify-content-center mt-5">
            <b-col sm="8">
                <router-link :to="{ name: 'trip-list' }">Trip</router-link> |
                <router-link :to="{ name: 'driver-list' }">Driver</router-link> |
                <router-link :to="{ name: 'vehicle-list' }">Vehicle</router-link>
            </b-col>
        </b-row>
        <router-view></router-view>
    </div>
</template>

<script>
    export default {
        name: 'container'
    }
</script>

<style lang="scss" scoped>

</style>
