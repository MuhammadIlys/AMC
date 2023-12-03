
@extends('users.mocks_user.demo.templates.main')
@section('main-container')

<style>


    #chart {
      width: 500px;
      height: 360px;
    }
</style>

  <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col">

                        <div class="h-100">
                            <div class="card">

                                <div class="card-header align-items-center d-flex">
                                    <div class="flex-shrink-0 ms-2">
                                        <ul class="nav justify-content-end nav-tabs-custom rounded card-header-tabs border-bottom-0 fs-19"
                                            role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <a id="result1" class="test-nav nav-link text-muted active" data-bs-toggle="tab"
                                                   href="#mocks_performance"
                                                   role="tab" aria-selected="false" tabindex="-1">
                                                   Mocks Performance
                                                </a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a id="analytics1" class="test-nav nav-link text-muted" data-bs-toggle="tab" href="#subject_wise_performance"
                                                   role="tab" aria-selected="false" tabindex="-1">
                                                    Subjects Performance
                                                </a>
                                            </li>

                                            <li class="nav-item" role="presentation">
                                                <a id="analytics1" class="test-nav nav-link text-muted" data-bs-toggle="tab" href="#time_management"
                                                   role="tab" aria-selected="false" tabindex="-1">
                                                   Time Management
                                                </a>
                                            </li>
                                        </ul>
                                    </div>



                                </div>

                                <div class="card-body">


                                    <!--tab start -->
                                    <div class="tab-content text-muted">

                                        <div class="tab-pane active show" id="mocks_performance" role="tabpanel">

                                            <!-- mocks performance chart start-->


                                                <div id="basic_scatter" data-colors="[&quot;--vz-primary&quot;, &quot;--vz-success&quot;, &quot;--vz-warning&quot;, &quot;--vz-danger&quot;, &quot;--vz-dark&quot;, &quot;--vz-info&quot;]" class="apex-charts" dir="ltr" style="min-height: 365px; max-width:95%">
                                                </div>
                                            <!--mocks performance chart end-->
                                        </div>

                                        <div class="tab-pane  show" id="subject_wise_performance" role="tabpanel">

                                            <!-- Subject Wise Performance chart start-->
                                            <div id="line_chart_datalabel" data-colors="[&quot;--vz-primary&quot;, &quot;--vz-success&quot;, &quot;--vz-warning&quot;, &quot;--vz-danger&quot;, &quot;--vz-dark&quot;, &quot;--vz-info&quot;]" class="apex-charts" dir="ltr" style="min-height: 395px; max-width:95%">
                                            </div>
                                            <!-- Subject Wise Performance chart end-->
                                        </div>

                                        <div class="tab-pane  show" id="time_management" role="tabpanel">

                                            <!-- time management chart start-->
                                            <div id="color_timeline" data-colors="[&quot;--vz-primary&quot;, &quot;--vz-success&quot;, &quot;--vz-warning&quot;, &quot;--vz-danger&quot;, &quot;--vz-dark&quot;, &quot;--vz-info&quot;]"  class="apex-charts" dir="ltr" style="min-height: 365px;">
                                            </div>
                                            <!-- time management chart end-->
                                        </div>

                                    </div>




                            </div>

                            </div>
                            <!--end row-->

                        </div> <!-- end .h-100-->

                    </div> <!-- end col -->

                </div>

            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        <!-- Include the ApexCharts library -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>


<script>
 // Function to get chart colors
function getChartColorsArray(e) {
    if (null !== document.getElementById(e)) {
        return e = document.getElementById(e).getAttribute("data-colors"), (e = JSON.parse(e)).map(function (e) {
            var t = e.replace(" ", "");
            return -1 === t.indexOf(",") ? getComputedStyle(document.documentElement).getPropertyValue(t) || t : 2 == (e = e.split(",")).length ? "rgba(" + getComputedStyle(document.documentElement).getPropertyValue(e[0]) + "," + e[1] + ")" : t
        });
    }
}

// Call getChartColorsArray to initialize chartScatterBasicColors
var chartScatterBasicColors = getChartColorsArray("basic_scatter");

// Dummy data for testing
var dummyData = {
    MocksDemo1: [
        { date: "2023-02-01", score: 75 },
        { date: "2023-05-01", score: 85 },
        { date: "2023-06-01", score: 90 },
    ],
    MocksDemo2: [
        { date: "2023-07-01", score: 65 },
        { date: "2023-01-01", score: 75 },
        { date: "2023-08-01", score: 80 },
    ],
    MocksDemo3: [
        { date: "2023-03-01", score: 65 },
        { date: "2023-04-01", score: 75 },
        { date: "2023-09-01", score: 80 },
    ],
    // Add more series if needed
};



// Extract test names for x-axis labels
var testNames = Object.keys(dummyData);


// Add series data dynamically
var dynamicSeries = [];

Object.keys(dummyData).forEach(function (seriesName) {
    var seriesData = dummyData[seriesName].map(function (point) {
        return [new Date(point.date).getTime(), point.score];
    });

    dynamicSeries.push({
        name: seriesName,
        data: seriesData,
    });

    // Log each seriesData to the console for debugging
    console.log('seriesData for ' + seriesName + ':', seriesData);
});

// Log the dynamicSeries to the console for debugging
console.log('dynamicSeries:', dynamicSeries);

