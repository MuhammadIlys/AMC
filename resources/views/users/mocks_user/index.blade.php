@extends('users.mocks_user.templates.main')
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
                                                <div id="portfolio_donut_charts" data-colors='["--vz-success", "--vz-danger", "--vz-info"]' class="apex-charts" dir="ltr"></div>
                                            </div><!-- end card body -->
                                            <!--//-->
                                        </div>
                                        <div class="col-xxl-3 col-sm-6 col-lg-4">
                                            <table class="table align-middle table-nowrap mb-0">
                                                <h5 class="ms-2 score-title">Mocks Performance</h5>
                                                <tbody>
                                                <tr>
                                                    <th scope="row"><a href="#" class="fw-medium">Mocks Completed</a></th>
                                                    <td> <div class="score-badge float-end">{{ $totalMocksCompleted ?? 0 }}</div></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><a href="#" class="fw-medium">Mocks Passed</a></th>
                                                    <td> <div class="score-badge float-end">{{ $totalMocksPassed ?? 0 }}</div></td>
                                                </tr>
                                                <tr>

                                                    <th scope="row"><a href="#" class="fw-medium">Mocks Failed</a></th>
                                                    <td> <div class="score-badge float-end">{{ $totalMocksFailed ?? 0 }}</div></td>
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
                                                    <td> <div class="score-badge float-end">{{ $averageTimeSpentRecentMock ?? 0 }}</div></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><a href="#" class="fw-medium">Avg. Time per Mocks</a></th>
                                                    <td> <div class="score-badge float-end">{{ $averageTimeSpent ?? 0 }}</div></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><a href="#" class="fw-medium">Other Users Average Time</a></th>
                                                    <td> <div class="score-badge float-end">0.8</div></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xxl-3 col-sm-6 col-lg-3">
                                            <!--//-->
                                            <div class="card-body">
                                                <div id="qbank_charts" data-colors='["--vz-success", "--vz-danger", "--vz-info"]' class="apex-charts" dir="ltr"></div>
                                            </div><!-- end card body -->
                                            <!--//-->
                                        </div>
                                        <div class="col-xxl-3 col-sm-6 col-lg-4">
                                            <table class="table align-middle table-nowrap mb-0">
                                                <h5 class="ms-2 score-title">Difficulty  Performance</h5>
                                                <tbody>
                                                <tr>
                                                    <th scope="row"><a href="#" class="fw-medium">Total Corrects Questions</a></th>
                                                    <td> <div class="score-badge float-end">{{ $totalCorrectQuestions ?? 0 }}</div></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><a href="#" class="fw-medium">Total Incorrects Questions</a></th>
                                                    <td> <div class="score-badge float-end">{{ $totalIncorrectQuestions ?? 0 }}</div></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><a href="#" class="fw-medium">Total Omitted Questions</a></th>
                                                    <td> <div class="score-badge float-end">{{ $totalOmittedQuestions ?? 0 }}</div></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-xxl-3 col-sm-6 col-lg-4">
                                            <table class="table align-middle table-nowrap mb-0">
                                                <h5 class="ms-2 score-title" style="visibility: hidden">Total Count</h5>
                                                <tbody>
                                                <tr>
                                                    <th scope="row"><a href="#" class="fw-medium">Total Hard Correct Questions</a></th>
                                                    <td> <div class="score-badge float-end">{{ $totalHardQuestions ?? 0 }}</div></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><a href="#" class="fw-medium">Total Fair Correct Questions</a></th>
                                                    <td> <div class="score-badge float-end">{{ $totalFairQuestions ?? 0 }}</div></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><a href="#" class="fw-medium">Total Easy Correct Questions</a></th>
                                                    <td> <div class="score-badge float-end">{{ $totalEasyQuestions ?? 0 }}</div></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>


                                    </div>

                                    <div class="row">
                                        <div class="col-xxl-3 col-sm-6 col-lg-3">
                                            <!--//-->
                                            <div class="card-body">
                                                <div id="qbank_charts2" data-colors='["--vz-success", "--vz-danger", "--vz-info"]' class="apex-charts" dir="ltr"></div>
                                            </div><!-- end card body -->
                                            <!--//-->
                                        </div>
                                        <div class="col-xxl-3 col-sm-6 col-lg-4">
                                            <table class="table align-middle table-nowrap mb-0">
                                                <h5 class="ms-2 score-title">Subjects Performance</h5>
                                                <tbody>
                                                <tr>
                                                    <th scope="row"><a href="#" class="fw-medium">Obstetrics Gynecology</a></th>
                                                    <td> <div class="score-badge float-end">{{ $totalCorrectQuestionsPerSubject['Obstetrics Gynecology'] ?? 0 }}</div></td>
                                                </tr>

                                                <tr>
                                                    <th scope="row"><a href="#" class="fw-medium">Medicine</a></th>
                                                    <td> <div class="score-badge float-end">{{ $totalCorrectQuestionsPerSubject['Medicine'] ?? 0 }}</div></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><a href="#" class="fw-medium">Surgery</a></th>
                                                    <td> <div class="score-badge float-end">{{ $totalCorrectQuestionsPerSubject['Surgery'] ?? 0 }}</div></td>
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
                                                    <td> <div class="score-badge float-end">{{ $totalCorrectQuestionsPerSubject['Psychiatry'] ?? 0 }}</div></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><a href="#" class="fw-medium">Pediatrics</a></th>
                                                    <td> <div class="score-badge float-end">{{ $totalCorrectQuestionsPerSubject['Pediatrics'] ?? 0 }}</div></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><a href="#" class="fw-medium">Public Health</a></th>
                                                    <td> <div class="score-badge float-end">{{ $totalCorrectQuestionsPerSubject['Public Health'] ?? 0 }}</div></td>
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

        @endsection

