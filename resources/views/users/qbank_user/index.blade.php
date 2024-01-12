@extends('users.qbank_user.templates.main')
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
                                                <h5 class="ms-2 score-title">Your Score</h5>
                                                <tbody>
                                                <tr>
                                                    <th scope="row"><a href="#" class="fw-medium">Total Correct</a></th>
                                                    <td> <div class="score-badge float-end">{{ $totalCorrectCount ?? 0 }}</div></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><a href="#" class="fw-medium">Total Incorrect</a></th>
                                                    <td> <div class="score-badge float-end">{{ $totalIncorrectCount ?? 0 }}</div></td>
                                                </tr>
                                                <tr>

                                                    <th scope="row"><a href="#" class="fw-medium">Total Omitted</a></th>
                                                    <td> <div class="score-badge float-end">{{ $totalOmittedCount ?? 0 }}</div></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-xxl-3 col-sm-6 col-lg-4">
                                            <table class="table align-middle table-nowrap mb-0">
                                                <h5 class="ms-2 score-title">Time Performance (MM:SS)</h5>
                                                <tbody>
                                                <tr>
                                                    <th scope="row"><a href="#" class="fw-medium">Last Recent Test</a></th>
                                                    <td> <div class="score-badge float-end">{{ $totalTimeSpentRecentTest ?? 0 }}</div></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><a href="#" class="fw-medium">Avg. Time per Test</a></th>
                                                    <td> <div class="score-badge float-end">{{ $formattedAverageTimeSpent ?? 0 }}</div></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><a href="#" class="fw-medium">Other Users Average Time</a></th>
                                                    <td> <div class="score-badge float-end">30:44</div></td>
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
                                                <h5 class="ms-2 score-title">QBank Usage</h5>
                                                <tbody>
                                                <tr>
                                                    <th scope="row"><a href="#" class="fw-medium">Used Questions</a></th>
                                                    <td> <div class="score-badge float-end">{{ $totalUsedQuestionCount ?? 0 }}</div></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><a href="#" class="fw-medium">Unused Questions</a></th>
                                                    <td> <div class="score-badge float-end">{{ $totalUnusedQuestionCount ?? 0 }}</div></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><a href="#" class="fw-medium">Total Questions</a></th>
                                                    <td> <div class="score-badge float-end">{{ $totalQuestionCount ?? 0 }}</div></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-xxl-3 col-sm-6 col-lg-4">
                                            <table class="table align-middle table-nowrap mb-0">
                                                <h5 class="ms-2 score-title" >Questions Activities</h5>
                                                <tbody>
                                                <tr>
                                                    <th scope="row"><a href="#" class="fw-medium">Marked Questions</a></th>
                                                    <td> <div class="score-badge float-end">{{ $totalMarkedQuestionCount ?? 0 }}</div></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><a href="#" class="fw-medium">Notes Questions</a></th>
                                                    <td> <div class="score-badge float-end">{{ $totalNoteQuestionCount ?? 0 }}</div></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><a href="#" class="fw-medium">Highlight Questions</a></th>
                                                    <td> <div class="score-badge float-end">{{ $totalHighlightQuestionCount ?? 0 }}</div></td>
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
                                                <h5 class="ms-2 score-title">Test Count</h5>
                                                <tbody>
                                                <tr>
                                                    <th scope="row"><a href="#" class="fw-medium">Tests Created</a></th>
                                                    <td> <div class="score-badge float-end">{{ $totalTestCount ?? 0 }}</div></td>
                                                </tr>

                                                <tr>
                                                    <th scope="row"><a href="#" class="fw-medium">Tests Completed</a></th>
                                                    <td> <div class="score-badge float-end">{{ $totalCompleteTestCount ?? 0 }}</div></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><a href="#" class="fw-medium">Suspended Tests</a></th>
                                                    <td> <div class="score-badge float-end">{{ $totalSuspendTestCount ?? 0 }}</div></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-xxl-3 col-sm-6 col-lg-4">
                                            <table class="table align-middle table-nowrap mb-0">
                                                <h5 class="ms-2 score-title" >Test Performance</h5>
                                                <tbody>
                                                <tr>
                                                    <th scope="row"><a href="#" class="fw-medium">Tests between 70% & 100%</a></th>
                                                    <td> <div class="score-badge float-end">{{  $totalTestAbove70Count ?? 0 }}</div></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><a href="#" class="fw-medium">Tests between 30% & 50%</a></th>
                                                    <td> <div class="score-badge float-end">{{ $totalTestBelow50Count ?? 0 }}</div></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><a href="#" class="fw-medium">Tests between 10% & 30%</a></th>
                                                    <td> <div class="score-badge float-end">{{ $totalTestBelow30Count ?? 0 }}</div></td>
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

            var totalCorrectCount  = {{ $totalCorrectCount ?? 0 }};
            var totalIncorrectCount = {{ $totalIncorrectCount ?? 0 }};
            var totalOmittedCount = {{ $totalOmittedCount ?? 0 }};
            var totalTimeSpentRecentTest = '{{ $totalTimeSpentRecentTest ?? 0 }}';
            var formattedAverageTimeSpent= '{{ $formattedAverageTimeSpent ?? 0 }}';
            var otherUserAverageTimeSpent = '30:44';

          // Given time in MM:SS format
        var otherUserAverageTimeSpent = "30:44";

        // Split the time into minutes and seconds MM:SS formate
        var timeParts = otherUserAverageTimeSpent.split(":");
        var minutes = parseInt(timeParts[0], 10);
        var Seconds = parseInt(timeParts[1], 10);

        otherUserAverageTimeSpent= Math.round(minutes + Seconds / 60);

        // Split the time into minutes and seconds MM:SS formate
        var timeParts = totalTimeSpentRecentTest.split(":");
        var minutes = parseInt(timeParts[0], 10);
        var Seconds = parseInt(timeParts[1], 10);

        totalTimeSpentRecentTest= Math.round(minutes + Seconds / 60);


        // Split the time into minutes and seconds MM:SS formate
        var timeParts = formattedAverageTimeSpent.split(":");
        var minutes = parseInt(timeParts[0], 10);
        var Seconds = parseInt(timeParts[1], 10);

        formattedAverageTimeSpent= Math.round(minutes + Seconds / 60);





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
                series: [totalCorrectCount, totalIncorrectCount, totalOmittedCount, totalTimeSpentRecentTest, formattedAverageTimeSpent, otherUserAverageTimeSpent],
                labels: ["Total Correct", "Total Incorrect", "Total Omitted", "Time Spent Recent", "Avg. Time Spent", "Other Users Avg. Time Spent"],
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
                                    label: "Total Correct",
                                    color: "#9599ad",
                                    fontWeight: 500,
                                    formatter: function (e) {
                                        return "" + totalCorrectCount; // Display the value of totalMocksCompleted
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



          var totalUsedQuestionCount={{ $totalUsedQuestionCount ?? 0 }};
          var totalUnusedQuestionCount={{ $totalUnusedQuestionCount ?? 0 }};
          var totalQuestionCount={{ $totalQuestionCount ?? 0 }};
          var totalMarkedQuestionCount ={{ $totalMarkedQuestionCount ?? 0 }};
          var totalNoteQuestionCount={{ $totalNoteQuestionCount ?? 0 }};
          var totalHighlightQuestionCount= {{ $totalHighlightQuestionCount ?? 0 }};


            var donutchartportfolioColors = getChartColorsArray("difficulty_performance");

            var MarketchartColors = (donutchartportfolioColors && (options = {
                series: [totalUsedQuestionCount, totalUnusedQuestionCount, totalQuestionCount, totalMarkedQuestionCount, totalNoteQuestionCount, totalHighlightQuestionCount],
                labels: ["Used Questions", "Unused Questions", "Total Questions", "Marked Questions", "Notes Questions", "Highlight Questions"],
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
                                    label: "Used Questions",
                                    color: "#9599ad",
                                    fontWeight: 500,
                                    formatter: function (e) {
                                        return "" + totalUsedQuestionCount; // Display the value of totalMocksCompleted
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




            var  totalTestCount = {{ $totalTestCount ?? 0 }};
            var totalCompleteTestCount={{ $totalCompleteTestCount ?? 0 }};
            var totalSuspendTestCount ={{ $totalSuspendTestCount ?? 0 }};
            var totalTestAbove70Count= {{ $totalTestAbove70Count ?? 0 }};
            var totalTestBelow50Count={{ $totalTestBelow50Count ?? 0 }};
            var totalTestBelow30Count={{ $totalTestBelow30Count ?? 0 }};



            var donutchartportfolioColors = getChartColorsArray("subject_performance");

            var MarketchartColors = (donutchartportfolioColors && (options = {
                series: [totalTestCount, totalCompleteTestCount, totalSuspendTestCount, totalTestAbove70Count, totalTestBelow50Count, totalTestBelow30Count],
                labels: ["Tests Created", "Tests Completed", "Suspended Tests", "70% & 100%", "30% & 50%", "10% & 30%"],
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
                                    label: "Tests Created",
                                    color: "#9599ad",
                                    fontWeight: 500,
                                    formatter: function (e) {
                                        return "" + totalTestCount; // Display the value of totalMocksCompleted
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