// ApexCharts configuration
var options = {
    series: dynamicSeries,
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
    title: {text: "Mocks Performance - Date vs Score ", align: "left", style: {fontWeight: 500}},
    xaxis: {
        type: "datetime",
        tickAmount: 10,
        labels: {
            formatter: function (timestamp) {
                return new Date(timestamp).toLocaleDateString();
            },
        },
        categories: Array.from(new Set(testNames.flatMap(function (seriesName) {
            return dummyData[seriesName].map(function (point) {
                return point.date;
            });
        }))),
        tickPlacement: 'on',
        axisTicks: {
            show: true,
            borderType: 'solid',
            color: '#78909C',
            height: 6,
            offsetX: 0,
            offsetY: 0
        },
        title: {text: "Mocks Date"},
    },
    yaxis: {
        tickAmount: 7,
        title: {text: "Mocks Score"},
    },
    colors: chartScatterBasicColors,
};

// Create the chart
var chart = new ApexCharts(document.querySelector("#basic_scatter"), options);
chart.render();


// ############################################# second chart for subject performance ########################


// Get chart colors array for line chart data labels
var linechartDatalabelColors = getChartColorsArray("line_chart_datalabel");

if (linechartDatalabelColors) {
    // Dummy data for testing
    var dummyChartData = [
        { subject_name: "Pediatrics", data: { correct: 80, incorrect: 20, omitted: 5 } },
        { subject_name: "Medicine", data: { correct: 75, incorrect: 25, omitted: 8 } },
        { subject_name: "Surgery", data: { correct: 90, incorrect: 10, omitted: 3 } },
        { subject_name: "Public Health", data: { correct: 40, incorrect: 15, omitted: 55 } },
        { subject_name: "Psychiatry", data: { correct: 22, incorrect: 80, omitted: 44 } },
        // Add more data points if needed
    ];

    // Log the dummyChartData to the console for debugging
    console.log('dummyChartData:', dummyChartData);

    // Extract data for each series dynamically
    var seriesData = [
        {
            name: 'Correct',
            data: dummyChartData.map(function (dataPoint) {
                return dataPoint.data.correct;
            })
        },
        {
            name: 'Incorrect',
            data: dummyChartData.map(function (dataPoint) {
                return dataPoint.data.incorrect;
            })
        },
        {
            name: 'Omitted',
            data: dummyChartData.map(function (dataPoint) {
                return dataPoint.data.omitted;
            })
        }
    ];

    // Log the seriesData to the console for debugging
    console.log('seriesData:', seriesData);

    // ApexCharts configuration
    var options = {
        chart: {
            height: 380,
            type: "line",
            zoom: { enabled: false },
            toolbar: { show: false }
        },
        colors: linechartDatalabelColors,
        dataLabels: { enabled: false },
        stroke: { width: [3, 3, 3], curve: "straight" },
        series: seriesData,
        title: { text: "Subjects Performance - Correct vs Incorrect vs Omitted", align: "left", style: { fontWeight: 500 } },
        grid: { row: { colors: ["transparent", "transparent"], opacity: 0.2 }, borderColor: "#f1f1f1" },
        markers: { style: "inverted", size: 6 },
        xaxis: {
            categories: dummyChartData.map(function (dataPoint) {
                return dataPoint.subject_name;
            }),
            title: { text: "Subjects" }
        },
        yaxis: { title: { text: "Number of Answers" }, min: 0, max: 100 },
        legend: { position: "top", horizontalAlign: "right", floating: true, offsetY: -25, offsetX: -5 },
        responsive: [{ breakpoint: 600, options: { chart: { toolbar: { show: false } }, legend: { show: false } } }]
    };

    // Create the chart
    var chart = new ApexCharts(document.querySelector("#line_chart_datalabel"), options);
    chart.render();
}


//###################################### third chart for time management############################



// Color timeline chart
var chartTimelineColors = getChartColorsArray("color_timeline");

if (chartTimelineColors) {
    // Dummy data for testing
    var dummyChartData3 = [
        { test_name: "Mocks Demo1", total_time_spent: 3 },
        { test_name: "Mocks Demo2", total_time_spent: 2 },
        { test_name: "Mocks Demo3", total_time_spent: 3 },
        // Add more data points if needed
    ];

    // Log the dummyChartData3 to the console for debugging
    console.log('dummyChartData3:', dummyChartData3);

    options = {
        series: [
            {
                data: dummyChartData3.map(item => ({
                    x: item.test_name,
                    y: [0, item.total_time_spent],
                    fillColor: chartTimelineColors[getRandomNumber()],
                })),
            },
        ],
        chart: { height: 350, type: "rangeBar", toolbar: { show: false } },
        plotOptions: { bar: { horizontal: true, distributed: true, dataLabels: { hideOverflowingLabels: false } } },
        dataLabels: {
            enabled: true,
            formatter: function (e, t) {
                var xValue = t.w.config.series[0].data[t.dataPointIndex].x,
                    // Calculate the difference in numbers instead of days
                    diff = e[1] - e[0];
                return xValue;
            },
        },
        title: { text: "Time Spent Per mocks - Mocks vs Hours", align: "left", style: { fontWeight: 500 } },
        xaxis: { type: "units", title: { text: "Hours" } },
        yaxis: { show: true },
    };

    chart = new ApexCharts(document.querySelector("#color_timeline"), options);
    chart.render();
}

function getRandomNumber() {
    return Math.floor(Math.random() * 6); // Generates a random integer between 0 and 5
}









</script>











@endsection
