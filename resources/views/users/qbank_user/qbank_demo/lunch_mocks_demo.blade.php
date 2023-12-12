@extends('users.mocks_user.demo.templates.main')
@section('main-container')

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
                                                <h5 class="statistics"><span>Statistics</span>
                                                <hr style="width: 100%;">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xxl-3 col-sm-6 col-lg-3">
                                            <!--//-->
                                            <div class="card-body">
                                                <div id="mocks_performance" data-colors='["#4caf50", "#e74c3c", "#3498db", "#f39c12", "#9b59b6", "#34495e"]' class="apex-charts" dir="ltr"></div>
                                            </div><!-- end card body -->
                                            <!--//-->
                                        </div>
                                        <div class="col-xxl-3 col-sm-6 col-lg-4">
                                            <table class="table align-middle table-nowrap mb-0">
                                                <h5 class="ms-2 score-title">Mocks Performance</h5>
                                                <tbody>
                                                <tr>
                                                    <th scope="row"><a href="#" class="fw-medium">Mocks Completed</a></th>
                                                    <td> <div class="score-badge float-end">10</div></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><a href="#" class="fw-medium">Mocks Passed</a></th>
                                                    <td> <div class="score-badge float-end">7</div></td>
                                                </tr>
                                                <tr>

                                                    <th scope="row"><a href="#" class="fw-medium">Mocks Failed</a></th>
                                                    <td> <div class="score-badge float-end">3</div></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-xxl-3 col-sm-6 col-lg-4">
                                            <table class="table align-middle table-nowrap mb-0">
                                                <h5 class="ms-2 score-title">Time Performance</h5>
                                                <tbody>
                                                <tr>
                                                    <th scope="row"><a href="#" class="fw-medium">Last Recent Mocks</a></th>
                                                    <td> <div class="score-badge float-end">03:08</div></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><a href="#" class="fw-medium">Avg. Time per Mocks</a></th>
                                                    <td> <div class="score-badge float-end">02:50</div></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><a href="#" class="fw-medium">Other Users Average Time</a></th>
                                                    <td> <div class="score-badge float-end">03:05</div></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xxl-3 col-sm-6 col-lg-3">
                                            <!--//-->
                                            <div class="card-body">
                                                <div id="difficulty_performance" data-colors='["#4caf50", "#e74c3c", "#3498db", "#f39c12", "#9b59b6", "#34495e"]' class="apex-charts" dir="ltr"></div>
                                            </div><!-- end card body -->
                                            <!--//-->
                                        </div>
                                        <div class="col-xxl-3 col-sm-6 col-lg-4">
                                            <table class="table align-middle table-nowrap mb-0">
                                                <h5 class="ms-2 score-title">Difficulty  Performance</h5>
                                                <tbody>

                                                <tr>
                                                    <th scope="row"><a href="#" class="fw-medium">Corrects Questions</a></th>
                                                    <td> <div class="score-badge float-end">50</div></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><a href="#" class="fw-medium">Incorrects Questions</a></th>
                                                    <td> <div class="score-badge float-end">75</div></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><a href="#" class="fw-medium">Omitted Questions</a></th>
                                                    <td> <div class="score-badge float-end">25</div></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>



                                        <div class="col-xxl-3 col-sm-6 col-lg-4">
                                            <table class="table align-middle table-nowrap mb-0">
                                                <h5 class="ms-2 score-title" style="visibility: hidden">Count</h5>
                                                <tbody>
                                                <tr>
                                                    <th scope="row"><a href="#" class="fw-medium">Hard Correct Questions</a></th>
                                                    <td> <div class="score-badge float-end">75</div></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><a href="#" class="fw-medium">Fair Correct Questions</a></th>
                                                    <td> <div class="score-badge float-end">50</div></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><a href="#" class="fw-medium">Easy Correct Questions</a></th>
                                                    <td> <div class="score-badge float-end">25</div></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>


                                    </div>

                                    <div class="row">
                                        <div class="col-xxl-3 col-sm-6 col-lg-3">
                                            <!--//-->
                                            <div class="card-body">
                                                <div id="subject_performance" data-colors='["#4caf50", "#e74c3c", "#3498db", "#f39c12", "#9b59b6", "#34495e"]' class="apex-charts" dir="ltr"></div>
                                            </div><!-- end card body -->
                                            <!--//-->
                                        </div>
                                        <div class="col-xxl-3 col-sm-6 col-lg-4">
                                            <table class="table align-middle table-nowrap mb-0">
                                                <h5 class="ms-2 score-title">Subjects Performance</h5>
                                                <tbody>
                                                <tr>
                                                    <th scope="row"><a href="#" class="fw-medium">Obstetrics Gynecology</a></th>
                                                    <td> <div class="score-badge float-end">35/100</div></td>
                                                </tr>

                                                <tr>
                                                    <th scope="row"><a href="#" class="fw-medium">Medicine</a></th>
                                                    <td> <div class="score-badge float-end">50/120</div></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><a href="#" class="fw-medium">Surgery</a></th>
                                                    <td> <div class="score-badge float-end">30/60</div></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-xxl-3 col-sm-6 col-lg-4">
                                            <table class="table align-middle table-nowrap mb-0">
                                                <h5 class="ms-2 score-title" style="visibility:hidden">Subjects Performance</h5>
                                                <tbody>
                                                <tr>
                                                    <th scope="row"><a href="#" class="fw-medium">Psychiatry</a></th>
                                                    <td> <div class="score-badge float-end">25/50</div></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><a href="#" class="fw-medium">Pediatrics</a></th>
                                                    <td> <div class="score-badge float-end">20/30</div></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><a href="#" class="fw-medium">Public Health</a></th>
                                                    <td> <div class="score-badge float-end">18/35</div></td>
                                                </tr>
                                                </tbody>
                                            </table>
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

         <!-- ApexCharts CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.27.1/dist/apexcharts.min.css">

        <!-- ApexCharts JS -->
        <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.27.1/dist/apexcharts.min.js"></script>

        <!-- Optional: To use lodash, required by ApexCharts -->
        <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.21/dist/lodash.min.js"></script>



    <script>

            var totalMocksCompleted  = 10;
            var totalMocksPassed = 7;
            var totalMocksFailed = 3;

            var averageTimeSpent= 2;

            var averageTimeSpentRecentMock = 3;
            var otherUserAverageTimeSpent = 3;








            function getChartColorsArray(elementId) {
                var element = document.getElementById(elementId);

                if (element !== null) {
                    var colorsAttribute = element.getAttribute("data-colors");

                    if (colorsAttribute) {
                        return JSON.parse(colorsAttribute.replace(/--/g, ""));
                    } else {
                        console.warn("data-colors Attribute not found on:", elementId);
                    }
                }
            }

            var options, chart;

            //########################### mocks performance  ###############################


            var donutchartportfolioColors = getChartColorsArray("mocks_performance");

            var MarketchartColors = (donutchartportfolioColors && (options = {
                series: [totalMocksCompleted, totalMocksPassed, totalMocksFailed, averageTimeSpentRecentMock, averageTimeSpent, otherUserAverageTimeSpent],
                labels: ["Mocks Completed", "Mocks Passed", "Mocks Failed", "Avg. Time Spent Recent", "Avg. Time Spent", "Other Users Avg. Time Spent"],
                chart: { type: "donut", height: 224 },
                plotOptions: {
                    pie: {
                        size: 100,
                        offsetX: 0,
                        offsetY: 0,
                        donut: {
                            size: "86%",
                            labels: {
                                show: true,
                                name: { show: true, fontSize: "18px", offsetY: -5 },
                                value: {
                                    show: true,
                                    fontSize: "20px",
                                    color: "#343a40",
                                    fontWeight: 500,
                                    offsetY: 5,
                                    formatter: function (e) {
                                        return "" + e;
                                    }
                                },
                                total: {
                                    show: true,
                                    fontSize: "13px",
                                    label: "Mocks Completed",
                                    color: "#9599ad",
                                    fontWeight: 500,
                                    formatter: function (e) {
                                        return "" + totalMocksCompleted; // Display the value of totalMocksCompleted
                                    }
                                }
                            }
                        }
                    }
                },
                dataLabels: { enabled: false },
                legend: { show: false },
                yaxis: {
                    labels: {
                        formatter: function (e) {
                            return "" + e;
                        }
                    }
                },
                stroke: { lineCap: "round", width: 2 },
                colors: donutchartportfolioColors
            }, (chart = new ApexCharts(document.querySelector("#mocks_performance"), options)).render()));


            //########################### Difficulty performance analytics  ###############################



          var totalCorrectQuestions=50;
          var totalIncorrectQuestions=75;
          var totalOmittedQuestions=25;
          var totalHardQuestions =75;
          var totalFairQuestions=50;
          var totalEasyQuestions= 25;


            var donutchartportfolioColors = getChartColorsArray("difficulty_performance");

            var MarketchartColors = (donutchartportfolioColors && (options = {
                series: [totalCorrectQuestions, totalIncorrectQuestions, totalOmittedQuestions, totalHardQuestions, totalFairQuestions, totalEasyQuestions],
                labels: ["Correct Questions", "Incorrect Questions", "Omitted Question", "Hard Questions", "Fair Questions", "Easy Question"],
                chart: { type: "donut", height: 224 },
                plotOptions: {
                    pie: {
                        size: 100,
                        offsetX: 0,
                        offsetY: 0,
                        donut: {
                            size: "86%",
                            labels: {
                                show: true,
                                name: { show: true, fontSize: "18px", offsetY: -5 },
                                value: {
                                    show: true,
                                    fontSize: "20px",
                                    color: "#343a40",
                                    fontWeight: 500,
                                    offsetY: 5,
                                    formatter: function (e) {
                                        return "" + e;
                                    }
                                },
                                total: {
                                    show: true,
                                    fontSize: "13px",
                                    label: "Correct Question",
                                    color: "#9599ad",
                                    fontWeight: 500,
                                    formatter: function (e) {
                                        return "" + totalCorrectQuestions; // Display the value of totalMocksCompleted
                                    }
                                }
                            }
                        }
                    }
                },
                dataLabels: { enabled: false },
                legend: { show: false },
                yaxis: {
                    labels: {
                        formatter: function (e) {
                            return "" + e;
                        }
                    }
                },
                stroke: { lineCap: "round", width: 2 },
                colors: donutchartportfolioColors
            }, (chart = new ApexCharts(document.querySelector("#difficulty_performance"), options)).render()));



            //########################### Subjects performance analytics  ###############################




            var  obstetricsGynecology = 35;
            var medicine=50;
            var surgery =30;
            var psychiatry= 25;
            var pediatrics=20;
            var publicHealth=18;



            var donutchartportfolioColors = getChartColorsArray("subject_performance");

            var MarketchartColors = (donutchartportfolioColors && (options = {
                series: [obstetricsGynecology, medicine, surgery, psychiatry, pediatrics, publicHealth],
                labels: ["Obstetrics Gynecology", "Medicine", "Surgery", "Psychiatry", "Pediatrics", "Public Health"],
                chart: { type: "donut", height: 224 },
                plotOptions: {
                    pie: {
                        size: 100,
                        offsetX: 0,
                        offsetY: 0,
                        donut: {
                            size: "86%",
                            labels: {
                                show: true,
                                name: { show: true, fontSize: "18px", offsetY: -5 },
                                value: {
                                    show: true,
                                    fontSize: "20px",
                                    color: "#343a40",
                                    fontWeight: 500,
                                    offsetY: 5,
                                    formatter: function (e) {
                                        return "" + e;
                                    }
                                },
                                total: {
                                    show: true,
                                    fontSize: "13px",
                                    label: "Obstetrics Gynecology",
                                    color: "#9599ad",
                                    fontWeight: 500,
                                    formatter: function (e) {
                                        return "" + obstetricsGynecology; // Display the value of totalMocksCompleted
                                    }
                                }
                            }
                        }
                    }
                },
                dataLabels: { enabled: false },
                legend: { show: false },
                yaxis: {
                    labels: {
                        formatter: function (e) {
                            return "" + e;
                        }
                    }
                },
                stroke: { lineCap: "round", width: 2 },
                colors: donutchartportfolioColors
            }, (chart = new ApexCharts(document.querySelector("#subject_performance"), options)).render()));



    </script>

@endsection

