 <!-- Sidebar Start -->
 <aside class="left-sidebar">
        <!-- Sidebar scroll-->
        <div>
          <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="{{ url('/dashboard') }}" class="text-nowrap logo-img">
                <img src="https://aceamcq.com/wp-content/uploads/2023/07/WhatsApp_Image_2023-08-04_at_7.55.46_PM-removebg-preview.png" width="80" height="80" alt="">
            </a>
            <div class="close-btn d-lg-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
              <i class="ti ti-x fs-8 text-muted"></i>
            </div>
          </div>
          <!-- Sidebar navigation-->
          <nav class="sidebar-nav scroll-sidebar" data-simplebar>
            <ul id="sidebarnav">
              <!-- ============================= -->
              <!-- Home -->
              <!-- ============================= -->
              <li class="nav-small-cap">
                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                <span class="hide-menu">AMC Qbank</span>
              </li>
              <!-- =================== -->
              <!-- AMC Qbank -->
              <!-- =================== -->

              <li class="sidebar-item">
                <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
                  <span class="d-flex">
                    <i class="ti ti-file-text"></i>
                  </span>
                  <span class="hide-menu">Qbanks Upload </span>
                </a>
                <ul aria-expanded="false" class="collapse first-level">
                  <li class="sidebar-item">
                    <a href="{{ url('/qbank_upload_image_view') }}" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu">Upload Image</span>
                    </a>
                  </li>
                  <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu">Upload Video</span>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
                  <span class="d-flex">
                    <i class="ti ti-file-export"></i>
                  </span>
                  <span class="hide-menu">Qbanks</span>
                </a>
                <ul aria-expanded="false" class="collapse first-level">
                  <li class="sidebar-item">
                    <a href="{{ url('/qbank_qbank_view') }}" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu">View Qbanks</span>
                    </a>
                  </li>
                   <li class="sidebar-item">
                    <a href="{{ url('/qbank_qbank_add_view') }}" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu">Add Qbanks</span>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
                  <span class="d-flex">
                    <i class="ti ti-calendar"></i>
                  </span>
                  <span class="hide-menu">Qbank Systems</span>
                </a>
                <ul aria-expanded="false" class="collapse first-level">
                  <li class="sidebar-item">
                    <a href="{{ url('/qbank_system_view') }}" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu">View Systems</span>
                    </a>
                  </li>
                  <li class="sidebar-item">
                    <a href="{{ url('/qbank_system_add_view') }}" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu">Add Systems</span>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="sidebar-item">
                <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
                  <span class="d-flex">
                    <i class="ti ti-calendar"></i>
                  </span>
                  <span class="hide-menu">Qbank Questions</span>
                </a>
                <ul aria-expanded="false" class="collapse first-level">
                  <li class="sidebar-item">
                    <a href="{{ url('/qbank_question_view') }}" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu">View Questions</span>
                    </a>
                  </li>
                  <li class="sidebar-item">
                    <a href="{{ url('/qbank_question_add_view') }}" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu">Add Questions</span>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="sidebar-item">
                <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
                  <span class="d-flex">
                    <i class="ti ti-calendar"></i>
                  </span>
                  <span class="hide-menu">Qbank Demo </span>
                </a>
                <ul aria-expanded="false" class="collapse first-level">
                  <li class="sidebar-item">
                    <a href="{{ url('/qbank_demo_question_view') }}" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu">View Questions</span>
                    </a>
                  </li>
                  <li class="sidebar-item">
                    <a href="{{ url('/qbank_question_demo_add_view') }}" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu">Add Questions</span>
                    </a>
                  </li>
                </ul>
              </li>



              <!-- ============================= -->
              <!-- AMC Recalls -->
              <!-- ============================= -->
              <li class="nav-small-cap">
                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                <span class="hide-menu">AMC Recalls</span>
              </li>

              <li class="sidebar-item">
                <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
                  <span class="d-flex">
                    <i class="ti ti-cards"></i>
                  </span>
                  <span class="hide-menu">Recalls Upload</span>
                </a>
                <ul aria-expanded="false" class="collapse first-level">
                  <li class="sidebar-item">
                    <a href="{{ url('/recalls_upload_image_view') }}" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu">Upload Image</span>
                    </a>
                  </li>
                   <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu">Upload Video</span>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
                  <span class="d-flex">
                    <i class="ti ti-file"></i>
                  </span>
                  <span class="hide-menu">Recalls Years</span>
                </a>
                <ul aria-expanded="false" class="collapse first-level">
                  <li class="sidebar-item">
                    <a href="{{ url('/recalls_year_view') }}" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu">View Years</span>
                    </a>
                  </li>
                    <li class="sidebar-item">
                    <a href="{{ url('/recalls_year_add_view') }}" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu">Add Year</span>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
                  <span class="d-flex">
                    <i class="ti ti-article"></i>
                  </span>
                  <span class="hide-menu">Recalls System</span>
                </a>
                <ul aria-expanded="false" class="collapse first-level">
                   <li class="sidebar-item">
                    <a href="{{ url('/recalls_system_view') }}" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu">View System</span>
                    </a>
                  </li>
                  <li class="sidebar-item">
                    <a href="{{ url('/recalls_system_add_view') }}" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu">Add System</span>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
                  <span class="d-flex">
                    <i class="ti ti-file-dots"></i>
                  </span>
                  <span class="hide-menu">Recalls Question</span>
                </a>
                <ul aria-expanded="false" class="collapse first-level">
                   <li class="sidebar-item">
                    <a href="{{ url('/recalls_question_view') }}" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu">View Question</span>
                    </a>
                  </li>
                  <li class="sidebar-item">
                    <a href="{{ url('/recalls_question_add_view') }}" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu">Add Question</span>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
                  <span class="d-flex">
                    <i class="ti ti-cards"></i>
                  </span>
                  <span class="hide-menu">Recalls Demo</span>
                </a>
                <ul aria-expanded="false" class="collapse first-level">
                  <li class="sidebar-item">
                    <a href="{{ url('/recalls_demo_question_view') }}" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu">View Question</span>
                    </a>
                  </li>
                   <li class="sidebar-item">
                    <a href="{{ url('/recalls_demo_question_add_view') }}" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu">Add Question</span>
                    </a>
                  </li>
                </ul>
              </li>

                <!-- ============================= -->
              <!-- AMC Mocks Test -->
              <!-- ============================= -->
              <li class="nav-small-cap">
                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                <span class="hide-menu">AMC Mocks</span>
              </li>

                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
                    <span class="d-flex">
                        <i class="ti ti-file-description"></i>
                    </span>
                    <span class="hide-menu">Mocks Uploads</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">

                        <li class="sidebar-item">
                            <a href="{{ url('/show_mocks_image_view') }}" class="sidebar-link">
                            <div class="round-16 d-flex align-items-center justify-content-center">
                                <i class="ti ti-circle"></i>
                            </div>
                            <span class="hide-menu">Upload Images</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link">
                            <div class="round-16 d-flex align-items-center justify-content-center">
                                <i class="ti ti-circle"></i>
                            </div>
                            <span class="hide-menu">Upload Video</span>
                            </a>
                        </li>

                    </ul>
                </li>



                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
                    <span class="d-flex">
                        <i class="ti ti-file-description"></i>
                    </span>
                    <span class="hide-menu">Mocks Subjects</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">

                        <li class="sidebar-item">
                            <a href="{{ url('/subject_view') }}" class="sidebar-link">
                            <div class="round-16 d-flex align-items-center justify-content-center">
                                <i class="ti ti-circle"></i>
                            </div>
                            <span class="hide-menu">Subject View</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ url('/subject_add') }}" class="sidebar-link">
                            <div class="round-16 d-flex align-items-center justify-content-center">
                                <i class="ti ti-circle"></i>
                            </div>
                            <span class="hide-menu">Add Subject</span>
                            </a>
                        </li>

                    </ul>
                </li>


              <li class="sidebar-item">
                <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
                  <span class="d-flex">
                    <i class="ti ti-check"></i>
                  </span>
                  <span class="hide-menu">Mocks Speciality</span>
                </a>
                <ul aria-expanded="false" class="collapse first-level">
                  <li class="sidebar-item">
                    <a href="{{ url('/speciality_view') }}" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu">Speciality View</span>
                    </a>
                  </li>

                  <li class="sidebar-item">
                    <a href="{{ url('/speciality_add') }}" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu">Add Speciality</span>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
                  <span class="d-flex">
                    <i class="ti ti-border-top"></i>
                  </span>
                  <span class="hide-menu">Mocks Topic</span>
                </a>
                <ul aria-expanded="false" class="collapse first-level">
                  <li class="sidebar-item">
                    <a href="{{ url('/topic_view') }}" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu">Topic View</span>
                    </a>
                  </li>

                  <li class="sidebar-item">
                    <a href="{{ url('/topic_add') }}" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu">Add Topic</span>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
                  <span class="d-flex">
                    <i class="ti ti-help"></i>
                  </span>
                  <span class="hide-menu">Mocks Question </span>
                </a>
                <ul aria-expanded="false" class="collapse first-level">
                  <li class="sidebar-item">
                    <a href="{{ url('/question_view') }}" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu"> Question View</span>
                    </a>
                  </li>
                  <li class="sidebar-item">
                    <a href="{{ url('/question_add') }}" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu">Add Question</span>
                    </a>
                  </li>

                </ul>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
                  <span class="d-flex">
                    <i class="ti ti-file-pencil"></i>
                  </span>
                  <span class="hide-menu">Mocks Tests</span>
                </a>
                <ul aria-expanded="false" class="collapse first-level">
                  <li class="sidebar-item">
                    <a href="{{ url('/test_view') }}" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu">Test View</span>
                    </a>
                  </li>

                  <li class="sidebar-item">
                    <a href="{{ url('/test_add') }}" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu">Create Test</span>
                    </a>
                  </li>
                </ul>
              </li>


              <li class="sidebar-item">
                <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
                  <span class="d-flex">
                    <i class="ti ti-file-pencil"></i>
                  </span>
                  <span class="hide-menu">Mocks Demo</span>
                </a>
                <ul aria-expanded="false" class="collapse first-level">
                  <li class="sidebar-item">
                    <a href="{{ url('/mocks_demo_question_view') }}" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu">Question View</span>
                    </a>
                  </li>

                  <li class="sidebar-item">
                    <a href="{{ url('/show_add_mocks_demo_question_view') }}" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu">Add Question</span>
                    </a>
                  </li>
                </ul>
              </li>



                  <!-- ============================= -->
              <!-- User Management -->
              <!-- ============================= -->
              <li class="nav-small-cap">
                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                <span class="hide-menu">User Management</span>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
                  <span class="d-flex">
                    <i class="ti ti-help"></i>
                  </span>
                  <span class="hide-menu">Users</span>
                </a>
                <ul aria-expanded="false" class="collapse first-level">
                  <li class="sidebar-item">
                    <a href="{{ url('/user_view') }}" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu"> Users View</span>
                    </a>
                  </li>
                  <li class="sidebar-item">
                    <a href="{{ url('/add_user_view') }}" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu">Add Users</span>
                    </a>
                  </li>

                </ul>
              </li>


              <li class="sidebar-item">
                <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
                  <span class="d-flex">
                    <i class="ti ti-help"></i>
                  </span>
                  <span class="hide-menu">Subscription</span>
                </a>
                <ul aria-expanded="false" class="collapse first-level">
                  <li class="sidebar-item">
                    <a href="{{ url('/subscription_view') }}" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu"> Subscription View</span>
                    </a>
                  </li>
                  <li class="sidebar-item">
                    <a href="{{ url('/add_subsription_view') }}" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu">Add Subscription</span>
                    </a>
                  </li>

                </ul>
              </li>

              <li class="sidebar-item">
                <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
                  <span class="d-flex">
                    <i class="ti ti-help"></i>
                  </span>
                  <span class="hide-menu">Mocks</span>
                </a>
                <ul aria-expanded="false" class="collapse first-level">
                  <li class="sidebar-item">
                    <a href="{{ url('/') }}/mocks_user_view" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu"> Mocks User</span>
                    </a>
                  </li>


                </ul>
              </li>



              <!-- ============================= -->
              <!-- Email Marketing -->
              <!-- ============================= -->
              <li class="nav-small-cap">
                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                <span class="hide-menu">Email Marketing</span>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
                  <span class="d-flex">
                    <i class="ti ti-mail"></i>
                  </span>
                  <span class="hide-menu">Widgets</span>
                </a>
                <ul aria-expanded="false" class="collapse first-level">
                  <li class="sidebar-item">
                    <a href="./widgets-cards.html" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu">Cards</span>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
                  <span class="d-flex">
                    <i class="ti ti-list"></i>
                  </span>
                  <span class="hide-menu">Widgets</span>
                </a>
                <ul aria-expanded="false" class="collapse first-level">
                  <li class="sidebar-item">
                    <a href="./widgets-cards.html" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu">Cards</span>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
                  <span class="d-flex">
                    <i class="ti ti-layout-kanban"></i>
                  </span>
                  <span class="hide-menu">Widgets</span>
                </a>
                <ul aria-expanded="false" class="collapse first-level">
                  <li class="sidebar-item">
                    <a href="./widgets-cards.html" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu">Cards</span>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
                  <span class="d-flex">
                    <i class="ti ti-mood-smile"></i>
                  </span>
                  <span class="hide-menu">Widgets</span>
                </a>
                <ul aria-expanded="false" class="collapse first-level">
                  <li class="sidebar-item">
                    <a href="./widgets-cards.html" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu">Cards</span>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
                  <span class="d-flex">
                    <i class="ti ti-clipboard ti-layout"></i>
                  </span>
                  <span class="hide-menu">Widgets</span>
                </a>
                <ul aria-expanded="false" class="collapse first-level">
                  <li class="sidebar-item">
                    <a href="./widgets-cards.html" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu">Cards</span>
                    </a>
                  </li>
                </ul>
              </li>



            </ul>

          </nav>

          <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
      </aside>
      <!--  Sidebar End -->

      <!--  Main wrapper -->
      <div class="body-wrapper">
