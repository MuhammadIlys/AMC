<!DOCTYPE html>
<html lang="en">
  <head>
    <!--  Title -->
    <title>Super admin </title>
    <!--  Required Meta Tag -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="handheldfriendly" content="true" />
    <meta name="MobileOptimized" content="width" />
    <meta name="description" content="Mordenize" />
    <meta name="author" content="" />
    <meta name="keywords" content="Mordenize" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--  Favicon -->
    <link rel="shortcut icon" type="image/png" href="https://aceamcq.com/wp-content/uploads/2023/07/WhatsApp_Image_2023-08-04_at_7.55.46_PM-removebg-preview.png" />

    <!-- Owl Carousel -->
    <link rel="stylesheet" href="{{ asset('super_admin_assets/css/owl.carousel.min.css')}}">
    <!-- Datatable -->
    <link rel="stylesheet" href="{{ asset('super_admin_assets/css/dataTables.bootstrap5.min.css')}}">
       <!-- summernote cdn -->
       <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
       <!-- summernote -->
       <link rel="stylesheet" href="{{ asset('super_admin_assets/css/summernote-lite.min.css')}}">
    <!-- Core Css -->
    <link    rel="stylesheet" href="{{ asset('super_admin_assets/css/style.min.css') }}" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>






    <script>

function displaySuccessAlert(title, message) {
                    Swal.fire({
                        icon: 'success',
                        title: title,
                        text: message,
                        showConfirmButton: false,
                        timer: 2000,
                        customClass: {
                            popup: 'animated tada' // Add your custom animation class
                        },
                        background: '#fff', // Change the background color
                        iconColor: '#28a745', // Change the success icon color
                        timerProgressBar: true // Show a progress bar during the timer
                    });
                }


                function displayErrorAlert(title, message) {
                Swal.fire({
                    icon: 'error',
                    title: title,
                    text: message,
                    showConfirmButton: false,
                    timer: 2000,
                    customClass: {
                        popup: 'animated tada' // Add your custom animation class
                    },
                    background: '#fff', // Change the background color
                    iconColor: '#dc3545', // Change the error icon color to red
                    timerProgressBar: true // Show a progress bar during the timer
                });
            }
    </script>

    <!-- remove icon from summernote after icon -->
    <style>

        .dropdown-toggle::after{
            display:none;
        }

    </style>


  </head>


    <!-- Preloader -->
    <div class="preloader">
      <img src="https://aceamcq.com/wp-content/uploads/2023/07/WhatsApp_Image_2023-08-04_at_7.55.46_PM-removebg-preview.png" alt="loader" class="lds-ripple img-fluid" />
    </div>
    <!-- Preloader -->
    <div class="preloader">
      <img src="https://aceamcq.com/wp-content/uploads/2023/07/WhatsApp_Image_2023-08-04_at_7.55.46_PM-removebg-preview.png" alt="loader" class="lds-ripple img-fluid" />
    </div>

    <body>


<!--  Body Wrapper -->
<div class="page-wrapper" id="main-wrapper" data-theme="blue_theme"  data-layout="vertical" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">



