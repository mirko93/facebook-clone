<template>
    <div class="flex flex-col flex-1 h-screen overflow-y-hidden">
        <Nav />

        <div class="flex flex-1 overflow-y-hidden">
            <Sidebar />

            <div class="w-2/3 overflow-x-hidden">
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>

<script>
import Nav from './Nav';
import Sidebar from './Sidebar';

    export default {
        name: "App",

        components: {
            Nav,
            Sidebar,
        },

        mounted() {
            this.$store.dispatch('fetchAuthUser');
        }
    }
</script>

<style lang="scss" scoped>

</style>