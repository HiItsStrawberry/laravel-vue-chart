<template>
    <div>
        <canvas id="myChart" width="400" height="400"></canvas>
    </div>
</template>

<script>
import Chart from "chart.js/auto";
import { chartType, chartOptions, optionOverview } from "./Configuration.js";

export default {
    Name: "ShowChart",
    data() {
        return {
            title: Object,
            datasets: Array,
        };
    },
    props: {
        days: Array,
        chartData: Array,
        overviewOption: null,
    },
    methods: {
        displayRevenue() {
            this.chartData.forEach((c) => {
                if (c.Price > 10.0) {
                    chartOptions.scales.y.ticks.stepSize = 10;
                    return;
                }
            });

            const temp = {
                isCancelled: this.chartData.filter((d) => d.isCancelled == 1),
                notCancelledData: this.chartData.filter(
                    (d) => d.isCancelled == 0
                ),
            };

            this.datasets = [
                {
                    label: "Cancelled Order",
                    data: this.days.map((d) => {
                        const findDay = temp.isCancelled.find(
                            (item) => item.Day == d
                        );
                        return findDay ? findDay.Price : 0;
                    }),
                    borderWidth: 2,
                    borderColor: "rgb(255, 0, 0, 1)",
                    backgroundColor: "rgb(255, 0, 0, 0.5)",
                    hoverBackgroundColor: "rgb(255, 0, 0, 1)",
                },
                {
                    label: "Total Earning",
                    data: this.days.map((d) => {
                        const findDay = temp.notCancelledData.find(
                            (item) => item.Day == d
                        );
                        return findDay ? findDay.Price : 0;
                    }),
                    borderWidth: 3,
                    borderColor: "rgb(0,255, 0, 1)",
                    backgroundColor: "rgb(0, 255, 0, 0.5)",
                    hoverBackgroundColor: "rgb(0,255, 0, 1)",
                },
            ];
        },
        displayOrder() {
            chartOptions.scales.y.ticks.stepSize = 1;
            this.chartData.forEach((c) => {
                if (c.Total > 10) {
                    chartOptions.scales.y.ticks.stepSize = 10;
                    return;
                }
            });

            const temp = {
                isCancelled: this.chartData.filter((d) => d.isCancelled == 1),
                notCancelledData: this.chartData.filter(
                    (d) => d.isCancelled == 0
                ),
            };

            this.datasets = [
                {
                    label: "Cancelled Order",
                    data: this.days.map((d) => {
                        const findDay = temp.isCancelled.find(
                            (item) => item.Day == d
                        );
                        return findDay ? findDay.Total : 0;
                    }),
                    borderWidth: 2,
                    borderColor: "rgb(255, 0, 0, 1)",
                    backgroundColor: "rgb(255, 0, 0, 0.5)",
                    hoverBackgroundColor: "rgb(255, 0, 0, 1)",
                },
                {
                    label: "Total Order",
                    data: this.days.map((d) => {
                        const findDay = temp.notCancelledData.find(
                            (item) => item.Day == d
                        );
                        return findDay ? findDay.Total : 0;
                    }),
                    borderWidth: 3,
                    borderColor: "rgb(0,255, 0, 1)",
                    backgroundColor: "rgb(0, 255, 0, 0.5)",
                    hoverBackgroundColor: "rgb(0,255, 0, 1)",
                },
            ];
        },
        createChart() {
            chartOptions.scales.y.title.text = this.title.value;
            const ctx = document.getElementById("myChart");
            const chart = new Chart(ctx, {
                type: chartType,
                data: {
                    labels: this.days,
                    datasets: this.datasets,
                },
                options: chartOptions,
            });
        },
        loadingData() {
            return new Promise((resolve) => {
                resolve(this.chartData.length - 1);
            });
        },
    },
    created() {
        this.loadingData().then((value) => {
            console.log(value);
            if (value) {
                var res = optionOverview.find(
                    (x) => x.id == this.overviewOption
                );
                if (res.id == 1) {
                    this.displayRevenue();
                } else if (res.id == 2) {
                    res.value = "Total Orders";
                    this.displayOrder();
                }
                this.title = res;
                this.createChart();
            }
        });
    },
};
</script>
