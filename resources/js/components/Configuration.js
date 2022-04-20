export const chartType = "bar";

export const chartOptions = {
    aspectRatio: 2,
    elements: {
        bar: {},
    },
    plugins: {
        legend: {
            reverse: false,
            align: "start",
            position: "top",
            rtl: true,
            labels: {
                boxWidth: 10,
                usePointStyle: true,
                color: "black",
                font: {
                    size: 14,
                    weight: "bold",
                },
            },
        },
    },
    scales: {
        x: {
            type: "category",
            title: {
                text: "Time",
                display: true,
                align: "end",
                font: {
                    size: 16,
                    weight: "bold",
                },
                color: "black",
            },
            grid: {
                display: false,
            },
            stacked: true,
            ticks: {
                callback: function (value, index, ticks) {
                    const day = [1, 15, 30];
                    return day.includes(index + 1) ? value + 1 : null;
                },
                font: {
                    size: 14,
                    weight: "bold",
                },
                color: "black",
            },
        },
        y: {
            title: {
                text: "Revenue ($)",
                display: true,
                font: {
                    size: 16,
                    weight: "bold",
                },
                color: "black",
            },
            stacked: true,
            ticks: {
                font: {
                    size: 14,
                    weight: "bold",
                },
                color: "black",
                beginAtZero: true,
                stepSize: 1,
            },
        },
    },
    interaction: {
        mode: "index",
    },
};

export const optionMonths = [
    {
        id: 1,
        text: "January",
    },
    {
        id: 2,
        text: "February",
    },
    {
        id: 3,
        text: "March",
    },
    {
        id: 4,
        text: "April",
    },
    {
        id: 5,
        text: "May",
    },
    {
        id: 6,
        text: "June",
    },
    {
        id: 7,
        text: "July",
    },
    {
        id: 8,
        text: "August",
    },
    {
        id: 9,
        text: "September",
    },
    {
        id: 10,
        text: "October",
    },
    {
        id: 11,
        text: "November",
    },
    {
        id: 12,
        text: "December",
    },
];

export const optionOverview = [
    {
        id: 1,
        text: "Earnings",
        value: "Revenue ($)",
    },
    {
        id: 2,
        text: "Orders",
        value: "Total Orders",
    },
];
