
@extends('users.mocks_user.templates.main')
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

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-xxl-12">
                                            <div class="welcome-title">
                                                <h5 class="statistics"><span>Graphs</span>
                                                <hr style="width: 100%;">
                                            </div>
                                        </div>
                                    </div>

                                   <!-- chart start-->

                                    <!-- Your existing scatter plot containers -->
                                    <div id="basic_scatter" data-colors="[&quot;--vz-primary&quot;, &quot;--vz-success&quot;, &quot;--vz-warning&quot;]" class="apex-charts" dir="ltr" style="min-height: 365px; max-width:95%">
                                    </div>
                                   <!--chart end-->


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

// Log the chartData to the console for debugging
console.log('chartData:', chartData);

// Extract test names for x-axis labels
var testNames = Object.keys(chartData);

// Log the testNames to the console for debugging
console.log('testNames:', testNames);

// Add series data dynamically
var dynamicSeries = [];

Object.keys(chartData).forEach(function (seriesName) {
    var seriesData = chartData[seriesName].map(function (point) {
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
    },
    yaxis: {
        tickAmount: 7,
    },
    colors: chartScatterBasicColors,
};

// Create the chart
var chart = new ApexCharts(document.querySelector("#basic_scatter"), options);
chart.render();


</script>





    @endsection
