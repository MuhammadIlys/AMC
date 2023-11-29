@extends('users.mocks_user.templates.main')
@section('main-container')


<style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      padding-top: 50px;
    }

    .test-card {
      border: 1px solid #ccc;
      padding: 20px;
      margin-bottom: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      background-color: #fff;
    }

    .test-card h3 {
      margin-bottom: 10px;
      color: #333;
    }

    .test-card p {
      color: #555;
      margin-bottom: 15px;
    }

    .test-card .info {
      font-size: 14px;
      color: #888;
      margin-bottom: 15px;
    }

    .launch-button {
      width: 100%;
      background-color: #013884;
      color: #fff;
      border: none;
    }

    .launch-button:hover {
      background-color: #0056b3;
      color:white;
    }

    .test-card:hover {
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
    }
  </style>






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
                                            <h5 class="statistics"><span>Mocks List</span>
                                            <hr style="width: 100%;">
                                        </div>
                                    </div>
                                </div>

                                <!-- start of mocks list -->

                                <div class="container" style="padding: 30px;">

                                    <div class="row">

                                        @foreach ($mocksData as $mock)
                                        <div class="col-md-4">
                                            <div class="test-card">
                                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                                    <h3 style="margin: 0;">{{ $mock['test_name'] }}</h3>
                                                    <span class="info" style="border: 2px solid #888; padding:2px; border-radius: 50%; text-align: center; width: 25px; height: 25px; display: flex; justify-content: center; align-items: center;">02</span>
                                                </div>
                                               <hr >
                                                <div class="info">
                                                    <span>Total Questions: {{ $mock['total_questions'] }}</span><br>
                                                    <span>Hard Questions: {{ $mock['hard_questions'] }}</span><br>
                                                    <span>Easy Questions: {{ $mock['easy_questions'] }}</span><br>
                                                    <span>Fair Questions: {{ $mock['fair_questions'] }}</span>
                                                </div>

                                                <button class="btn launch-button" data-test-id="{{ $mock['test_id'] }}">
                                                    <span class="loading-spinner" id="loading-spinner-{{ $mock['test_id'] }}"></span>
                                                    Launch Mocks
                                                </button>
                                            </div>

                                        </div>
                                    @endforeach


                                    </div>



                                </div>

                                <!-- end of mocks list -->







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




<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

 <script>

    $(document).ready(function () {
        $('.launch-button').on('click', function () {
            var button = $(this);
            var testId = button.data('test-id');

            // Disable the button while the AJAX request is in progress
            button.prop('disabled', true);

            // Make an AJAX request using jQuery
            $.ajax({
                url: '/store_user_mocks_id',
                type: 'GET',
                data: {
                    testId: testId
                },
                success: function (response) {

                    window.location.href ='/mocks_lunch';

                },
                error: function (error) {

                    // Enable the button after the AJAX request completes
                    button.prop('disabled', false);
                }
            });
        });
    });
</script>
@endsection
