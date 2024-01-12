
@extends('users.qbank_user.templates.main')
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
                                                   Tests Performance
                                                </a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a id="analytics1" class="test-nav nav-link text-muted" data-bs-toggle="tab" href="#subject_wise_performance"
                                                   role="tab" aria-selected="false" tabindex="-1">
                                                    Systems Performance
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

// Extract the PHP data passed to the view
var chartData = @json($chartData);

// Extract test names for x-axis labels
var testNames = Object.keys(chartData);

// Add series data dynamically
var dynamicSeries = [];

Object.keys(chartData).forEach(function (seriesName, index) {
    var uniqueSeriesName = seriesName // Append index to make it unique
    var seriesData = chartData[seriesName].map(function (point) {

        return [new Date(point.date).getTime(), point.score ];
    });

    dynamicSeries.push({
        name: uniqueSeriesName,
        data: seriesData,
    });
});

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
    title: {text: "Tests Performance - Date vs Percentage ", align: "left", style: {fontWeight: 500}},
    xaxis: {
        type: "datetime",
        tickAmount: 10,
        labels: {
            formatter: function (timestamp) {
                return new Date(timestamp).toLocaleDateString();
            },
        },
        categories: Array.from(new Set(testNames.flatMap(function (seriesName) {
            return chartData[seriesName].map(function (point) {
                return point.date;
            });
        }))),
        tickPlacement: 'on',
        axisTicks: {
            show: false,
            borderType: 'solid',
            color: '#78909C',
            height: 6,
            offsetX: 0,
            offsetY: 0
        },
        title: {text: "Test Date"},
    },
    yaxis: {
        tickAmount: 7,
        title: {text: "Test Percentage"},
    },
    colors: chartScatterBasicColors,
    legend: {
        show: false,
    },
};

// Create the chart
var chart = new ApexCharts(document.querySelector("#basic_scatter"), options);
chart.render();



// ############################################# second chart for subject performance ########################


var linechartDatalabelColors = getChartColorsArray("line_chart_datalabel");

if (linechartDatalabelColors) {
    var options = {
        chart: {
            height: 380,
            type: "line",
            zoom: {enabled: !1},
            toolbar: {show: !1}
        },
        colors: linechartDatalabelColors,
        dataLabels: {enabled: !1},
        stroke: {width: [3, 3], curve: "straight"},
        series: [
            {
                name: "Correct Answers",
                data: [
                    @foreach($chartData2 as $data)
                        {{ $data['data']['correct'] }},
                    @endforeach
                ]
            },
            {
                name: "Incorrect Answers",
                data: [
                    @foreach($chartData2 as $data)
                        {{ $data['data']['incorrect'] }},
                    @endforeach
                ]
            },
            {
                name: "Omitted",
                data: [
                    @foreach($chartData2 as $data)
                        {{ $data['data']['omitted'] }},
                    @endforeach
                ]
            }
        ],
        title: {text: "Systems Performance - Correct vs Incorrect", align: "left", style: {fontWeight: 500}},
        grid: {row: {colors: ["transparent", "transparent"], opacity: .2}, borderColor: "#f1f1f1"},
        markers: {style: "inverted", size: 6},
        xaxis: {
            categories: [
                @foreach($chartData2 as $data)
                    "{{ $data['subject_name'] }}",
                @endforeach
            ],
            title: {text: "Systems"}
        },
        yaxis: {title: {text: "Number of Answers"}, min: 0, max: 500},
        legend: {show: false , position: "top", horizontalAlign: "right", floating: !0, offsetY: -25, offsetX: -5},
        responsive: [{breakpoint: 1000, options: {chart: {toolbar: {show: !1}}, legend: {show: !1}}}]
    };

    var chart = new ApexCharts(document.querySelector("#line_chart_datalabel"), options);
    chart.render();
}

//###################################### third chart for time management############################




var options, chart;

// Convert total time from hours to minutes
var chartDataInMinutes = <?php echo json_encode($chartData3); ?>.map((item, index)=> ({

    test_name: item.test_name + '_' + (index+1),
    total_time_spent: item.total_time_spent, // Do not multiply by 60
}));

// Color timeline chart
var chartTimelineColors = getChartColorsArray("color_timeline");
if (chartTimelineColors) {
    options = {
        series: [
            {
                data: chartDataInMinutes.map(item => ({
                    x: item.test_name,
                    y: [0, item.total_time_spent],
                    fillColor: chartTimelineColors[getRandomNumber()],
                })),
            },
        ],
        chart: { height: 350, type: "rangeBar", toolbar: { show: false } },
        plotOptions: { bar: { horizontal: true, distributed: true, dataLabels: { hideOverflowingLabels: false }, barHeight: '10%', } },
        dataLabels: {
                    enabled: false,
                    formatter: function (e, t) {
                        var xValue = t.w.config.series[0].data[t.dataPointIndex].x.split('_')[0]; // Extract original test name
                            // Display only the end value (e[1])
                            endTime = e[1].toString();
                        return xValue + ' (' + endTime + ' mins)';
                    },
                },
        title: { text: "Time Spent Per Test - Test vs Minutes", align: "left", style: { fontWeight: 500 } },
        xaxis: { type: "units", title: { text: "Minutes" }, },
        yaxis: { show: true, },
    };

    chart = new ApexCharts(document.querySelector("#color_timeline"), options);
    chart.render();
}


function getRandomNumber() {
  return Math.floor(Math.random() * 6); // Generates a random integer between 0 and 29
}








</script>











    @endsection
