@extends('super_admin.templates.main')
@section('main-container')
        <div class="container-fluid"><!--  container start -->
          <!--  Owl carousel -->
          <div class="owl-carousel counter-carousel owl-theme">
            <div class="item">
              <div class="card border-0 zoom-in bg-light-primary shadow-none">
                <div class="card-body">
                  <div class="text-center">
                    <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/svgs/icon-connect.svg" width="50" height="50" class="mb-3" alt="" />
                    <p class="fw-semibold fs-3 text-primary mb-1"> Employees </p>
                    <h5 class="fw-semibold text-primary mb-0">96</h5>
                  </div>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="card border-0 zoom-in bg-light-warning shadow-none">
                <div class="card-body">
                  <div class="text-center">
                    <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/svgs/icon-connect.svg" width="50" height="50" class="mb-3" alt="" />
                    <p class="fw-semibold fs-3 text-warning mb-1">Clients</p>
                    <h5 class="fw-semibold text-warning mb-0">3,650</h5>
                  </div>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="card border-0 zoom-in bg-light-info shadow-none">
                <div class="card-body">
                  <div class="text-center">
                    <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/svgs/icon-connect.svg" width="50" height="50" class="mb-3" alt="" />
                    <p class="fw-semibold fs-3 text-info mb-1">Projects</p>
                    <h5 class="fw-semibold text-info mb-0">356</h5>
                  </div>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="card border-0 zoom-in bg-light-danger shadow-none">
                <div class="card-body">
                  <div class="text-center">
                    <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/svgs/icon-connect.svg" width="50" height="50" class="mb-3" alt="" />
                    <p class="fw-semibold fs-3 text-danger mb-1">Events</p>
                    <h5 class="fw-semibold text-danger mb-0">696</h5>
                  </div>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="card border-0 zoom-in bg-light-success shadow-none">
                <div class="card-body">
                  <div class="text-center">
                    <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/svgs/icon-connect.svg" width="50" height="50" class="mb-3" alt="" />
                    <p class="fw-semibold fs-3 text-success mb-1">Payroll</p>
                    <h5 class="fw-semibold text-success mb-0">$96k</h5>
                  </div>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="card border-0 zoom-in bg-light-info shadow-none">
                <div class="card-body">
                  <div class="text-center">
                    <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/svgs/icon-connect.svg" width="50" height="50" class="mb-3" alt="" />
                    <p class="fw-semibold fs-3 text-info mb-1">Reports</p>
                    <h5 class="fw-semibold text-info mb-0">59</h5>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!--  pie chart start -->
            <div class="row align-items-stretch">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5>Total questions</h5>
                            <div id="chart-pie-donut"></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5>User subscription</h5>
                            <div id="chart-pie-simple"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!--  pie chart start -->



        </div><!--  container end -->

        @endsection
