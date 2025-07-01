@extends('layouts.backend.app_admin_dashboard')
@section('content')

<main>
          <div class="container-fluid">
            <div class="row">
              <!-- order -3 -->
                <div class="col-md-7 col-lg-5 col-xxl-4">
                <div class="card">
                  <div class="card-body">
                    <h5 class="header-title-text">List of Users</h5>

                    <ul class="meeting-schedule-list  mt-3" id="meetingSchedule">
                      
                     
                      <li>
                       
                        <div class="card">
                          <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between" draggable="false">
                              <div class="">
                                
                                <h6 class="mb-0 text-dark">Total number of adnimistrators:{{$total_admin}}</h6>
                                <p class="mb-0 text-secondary f-s-12">Total number of users:{{$total_user}}</p>
                              </div>
                              
                              
                            </div>
                          </div>
                        </div>
                      </li>
                    </ul>
                    <br>
                    <!-- <div>
                        <a href="file_manager.html" target="_blank" role="button" class="btn btn-primary b-r-15 w-100">View More</a>
                      </div> -->
                  </div>
                </div>
              </div>
              <div class=" col-xxl-6 order--2-lg">
                <div class="card equal-card">
                  <div class="card-body">
                    <div class="row" style="width:100%">
                      <div class="col-sm-16">
                        <h5 class="header-title-text">Campaign Status</h5>

                        <div class="project-status-box">
                          <div class="project-status-card bg-primary">
                            <span class="bg-light-light h-45 w-45 d-flex-center b-r-50">
                              <i class="ph-fill  ph-projector-screen-chart"></i>
                            </span>
                            <p class="mb-0 mt-2">Campaigns</p>
                            <h4 class="text-white f-w-600">35k</h4>
                          </div>
                          <div class="project-status-card bg-dark">
                            <span class="bg-light-light h-45 w-45 d-flex-center b-r-50">
                              <i class="ph-bold  ph-circles-three-plus"></i>
                            </span>
                            <p class="mb-0 mt-2">Completed</p>
                            <h4 class="text-white f-w-600">60</h4>
                          </div>
                          <div class="project-status-card bg-warning">
                            <span class="bg-light-dark h-45 w-45 d-flex-center b-r-50">
                              <i class="ph ph-chart-line-up"></i>
                            </span>
                            <p class="mb-0 mt-2">In Progress</p>
                            <h4 class="text-white f-w-600">20</h4>
                          </div>
                          <div class="project-status-card">
                            <span class="bg-light-secondary h-45 w-45 d-flex-center b-r-50">
                              <i class="ph-bold  ph-check-circle"></i>
                            </span>
                            <p class="mb-0 mt-2">Pending</p>
                            <h4 class="f-w-600">2k</h4>
                          </div>
                          <div class="project-status-card bg-dark">
                            <span class="bg-light-danger h-45 w-45 d-flex-center b-r-50">
                              <!-- <i class="ph-bold  ph-check-circle"></i> -->
                              <i class="fa-solid fa-times-circle fa-fw"></i>
                            </span>
                            <p class="mb-0 mt-2">Rejected</p>
                            <h4 class="f-w-600">20k</h4>
                          </div>
                        </div>

                        
                        
                      </div> 
                    </div>
                  </div>
                </div>
              </div>
             
              <!-- order -1 -->
              
             
              <!-- <div class="col-md-5 col-lg-3">
                
              </div> -->
              
              <!-- order 1 -->
              <div class="col-xxl-9 order-1-md">
                <div class="card">
                      
                  <div class="card-body p-0">
                    <!-- <h5>Projects</h5> -->

                    <div class="table-responsive Projects-datatable  app-datatable-default app-scroll">
                      <table id="ProjectsDatatable" class="display">
                        <thead>
                        <tr>
                          <th>
                            <label class="check-box">
                              <input type="checkbox">
                              <span class="checkmark outline-secondary ms-2"></span>
                            </label>
                          </th>
                          <th>Campaign</th>
                          <th>Status</th>
                          <th>Objectif</th>
                          <th>Volunteers</th>
                          <th>Goal amount</th>
                          <th>Duration</th>
                          <th>Raised Amount </th>
                          <th>End Date</th>
                        </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>
                              <label class="check-box">
                                <input type="checkbox">
                                <span class="checkmark outline-secondary ms-2"></span>
                              </label>
                            </td>
                            <td>
                              <div class="position-relative">
                                <div class="h-35 w-35 d-flex-center b-r-50 overflow-hidden bg-light-primary b-1-primary p-1 position-absolute">
                                  <i class="ph-duotone  ph-swap f-s-16"></i>
                                </div>
                                <div class="ms-5">
                                  <h6 class="f-s-15 f-w-600 mb-0">Website Redesign</h6>
                                  <p class="f-s-13 text-secondary mb-0">John Mandela</p>
                                </div>
                              </div>
                            </td>
                            <td>
                              <span class="badge text-light-warning"> <i class="ti ti-download me-1"></i> In Progress</span>
                            </td>
                            <td>Front-end</td>
                            <td>
                              <ul class="avatar-group justify-content-start">
                                <li class="h-35 w-35 d-flex-center b-r-50 overflow-hidden text-bg-primary b-2-light" data-bs-toggle="tooltip" data-bs-title="Sabrina Torres">
                                  <img src="../assets/images/avtar/4.png" alt="" class="img-fluid">
                                </li>
                                <li class="h-35 w-35 d-flex-center b-r-50 overflow-hidden text-bg-success b-2-light" data-bs-toggle="tooltip" data-bs-title="Eva Bailey">
                                  <img src="../assets/images/avtar/5.png" alt="" class="img-fluid">
                                </li>
                                <li class="h-35 w-35 d-flex-center b-r-50 overflow-hidden text-bg-danger b-2-light" data-bs-toggle="tooltip" data-bs-title="Michael Hughes">
                                  <img src="../assets/images/avtar/6.png" alt="" class="img-fluid">
                                </li>
                                <li class="text-bg-secondary h-25 w-25 d-flex-center b-r-50" data-bs-toggle="tooltip" data-bs-title="10 More">
                                  10+
                                </li>
                              </ul>
                            </td>
                            <td>
                              <a href="#">www.web.com</a>
                            </td>
                            <td>
                              <div class="time-tracking-box">
                                  <i class="ph-duotone  ph-clock f-s-12"></i>
                                  <span class="f-s-12">20 hours</span> 
                                  <span class="badge text-bg-warning"><i class="ph ph-play-pause text-white f-s-13"></i></span>
                              </div>
                            </td>
                            <td>
                              50%
                            </td>
                            <td>2024-06-15</td>
                          </tr>
                          <tr>
                            <td>
                              <label class="check-box">
                                <input type="checkbox">
                                <span class="checkmark outline-secondary ms-2"></span>
                              </label>
                            </td>
                            <td>
                              <div class="position-relative">
                                <div class="h-35 w-35 d-flex-center b-r-50 overflow-hidden bg-light-info b-1-info p-1 position-absolute">
                                  <i class="ph-duotone  ph-arrows-in-cardinal f-s-16"></i>
                                </div>
                                <div class="ms-5">
                                  <h6 class="f-s-15 f-w-600 mb-0"> Marketing Campaign</h6>
                                  <p class="f-s-13 text-secondary mb-0">John Mandela</p>
                                </div>
                              </div>
                            </td>
                            <td>
                              <span class="badge text-light-success"> <i class="ti ti-download me-1"></i>Completed</span>
                            </td>
                            <td>Marketing</td>
                            <td>
                              <ul class="avatar-group justify-content-start">
                                <li class="h-35 w-35 d-flex-center b-r-50 overflow-hidden text-bg-secondary b-2-light" data-bs-toggle="tooltip" data-bs-title="Sabrina Torres">
                                  <img src="../assets/images/avtar/2.png" alt="" class="img-fluid">
                                </li>
                                <li class="h-35 w-35 d-flex-center b-r-50 overflow-hidden text-bg-primary b-2-light" data-bs-toggle="tooltip" data-bs-title="Eva Bailey">
                                  <img src="../assets/images/avtar/4.png" alt="" class="img-fluid">
                                </li>
                                <li class="text-bg-secondary h-25 w-25 d-flex-center b-r-50" data-bs-toggle="tooltip" data-bs-title="10 More">
                                  15+
                                </li>
                              </ul>
                            </td>
                            <td>
                              <a href="#">www.marketing.com</a>
                            </td>
                            <td>
                              <div class="time-tracking-box">
                                <i class="ph-duotone  ph-clock f-s-12"></i>
                                <span class="f-s-12">40 hours</span> 
                                <span class="badge text-bg-warning"><i class="ph ph-play-pause text-white f-s-13"></i></span>
                            </div>
                            </td>
                            <td>
                              100%
                            </td>
                            <td>2024-04-30</td>
                          </tr>
                          <tr>
                            <td>
                              <label class="check-box">
                                <input type="checkbox">
                                <span class="checkmark outline-secondary ms-2"></span>
                              </label>
                            </td>
                            <td>
                              <div class="position-relative">
                                <div class="h-35 w-35 d-flex-center b-r-50 overflow-hidden bg-light-danger b-1-danger p-1 position-absolute">
                                  <i class="ph-duotone  ph-airplay f-s-16"></i>
                                </div>
                                <div class="ms-5">
                                  <h6 class="f-s-15 f-w-600 mb-0">Product Launch</h6>
                                  <p class="f-s-13 text-secondary mb-0">John Mandela</p>
                                </div>
                              </div>
                            </td>
                            <td>
                              <span class="badge text-light-info"> <i class="ti ti-download me-1"></i>Pending</span>
                            </td>
                            <td>Launch</td>
                            <td>
                              <ul class="avatar-group justify-content-start">
                                <li class="h-35 w-35 d-flex-center b-r-50 overflow-hidden text-bg-dark b-2-light" data-bs-toggle="tooltip" data-bs-title="Sabrina Torres">
                                  <img src="../assets/images/avtar/6.png" alt="" class="img-fluid">
                                </li>
                                <li class="text-bg-secondary h-25 w-25 d-flex-center b-r-50" data-bs-toggle="tooltip" data-bs-title="10 More">
                                  20+
                                </li>
                              </ul>
                            </td>
                            <td>
                              <a href="#">www.webappdev.com</a>
                            </td>
                            <td>
                              <div class="time-tracking-box">
                                <i class="ph-duotone  ph-clock f-s-12"></i>
                                <span class="f-s-12">0 hours</span> 
                                <span class="badge text-bg-warning"><i class="ph ph-play-pause text-white f-s-13"></i></span>
                              </div>
                            </td>
                            <td>
                              0%
                            </td>
                            <td>2024-07-10</td>
                          </tr>
                          <tr>
                            <td>
                              <label class="check-box">
                                <input type="checkbox">
                                <span class="checkmark outline-secondary ms-2"></span>
                              </label>
                            </td>
                            <td>
                              <div class="position-relative">
                                <div class="h-35 w-35 d-flex-center b-r-50 overflow-hidden bg-light-success b-1-success p-1 position-absolute">
                                  <i class="ph-duotone  ph-codesandbox-logo f-s-16"></i>
                                </div>
                                <div class="ms-5">
                                  <h6 class="f-s-15 f-w-600 mb-0">App Development</h6>
                                  <p class="f-s-13 text-secondary mb-0">John Mandela</p>
                                </div>
                              </div>
                            </td>
                            <td>
                              <span class="badge text-light-danger"> <i class="ti ti-download me-1"></i>On Hold</span>
                            </td>
                            <td>Development</td>
                            <td>
                              <ul class="avatar-group justify-content-start">
                                <li class="h-35 w-35 d-flex-center b-r-50 overflow-hidden text-bg-secondary b-2-light" data-bs-toggle="tooltip" data-bs-title="Sabrina Torres">
                                  <img src="../assets/images/avtar/08.png" alt="" class="img-fluid">
                                </li>
                                <li class="h-35 w-35 d-flex-center b-r-50 overflow-hidden text-bg-success b-2-light" data-bs-toggle="tooltip" data-bs-title="Eva Bailey">
                                  <img src="../assets/images/avtar/07.png" alt="" class="img-fluid">
                                </li>
                                <li class="h-35 w-35 d-flex-center b-r-50 overflow-hidden text-bg-warning b-2-light" data-bs-toggle="tooltip" data-bs-title="Michael Hughes">
                                  <img src="../assets/images/avtar/6.png" alt="" class="img-fluid">
                                </li>
                                <li class="text-bg-secondary h-25 w-25 d-flex-center b-r-50" data-bs-toggle="tooltip" data-bs-title="10 More">
                                  5+
                                </li>
                              </ul>
                            </td>
                            <td>
                              <a href="#">www.appdev.com</a>
                            </td>
                            <td>
                              <div class="time-tracking-box">
                                <i class="ph-duotone  ph-clock f-s-12"></i>
                                <span class="f-s-12">10 hours</span> 
                                <span class="badge text-bg-warning"><i class="ph ph-play-pause text-white f-s-13"></i></span>
                            </div>
                            </td>
                            <td>
                              20%
                            </td>
                            <td>2024-08-20</td>
                          </tr>
                          <tr>
                            <td>
                              <label class="check-box">
                                <input type="checkbox">
                                <span class="checkmark outline-secondary ms-2"></span>
                              </label>
                            </td>
                            <td>
                              <div class="position-relative">
                                <div class="h-35 w-35 d-flex-center b-r-50 overflow-hidden bg-light-warning b-1-warning p-1 position-absolute">
                                  <i class="ph-duotone  ph-folder-notch f-s-16"></i>
                                </div>
                                <div class="ms-5">
                                  <h6 class="f-s-15 f-w-600 mb-0">Content Creation</h6>
                                  <p class="f-s-13 text-secondary mb-0">John Mandela</p>
                                </div>
                              </div>
                            </td>
                            <td>
                              <span class="badge text-light-warning"> <i class="ti ti-download me-1"></i>In Progress</span>
                            </td>
                            <td>Content</td>
                            <td>
                              <ul class="avatar-group justify-content-start">
                                <li class="h-35 w-35 d-flex-center b-r-50 overflow-hidden text-bg-primary b-2-light" data-bs-toggle="tooltip" data-bs-title="Sabrina Torres">
                                  <img src="../assets/images/avtar/4.png" alt="" class="img-fluid">
                                </li>
                                <li class="h-35 w-35 d-flex-center b-r-50 overflow-hidden text-bg-success b-2-light" data-bs-toggle="tooltip" data-bs-title="Eva Bailey">
                                  <img src="../assets/images/avtar/5.png" alt="" class="img-fluid">
                                </li>
                                <li class="text-bg-secondary h-25 w-25 d-flex-center b-r-50" data-bs-toggle="tooltip" data-bs-title="10 More">
                                  10+
                                </li>
                              </ul>
                            </td>
                            <td>
                              <a href="#">www.site.com</a>
                            </td>
                            <td>
                              <div class="time-tracking-box">
                                <i class="ph-duotone  ph-clock f-s-12"></i>
                                <span class="f-s-12">30 hours</span> 
                                <span class="badge text-bg-warning"><i class="ph ph-play-pause text-white f-s-13"></i></span>
                              </div>
                            </td>
                            <td>
                              70%
                            </td>
                            <td>2024-05-25</td>
                          </tr>
                          <tr>
                            <td>
                              <label class="check-box">
                                <input type="checkbox">
                                <span class="checkmark outline-secondary ms-2"></span>
                              </label>
                            </td>
                            <td>
                              <div class="position-relative">
                                <div class="h-35 w-35 d-flex-center b-r-50 overflow-hidden bg-light-secondary b-1-secondary p-1 position-absolute">
                                  <i class="ph-duotone  ph-text-outdent f-s-16"></i>
                                </div>
                                <div class="ms-5">
                                  <h6 class="f-s-15 f-w-600 mb-0">Training Workshop</h6>
                                  <p class="f-s-13 text-secondary mb-0">John Mandela</p>
                                </div>
                              </div>
                            </td>
                            <td>
                              <span class="badge text-light-success"> <i class="ti ti-download me-1"></i>Completed</span>
                            </td>
                            <td>Training</td>
                            <td>
                              <ul class="avatar-group justify-content-start">
                                <li class="h-35 w-35 d-flex-center b-r-50 overflow-hidden text-bg-primary b-2-light" data-bs-toggle="tooltip" data-bs-title="Sabrina Torres">
                                  <img src="../assets/images/avtar/4.png" alt="" class="img-fluid">
                                </li>
                                <li class="h-35 w-35 d-flex-center b-r-50 overflow-hidden text-bg-success b-2-light" data-bs-toggle="tooltip" data-bs-title="Eva Bailey">
                                  <img src="../assets/images/avtar/5.png" alt="" class="img-fluid">
                                </li>
                                <li class="h-35 w-35 d-flex-center b-r-50 overflow-hidden text-bg-danger b-2-light" data-bs-toggle="tooltip" data-bs-title="Michael Hughes">
                                  <img src="../assets/images/avtar/6.png" alt="" class="img-fluid">
                                </li>
                                <li class="text-bg-secondary h-25 w-25 d-flex-center b-r-50" data-bs-toggle="tooltip" data-bs-title="10 More">
                                  10+
                                </li>
                              </ul>
                            </td>
                            <td>
                              <a href="#">www.training.com</a>
                            </td>
                            <td>
                              <div class="time-tracking-box">
                                <i class="ph-duotone  ph-clock f-s-12"></i>
                                <span class="f-s-12">50 hours</span> 
                                <span class="badge text-bg-warning"><i class="ph ph-play-pause text-white f-s-13"></i></span>
                              </div>
                            </td>
                            <td>
                              100%
                            </td>
                            <td>2024-03-15</td>
                          </tr>
                          <tr>
                            <td>
                              <label class="check-box">
                                <input type="checkbox">
                                <span class="checkmark outline-secondary ms-2"></span>
                              </label>
                            </td>
                            <td>
                              <div class="position-relative">
                                <div class="h-35 w-35 d-flex-center b-r-50 overflow-hidden bg-light-dark b-1-dark p-1 position-absolute">
                                  <i class="ph-duotone  ph-presentation-chart f-s-16"></i>
                                </div>
                                <div class="ms-5">
                                  <h6 class="f-s-15 f-w-600 mb-0">Research Initiative</h6>
                                  <p class="f-s-13 text-secondary mb-0">John Mandela</p>
                                </div>
                              </div>
                            </td>
                            <td>
                              <span class="badge text-light-success"> <i class="ti ti-download me-1"></i>Progress</span>
                            </td>
                            <td>Research</td>
                            <td>
                              <ul class="avatar-group justify-content-start">
                                <li class="h-35 w-35 d-flex-center b-r-50 overflow-hidden text-bg-primary b-2-light" data-bs-toggle="tooltip" data-bs-title="Sabrina Torres">
                                  <img src="../assets/images/avtar/09.png" alt="" class="img-fluid">
                                </li>
                                <li class="text-bg-secondary h-25 w-25 d-flex-center b-r-50" data-bs-toggle="tooltip" data-bs-title="10 More">
                                  15+
                                </li>
                              </ul>
                            </td>
                            <td>
                              <a href="#">www.initiative.com</a>
                            </td>
                            <td>
                              <div class="time-tracking-box">
                                <i class="ph-duotone  ph-clock f-s-12"></i>
                                <span class="f-s-12">15 hours</span> 
                                <span class="badge text-bg-warning"><i class="ph ph-play-pause text-white f-s-13"></i></span>
                              </div>
                            </td>
                            <td>
                              40%
                            </td>
                            <td>2024-09-05</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                     
                     </div>
                    
                </div>
              </div>
              
              <div class="col-md-5 col-xxl-4">
                <div class="card">
                  <div class="card-body">
                    <h5 class="header-title-text">Data Folder & Files</h5>

                    <div class="data-list-box mt-3">
                      <div class="filebox" style="padding:15px">
                        <div class="d-flex align-items-center">
                          <img src="../assets/images/icons/02.png" class="w-35 h-35" alt="">
                          <div class="flex-grow-1 ms-2">
                            <h6 class="mb-0">React Data</h6>
                            <p class="text-secondary mb-0">18 Files</p>
                          </div>
                          <p class="text-secondary f-w-500">32GB</p>
                        </div>
                      </div>
                      
                      <div>
                        <a href="file_manager.html" target="_blank" role="button" class="btn btn-primary b-r-15 w-100">View More</a>
                      </div>
                    </div>
                  </div>
                </div>
                
                

                
              </div>
            </div>
          </div>
        </main>
@endsection