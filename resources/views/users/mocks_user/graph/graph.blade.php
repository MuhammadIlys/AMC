
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


                                   <div style="width: 100%;">
                                    <canvas id="testScoreChart" style="height: 360px;"></canvas>
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


 <!-- Include the Chart.js library -->
 <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            // Retrieve the dynamic data from PHP
            var dynamicData = [
                {"test": "Mocks 1", "score": 85},
                {"test": "Mocks 2", "score": 92},
                {"test": "Mocks 3", "score": 78},
                {"test": "Mocks 4", "score": 89}
            ];

            // Prepare data for Chart.js
            var labels = dynamicData.map(item => item.test);
            var data = dynamicData.map(item => item.score);

            // Determine the maximum y-axis value (rounded up to the nearest hundred)
            var maxScore = Math.ceil(Math.max(...data) / 100) * 100;

            // Create and render the chart
            var ctx = document.getElementById('testScoreChart').getContext('2d');
            var testScoreChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Mocks Scores',
                        data: data,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            max: maxScore,  // Set the maximum y-axis value to the determined max score
                            beginAtZero: true,
                            stepSize: 100,
                            callback: function (value, index, values) {
                                return value;  // Display y-axis labels as is (100, 200, 300, ...)
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Mocks'
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false // Hide legend for this example
                        }
                    },
                    layout: {
                        padding: {
                            left: 10,
                            right: 10,
                            top: 10,
                            bottom: 10
                        }
                    },
                    responsive: true,
                    maintainAspectRatio: false,
                    barPercentage: 0.3, // Adjust the bar width as a percentage of available space
                    categoryPercentage: 0.7 // Adjust the space between bars as a percentage of available space
                }
            });
        </script>



    @endsection
