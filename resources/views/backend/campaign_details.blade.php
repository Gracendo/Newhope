@extends('layouts.backend.app_admin_dashboard')
@section('content')
 <main>
                    <div class="container-fluid">
                     <!-- Breadcrumb start -->
                      <div class="row m-1">
                        <div class="col-12 ">
                          <h4 class="main-title">Campaign Details</h4>
                          <ul class="app-line-breadcrumbs mb-3">
                            <li class="">
                              <a href="#" class="f-s-14 f-w-500"> 
                                <span>
                                  <i class="ph-duotone  ph-stack f-s-16"></i> Campaigns
                                </span>
                              </a>
                            </li>
                            <li>
                              <a href="#" class="f-s-14 f-w-500">Campaigns</a>
                            </li>
                            <li class="active">
                              <a href="#" class="f-s-14 f-w-500">Campaign Details</a>
                            </li>
                          </ul>
                        </div>
                      </div>
                      <!-- Breadcrumb end -->
                      
                      <!-- Project Details start -->
                      <div class="row">
                        <div class="col-md-6 col-xxl-3 order-md-2 order-xxl-1">
                          <!-- Project Details -->
                          <div class="card">
                            <div class="card-header">
                              <h5>Campaign Details</h5>
                            </div>
                            <div class="card-body">
                              <table class=" project-details-table table table-borderless  align-middle mb-0">
                                <tbody>
                                <tr>
                                  <td>
                                    <p class="f-w-600 mb-0">Name</p>
                                  </td>
                                  <td class="text-end">
                                    Ra-admin
                                  </td>
                                </tr>
                                <tr>
                                  <td>
                                    <p class="f-w-600 mb-0">Orphanage</p>
                                  </td>
                                  <td class="text-end">
                                    Leonor Hill
                                  </td>
                                </tr>
                                <tr>
                                  <td>
                                    <p class="f-w-600 mb-0">Start Date</p>
                                  </td>
                                  <td class="text-end"><span class="text-primary">10 Apr
                                                                    2024</span>
                                  </td>
                                </tr>

                                <tr>
                                  <td>
                                    <p class="f-w-600 mb-0">End Date</p>
                                  </td>
                                  <td class="text-end"><span class="text-danger">20 Jul
                                                                    2024</span>
                                  </td>
                                </tr>
                                <tr>
                                  <td class="pb-0">
                                    <p class="f-w-600 mb-0">Goal</p>
                                  </td>
                                  <td class="text-end pb-0">
                                    <h6>$200k</h6>
                                  </td>
                                </tr>
                                <tr>
                                  <td class="">
                                    <p class="f-w-600 mb-0">Volunteers</p>
                                  </td>
                                  <td class="text-end">
                                    <ul class="avatar-group justify-content-end">
                                      <li class="text-bg-danger h-30 w-30 d-flex-center b-r-50"
                                          data-bs-toggle="tooltip"
                                          data-bs-title="Everlee Lambert">
                                        A
                                      </li>
                                      <li class="text-bg-dark h-30 w-30 d-flex-center b-r-50"
                                          data-bs-toggle="tooltip"
                                          data-bs-title="Hunter Scott">
                                        CD
                                      </li>
                                      <li class="text-bg-warning h-30 w-30 d-flex-center b-r-50"
                                          data-bs-toggle="tooltip"
                                          data-bs-title="Hunter Scott">
                                        XYZ
                                      </li>
                                      <li class="text-bg-secondary h-25 w-25 d-flex-center b-r-50"
                                          data-bs-toggle="tooltip" data-bs-title="2 More">
                                        2+
                                      </li>
                                    </ul>
                                  </td>
                                </tr>
                                <tr>
                                  <td>
                                    <p class="f-w-600 mb-0">Status</p>
                                  </td>
                                  <td class="text-end"><span class="badge text-light-primary">
                                                                    In
                                                                    progress</span> </td>
                                </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>
                          <!--end  Project Details -->

                          <!-- Project Team -->

                          <div class="card ">
                            <div class="card-header">
                              <h5 class="header-title-text">Campaign Volunteers</h5>
                            </div>
                            <div class="card-body">
                              <div class="project-team-list">
                                <div class="d-flex align-items-center">
                                  <div class="bg-primary h-35 w-35 d-flex-center b-r-10 overflow-hidden">
                                    <img src="../assets/images/avtar/07.png" alt=""
                                         class="img-fluid">
                                  </div>
                                  <div class="flex-grow-1 ps-2">
                                    <h6 class="mb-0 fw-medium"> Bette Hagenes</h6>
                                    <p class="text-muted f-s-13 mb-0 f-w-500">Wed Developer</p>
                                  </div>
                                </div>
                                <div class="d-flex align-items-center  mt-3">
                                  <div class="bg-secondary h-35 w-35 d-flex-center b-r-10 overflow-hidden">
                                    <img src="../assets/images/avtar/13.png" alt=""
                                         class="img-fluid">
                                  </div>
                                  <div class="flex-grow-1 ps-2">
                                    <h6 class="mb-0 fw-medium"> Fleta Walsh</h6>
                                    <p class="text-muted f-s-13 mb-0 f-w-500">Wed Designer</p>
                                  </div>
                                </div>
                                <div class="d-flex align-items-center  mt-3">
                                                <span class="bg-dark h-35 w-35 d-flex-center b-r-10">
                                                  LR
                                                </span>
                                  <div class="flex-grow-1 ps-2">
                                    <h6 class="mb-0 fw-medium"> Lenora</h6>
                                    <p class="text-muted f-s-13 mb-0 f-w-500">UI/UX designer</p>
                                  </div>
                                </div>
                                <div class="d-flex align-items-center  mt-3">
                                  <div class="bg-warning h-35 w-35 d-flex-center b-r-10 overflow-hidden">
                                    <img src="../assets/images/avtar/16.png" alt=""
                                         class="img-fluid">
                                  </div>
                                  <div class="flex-grow-1 ps-2">
                                    <h6 class="mb-0 fw-medium"> Fleta Walsh </h6>
                                    <p class="text-muted f-s-13 mb-0 f-w-500">React Developer</p>
                                  </div>
                                </div>
                                <div class="d-flex align-items-center  mt-3">
                                              <span class="bg-danger h-35 w-35 d-flex-center b-r-10">
                                                EM
                                              </span>
                                  <div class="flex-grow-1 ps-2">
                                    <h6 class="mb-0 fw-medium"> Emery McKenzie</h6>
                                    <p class="text-muted f-s-13 mb-0 f-w-500">Wed Developer</p>
                                  </div>
                                </div>
                                <div class="d-flex align-items-center  mt-3">
                                  <div class="bg-dark h-35 w-35 d-flex-center b-r-10 overflow-hidden">
                                    <img src="../assets/images/avtar/4.png" alt=""
                                         class="img-fluid">
                                  </div>
                                  <div class="flex-grow-1 ps-2">
                                    <h6 class="mb-0 fw-medium"> Bette Hagenes</h6>
                                    <p class="text-muted f-s-13 mb-0 f-w-500">Wed Designer</p>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!--end Project Team -->

                        </div>
                        
                        <div class="col-md-6 col-xxl-3 order-md-1 order-xxl-3">
                          <!-- About project -->
                          <div class="card">
                            <div class="card-header">
                              <h5>About Campaign</h5>
                            </div>
                            <div class="card-body">
                              <div class="mb-3">
                                <h6>Campaign Description</h6>
                                <p class="text-muted">An admin panel or a control panel is a system that
                                  enables administrators
                                  and other website workers to conduct various tasks like monitoring,
                                  maintaining, and controlling certain business processes. An admin
                                  dashboard is one of the core components of a control panel.</p>
                              </div>
                              <div class="mb-3">
                                <h6>Campaign Objectif</h6>
                                <p class="text-muted">
                                  The success of a project relies heavily on effective project management, which involves the careful planning, organizing, and controlling of resources to ensure that the project objectives are met. This includes defining the project scope, setting realistic timelines and budgets.
                                </p>
                              </div>
                              <div class="mb-3">
                                <h6>Background information</h6>
                                <p class="text-muted"> A project is a planned endeavor that aims to achieve a specific goal within a defined timeframe. It involves a series of tasks and activities that are coordinated and executed by a team of individuals. Projects can vary in size, complexity, and scope, ranging from small-scale initiatives to large-scale undertakings that span across multiple departments or organizations.
                                </p>
                              </div>
                            </div>
                          </div>
                          <!-- about project end  -->
                          <!-- Project Documents -->
                          <div class="card">
                            <div class="card-body">
                              <h5 class="header-title-text">Data Folder & Files</h5>
                                <div class="filebox">
                                  <div class="d-flex align-items-center position-relative">
                                    <div class="position-absolute start-0">
                                      <img src="../assets/images/icons/file.png" class="w-35 h-35" alt="">
                                    </div>
                                    <div class="flex-grow-1 mg-s-40">
                                      <h6 class="mb-0">Campaign Details</h6>
                                      <p class="text-secondary mb-0">18 Files</p>
                                    </div>
                                    <p class="file-data text-secondary f-w-500 mb-0">32GB</p>
                                  </div>
                                </div>
                                <div class="filebox">
                                  <div class="d-flex align-items-center position-relative">
                                    <div class="position-absolute start-0">
                                      <img src="../assets/images/icons/zip.png" class="w-35 h-35" alt="">
                                    </div>
                                    <div class="flex-grow-1 mg-s-40">
                                      <h6 class="mb-0">Campaign Reporting</h6>
                                      <p class="text-secondary mb-0">18 Files</p>
                                    </div>
                                    <p class="file-data text-secondary f-w-500 mb-0">32GB</p>
                                  </div>
                                </div>
                                <div>
                                  <a href="file_manager.html" role="button" class="btn btn-primary w-100">View More</a>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- end Project Documents -->
                        </div>
                      </div>
                      <!-- Project Details end -->
                    </div>
                </main>
@endsection