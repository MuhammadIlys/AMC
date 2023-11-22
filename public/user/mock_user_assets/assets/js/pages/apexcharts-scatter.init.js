function getChartColorsArray(e) {
    if (null !== document.getElementById(e)) return e = document.getElementById(e).getAttribute("data-colors"), (e = JSON.parse(e)).map(function(e) {
        var t = e.replace(" ", "");
        return -1 === t.indexOf(",") ? getComputedStyle(document.documentElement).getPropertyValue(t) || t : 2 == (e = e.split(",")).length ? "rgba(" + getComputedStyle(document.documentElement).getPropertyValue(e[0]) + "," + e[1] + ")" : t
    });
}

// Call getChartColorsArray to initialize chartScatterBasicColors
var chartScatterBasicColors = getChartColorsArray("basic_scatter2");

// Dummy data for mock scores and dates
var mockScoresA = [
    [new Date("2023-11-01").getTime(), 500],
    [new Date("2023-11-05").getTime(), 72],
    [new Date("2023-11-10").getTime(), 90],
];

var mockScoresB = [
    [new Date("2023-11-02").getTime(), 65],
    [new Date("2023-11-07").getTime(), 78],
    [new Date("2023-11-12").getTime(), 88],
];

var mockScoresC = [
    [new Date("2023-11-03").getTime(), 75],
    [new Date("2023-11-08").getTime(), 82],
    [new Date("2023-11-15").getTime(), 95],
];

options = {
    series: [
        {
            name: "Mocks A",
            data: mockScoresA,
        },
        {
            name: "Mocks B",
            data: mockScoresB,
        },
        {
            name: "Mocks C",
            data: mockScoresC,
        },
    ],
    chart: {
        height: 350,
        type: "scatter",
        zoom: {
            enabled: true,
            type: "xy",
        },
        toolbar: {
            show: false,
        },
    },
    xaxis: {
        type: "datetime",
        tickAmount: 10,
        labels: {
            formatter: function (timestamp) {
                return new Date(timestamp).toLocaleDateString();
            },
        },
    },
    yaxis: {
        tickAmount: 7,
    },
    colors: chartScatterBasicColors,
};

// Create the chart
var chart = new ApexCharts(document.querySelector("#basic_scatter2"), options);
chart.render();
