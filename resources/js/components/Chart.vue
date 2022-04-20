<template>
    <div class="flexbox">
        <div class="flexbox">
            <h3>Overview</h3>
            <SelectBox
                :currentOption="overviewOption"
                :options="optionsValue[0]"
                @current-option="fetchOrder"
            />
        </div>
        <div>
            <SelectBox
                :currentOption="month"
                :options="optionsValue[1]"
                @current-option="fetchRevenue"
            />
        </div>
    </div>

    <div v-if="isLoading" class="wrapper">
        <div class="loader"></div>
        <div>
            <h4>Loading Chart...</h4>
        </div>
    </div>
    <ShowChart
        v-else
        :overviewOption="overviewOption"
        :days="days"
        :chartData="chartData"
    />
</template>

<script>
import SelectBox from "./SelectBox.vue";
import ShowChart from "./ShowChart.vue";
import { optionOverview, optionMonths } from "./Configuration.js";

export default {
    Name: "Chart",
    components: {
        SelectBox,
        ShowChart,
    },
    data() {
        return {
            days: [],
            chartData: Array,
            isLoading: Boolean,
            loadingTime: 600,
            overviewOption: 1,
            year: new Date().getFullYear(),
            month: new Date().getMonth() + 1,
            optionsValue: [optionOverview, optionMonths],
        };
    },
    methods: {
        async loadData() {
            try {
                this.isLoading = true;
                const { data } = await axios.get(
                    `api/order/revenue/${this.month}/${this.year}`
                );
                this.chartData = data;
            } catch (error) {
                console.log(error);
                this.isLoading = false;
            }
        },
        async fetchRevenue(selectedMonth) {
            this.month = selectedMonth;
            await this.loadData().then(
                setTimeout(() => {
                    this.isLoading = false;
                }, this.loadingTime)
            );
        },
        async fetchOrder(selectedOverview) {
            this.overviewOption = selectedOverview;
            await this.loadData().then(
                setTimeout(() => {
                    this.isLoading = false;
                }, this.loadingTime)
            );
        },
    },
    async created() {
        var days = new Date(this.year, this.month, 0).getDate();
        for (let day = 1; day <= days; ++day) {
            this.days.push(day);
        }

        await this.loadData().then(
            setTimeout(() => {
                this.isLoading = false;
            }, this.loadingTime)
        );
    },
};
</script>

<style scoped>
.flexbox {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.wrapper {
    display: flex;
    height: 400px;
    align-items: center;
    justify-content: center;
}

.wrapper > div {
    margin: 0.5rem;
}

.loader {
    border: 5px solid #f3f3f3;
    border-radius: 50%;
    border-left: 5px solid #000000;
    border-right: 5px solid #000000;
    width: 20px;
    height: 20px;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}
</style>
