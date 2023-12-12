@extends('users.mocks_user.demo.templates.main')
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
                                            <h5 class="statistics"><span>Mocks Demo List</span>
                                            <hr style="width: 100%;">
                                        </div>
                                    </div>
                                </div>

                                <!-- start of mocks list -->

                                <div class="container" style="padding: 30px;">

                                    <div class="row">


                                        <div class="col-md-4">
                                            <div class="test-card">
                                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                                    <h3 style="margin: 0;">Mocks Demo1</h3>
                                                    <span class="info" style="border: 2px solid #888; padding:2px; border-radius: 50%; text-align: center; width: 25px; height: 25px; display: flex; justify-content: center; align-items: center;">05</span>
                                                </div>
                                               <hr >
                                                <div class="info">
                                                    <span>Total Questions: 150</span><br>
                                                    <span>Hard Questions: 40</span><br>
                                                    <span>Easy Questions: 60</span><br>
                                                    <span>Fair Questions: 50</span>
                                                </div>

                                                <button class="btn launch-button" >

                                                    Launch Demo Mocks
                                                </button>
                                            </div>

                                        </div>


                                        <div class="col-md-4">
                                            <div class="test-card">
                                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                                    <h3 style="margin: 0;">Mocks Demo2</h3>
                                                    <span class="info" style="border: 2px solid #888; padding:2px; border-radius: 50%; text-align: center; width: 25px; height: 25px; display: flex; justify-content: center; align-items: center;">03</span>
                                                </div>
                                               <hr >
                                                <div class="info">
                                                    <span>Total Questions: 150</span><br>
                                                    <span>Hard Questions: 60</span><br>
                                                    <span>Easy Questions: 50</span><br>
                                                    <span>Fair Questions: 40</span>
                                                </div>

                                                <button class="btn launch-button" >

                                                    Launch Demo Mocks
                                                </button>
                                            </div>

                                        </div>

                                        <div class="col-md-4">
                                            <div class="test-card">
                                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                                    <h3 style="margin: 0;">Mocks Demo3</h3>
                                                    <span class="info" style="border: 2px solid #888; padding:2px; border-radius: 50%; text-align: center; width: 25px; height: 25px; display: flex; justify-content: center; align-items: center;">02</span>
                                                </div>
                                               <hr >
                                                <div class="info">
                                                    <span>Total Questions: 150</span><br>
                                                    <span>Hard Questions: 50</span><br>
                                                    <span>Easy Questions: 50</span><br>
                                                    <span>Fair Questions: 50</span>
                                                </div>

                                                <button class="btn launch-button" >

                                                    Launch Demo Mocks
                                                </button>
                                            </div>

                                        </div>



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

            window.location.href ='/mocks_demo_exam_lunch';

        });
    });
</script>


<script>
// Document ready function
$(document).ready(function () {

    // Clear stored data
    localStorage.removeItem('timer');
    localStorage.removeItem('currentQuestionIndex');
    localStorage.removeItem('questionData');
    localStorage.removeItem('startTimeForNextQuestion');

});


</script>
@endsection
