<template>
    <div class="container">
        <Chart />
    </div>
</template>

<script>
import Chart from "./components/Chart.vue";

export default {
    name: "App",
    components: {
        Chart,
    },
    // created() {
    //     console.log("Component created.");
    // },
    // mounted() {
    //     console.log("Component mounted.");
    // },
    // beforeMount() {
    //     console.log("Component mounting.");
    // },
    // updated() {
    //     console.log("Component updated.");
    // },
};
</script>

<style scoped>
.container {
    width: 800px;
    margin: auto;
}
</style>
