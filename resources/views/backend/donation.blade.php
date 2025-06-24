@extends('layouts.backend.app_admin_dashboard')
@section('content')
 <!-- Modal -->
<div class="modal fade" id="projectCard" tabindex="-1" aria-labelledby="projectCardLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="projectCardLabel">Make Campaign</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="app-form" method="POST" action="{{ route('campaigns.store') }}" enctype="multipart/form-data">
          @csrf

          <div class="mb-3">
            <label for="orphanage_id" class="form-label">Orphanage</label>
            <select name="orphanage_id" id="orphanage_id" class="form-control" required>
              <option value="">Select orphanage</option>
              @foreach($orphanages as $orphanage)
                <option value="{{ $orphanage->id }}">{{ $orphanage->name }}</option>
              @endforeach
            </select>
          </div>

          <div class="mb-3">
            <label for="pName" class="form-label">Campaign Name</label>
            <input type="text" class="form-control" placeholder="Designing" id="pName" name="name" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Image</label>
            <input type="file" class="form-control" name="image" accept=".jpg,.jpeg,.png" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Gallery Images (multiple)</label>
            <input type="file" class="form-control" name="gallery[]" multiple accept=".jpg,.jpeg,.png">
          </div>

          <div class="mb-3">
            <label class="form-label">Start Date</label>
            <input type="date" class="form-control" name="start_date">
          </div>

          <div class="mb-3">
            <label class="form-label">End Date</label>
            <input type="date" class="form-control" name="end_date">
          </div>

          <div class="mb-3">
            <label class="form-label">Project Duration</label>
            <input type="text" class="form-control" name="project_duration" placeholder="e.g. 6 months">
          </div>

          <div class="mb-3">
            <label class="form-label">Campaign Objectif</label>
            <textarea class="form-control" rows="3" name="objectif" placeholder="Enter campaign goal"></textarea>
          </div>

          <div class="mb-3">
            <label class="form-label">Campaign Description</label>
            <textarea class="form-control" rows="3" name="description" placeholder="Enter description"></textarea>
          </div>

          <div class="mb-3">
            <label class="form-label">Goal Amount</label>
            <input type="number" step="0.01" class="form-control" name="goal_amount" placeholder="10000">
          </div>

          <div class="mb-3">
            <label class="form-label">Preferred Amounts (comma-separated)</label>
            <input type="text" class="form-control" name="prefered_amounts" placeholder="e.g. 500,1000,2500">
          </div>

          <div class="mb-3">
            <label class="form-label">Raised Amount</label>
            <input type="number" step="0.01" class="form-control" name="raised_amount" value="0">
          </div>

          <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-control">
              <option value="pending">Pending</option>
              <option value="active">Active</option>
              <option value="completed">Completed</option>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label">Business Plan (PDF)</label>
            <input type="file" class="form-control" name="business_plan" accept=".pdf" required>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Create</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<main>
  <div class="container-fluid">
    <!-- Breadcrumb start -->
    <div class="row m-1">
      <div class="col-12 ">
        <h4 class="main-title">Campaigns</h4>
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
          
        </ul>
      </div>
    </div>
    <!-- Breadcrumb end -->

    <!-- Projects start -->
    <div class="row">
      <div class="col-12">

        
        <div class="tab-wrapper mb-3">
          <ul class="tabs">
            <li class="tab-link active" data-tab="1">All Campaigns</li>
            <li class="tab-link" data-tab="2">Agricultural Campaigns</li>
            <li class="tab-link" data-tab="3">Retailing Campaigns</li>
            <li class="ms-auto">
              <div class="text-end">
                <button class="btn btn-primary w-45 h-45 icon-btn b-r-10 m-2" data-bs-toggle="modal" data-bs-target="#projectCard"><i class="ti ti-plus f-s-18"></i></button>
              </div>
            </li>
          </ul>
        </div>
        <div class="content-wrapper" id="card-container">
          <div id="tab-1" class="tabs-content active">
            <div class="row">
  @foreach($campaigns as $project)
  <div class="col-md-6 col-xl-4 project-card">
    <div class="card hover-effect">
      <div class="card-header">
        <div class="d-flex align-items-center">
          <div class="h-40 w-40 d-flex-center b-r-50 overflow-hidden">
            <img src="{{ asset('storage/' . $project->image) }}" alt="Campaign Logo" class="img-fluid">
          </div>
          <a href="{{ route('admin.campaignDetails', $project->id) }}" class="flex-grow-1 ps-2" target="_blank">
            <h6 class="m-0 text-dark f-w-600">{{ $project->name }}</h6>
            <div class="text-muted f-s-14 f-w-500">{{ $project->orphanage->name ?? 'N/A' }}</div>
          </a>

          <div class="dropdown">
            <button class="bg-none border-0" type="button" data-bs-toggle="dropdown">
              <i class="ti ti-dots-vertical text-dark"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
              <li>
                <a class="dropdown-item" href="#">
                  <i class="ti ti-edit text-success"></i> Edit
                </a>
              </li>
              <li>
                <a class="dropdown-item delete-button" href="#">
                  <i class="ti ti-trash text-danger"></i> Delete
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="d-flex justify-content-between">
          <div>
            <h6 class="text-dark f-s-14">Start Date: <span class="text-success">{{ $project->start_date }}</span></h6>
            <h6 class="text-dark f-s-14">End Date: <span class="text-danger">{{ $project->end_date }}</span></h6>
          </div>
          <div class="text-end">
            <p class="f-w-500 text-secondary">Goal</p>
            <h6 class="f-w-600">${{ number_format($project->goal_amount, 0, '.', ',') }}</h6>
          </div>
        </div>

        <p class="text-muted f-s-14 text-secondary txt-ellipsis-2">
          {{ Str::limit($project->description, 100) }}
        </p>

        <div class="text-end mb-2">
          <span class="badge text-light-primary">Progress</span>
        </div>

        @php
          $progress = $project->goal_amount > 0 ? round(($project->raised_amount / $project->goal_amount) * 100) : 0;
        @endphp
        <div class="progress w-100" role="progressbar" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100">
          <div class="progress-bar bg-primary" style="width: {{ $progress }}%">{{ $progress }}%</div>
        </div>
      </div>

      <div class="card-footer">
        <div class="row align-items-center">
          <div class="col-6">
            <span class="text-dark f-w-600"><i class="ti ti-brand-wechat f-s-18"></i> {{ rand(5, 30) }} Volunteers</span>
          </div>
          <div class="col-6 text-end">
            <ul class="avatar-group float-end breadcrumb-start">
              <li class="h-30 w-30 d-flex-center b-r-50 text-bg-info b-2-light">
                <img src="{{ asset('assets/images/avtar/1.png') }}" alt="" class="img-fluid b-r-50">
              </li>
              <li class="text-bg-primary h-25 w-25 d-flex-center b-r-50" data-bs-toggle="tooltip" title="More">
                5+
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endforeach
</div>

          </div>
          <div id="tab-2" class="tabs-content">
            <div class="row">
              <div class="col-md-6 col-xl-4 project-card">
                <div class="card hover-effect">
                  <div class="card-header">
                    <div class="d-flex align-items-center">
                      <div class="h-40 w-40 d-flex-center b-r-50 overflow-hidden">
                        <img src="../assets/images/icons/logo1.png" alt="" class="img-fluid">
                      </div>
                      <a href="project_details.html" target="_blank" class="flex-grow-1 ps-2">
                        <h6 class="m-0 text-dark f-w-600"> Web Designing</h6>
                        <div class="text-muted f-s-14 f-w-500">Admin</div>
                      </a>
                      <div class="dropdown">
                        <button class="bg-none border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="ti ti-dots-vertical text-dark"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                          <li>
                            <a class="dropdown-item" href="#">
                              <i class="ti ti-edit text-success"></i> Edit
                            </a>
                          </li>
                          <li>
                            <a class="dropdown-item delete-button" href="#">
                              <i class="ti ti-trash text-danger"></i> Delete
                            </a>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="d-flex">
                      <div>
                        <h6 class="text-dark f-s-14 f-w-500">Start Date : <span class="text-success">2024-09-24 </span></h6>
                        <h6 class="text-dark f-s-14 f-w-500">End Date : <span class="text-danger">2024-12-05</span></h6>
                      </div>
                      <div class="flex-grow-1 text-end">
                        <p class="f-w-500 text-secondary">Goal</p>
                        <h6 class="f-w-600">$10k</h6>
                      </div>
                    </div>
                    <p class="text-muted f-s-14 text-secondary txt-ellipsis-2">I am a keen, hardworking, reliable and
                      excellent timekeeper. I am a bright and receptive person</p>
                    <div class="text-end mb-2">
                      <span class="badge text-light-primary">Progress</span>
                    </div>
                    <div class="progress w-100" role="progressbar" aria-valuenow="50" aria-valuemin="0"
                      aria-valuemax="100">
                      <div class="progress-bar bg-primary" style="width: 50%"> 50% </div>
                    </div>
                  </div>
                  <div class="card-footer">
                    <div class="row">
                      <div class="col-6">
                        <span class="text-dark f-w-600"><i class="ti ti-brand-wechat"></i> 20 Volunteers</span>
                      </div>
                      <div class="col-6">

                        <ul class="avatar-group float-end breadcrumb-start ">
                          <li class="h-25 w-25 d-flex-center b-r-50 text-bg-danger b-2-light position-relative"
                            data-bs-toggle="tooltip" data-bs-title="Sabrina Torres">
                            <img src="../assets/images/avtar/4.png" alt=""
                                  class="img-fluid b-r-50 overflow-hidden">
                          </li>
                          <li class="h-25 w-25 d-flex-center b-r-50 text-bg-success b-2-light position-relative"
                            data-bs-toggle="tooltip" data-bs-title="Sabrina Torres">
                            <img src="../assets/images/avtar/1.png" alt=""
                                  class="img-fluid b-r-50 overflow-hidden">
                          </li>
                          <li class="h-25 w-25 d-flex-center b-r-50 text-bg-warning b-2-light position-relative"
                            data-bs-toggle="tooltip" data-bs-title="Sabrina Torres">
                            <img src="../assets/images/avtar/2.png" alt=""
                                  class="img-fluid b-r-50 overflow-hidden">
                          </li>
                          <li class="h-25 w-25 d-flex-center b-r-50 text-bg-info b-2-light position-relative"
                            data-bs-toggle="tooltip" data-bs-title="Sabrina Torres">
                            <img src="../assets/images/avtar/3.png" alt=""
                                  class="img-fluid b-r-50 overflow-hidden">
                          </li>
                          <li class="text-bg-primary h-25 w-25 d-flex-center b-r-50" data-bs-toggle="tooltip"
                            data-bs-title="5 More">
                            5+
                          </li>
                        </ul>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
              <div class="col-md-6 col-xl-4 project-card">
                <div class="card hover-effect">
                  <div class="card-header">
                    <div class="d-flex align-items-center">
                      <div class="h-40 w-40 d-flex-center b-r-50 overflow-hidden">
                        <img src="../assets/images/icons/logo3.png" alt="" class="img-fluid">
                      </div>
                      <a href="project_details.html" target="_blank" class="flex-grow-1 ps-2">
                        <h6 class="m-0 text-dark f-w-600"> Designing</h6>
                        <div class="text-muted f-s-14 f-w-500">Dashboard</div>
                      </a>
                      <div class="dropdown">
                        <button class="bg-none border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="ti ti-dots-vertical text-dark"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                          <li>
                            <a class="dropdown-item" href="#">
                              <i class="ti ti-edit text-success"></i> Edit
                            </a>
                          </li>
                          <li>
                            <a class="dropdown-item delete-button" href="#">
                              <i class="ti ti-trash text-danger"></i> Delete
                            </a>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="d-flex">
                      <div>
                        <h6 class="text-dark f-s-14 f-w-500">Start Date : <span class="text-success">2024-10-10 </span></h6>
                        <h6 class="text-dark f-s-14 f-w-500">End Date : <span class="text-danger">2024-02-16</span></h6>
                      </div>
                      <div class="flex-grow-1 text-end">
                        <p class="f-w-500 text-secondary">Goal</p>
                        <h6 class="f-w-600">$100k</h6>
                      </div>
                    </div>
                    <p class="text-muted f-s-14 text-secondary txt-ellipsis-2">I am a keen, hardworking, reliable and
                      excellent timekeeper. I am a bright and receptive person</p>
                    <div class="text-end mb-2">
                      <span class="badge text-light-secondary">New</span>
                    </div>
                    <div class="progress w-100" role="progressbar" aria-valuenow="0" aria-valuemin="0"
                      aria-valuemax="100">
                      <div class="progress-bar bg-danger"> 0% </div>
                    </div>
                  </div>
                  <div class="card-footer">
                    <div class="row">
                      <div class="col-6">
                        <span class="text-dark f-w-600"><i class="ti ti-brand-wechat"></i> 25 Volunteers</span>
                      </div>
                      <div class="col-6">

                        <ul class="avatar-group float-end breadcrumb-start ">
                          <li class="h-25 w-25 d-flex-center b-r-50 text-bg-danger b-2-light position-relative"
                            data-bs-toggle="tooltip" data-bs-title="Sabrina Torres">
                            <img src="../assets/images/avtar/4.png" alt=""
                                  class="img-fluid b-r-50 overflow-hidden">
                          </li>
                          <li class="h-25 w-25 d-flex-center b-r-50 text-bg-success b-2-light position-relative"
                            data-bs-toggle="tooltip" data-bs-title="Sabrina Torres">
                            <img src="../assets/images/avtar/1.png" alt=""
                                  class="img-fluid b-r-50 overflow-hidden">
                          </li>
                          <li class="h-25 w-25 d-flex-center b-r-50 text-bg-success b-2-light position-relative"
                            data-bs-toggle="tooltip" data-bs-title="Sabrina Torres">
                            <img src="../assets/images/avtar/5.png" alt=""
                                  class="img-fluid b-r-50 overflow-hidden">
                          </li>
                          <li class="text-bg-primary h-25 w-25 d-flex-center b-r-50" data-bs-toggle="tooltip"
                            data-bs-title="5 More">
                            10+
                          </li>
                        </ul>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
              <div class="col-md-6 col-xl-4 project-card">
                <div class="card hover-effect">
                  <div class="card-header">
                    <div class="d-flex align-items-center">
                      <div class="h-40 w-40 d-flex-center b-r-50 overflow-hidden">
                        <img src="../assets/images/icons/logo6.png" alt="" class="img-fluid">
                      </div>
                      <a href="project_details.html" target="_blank" class="flex-grow-1 ps-2">
                        <h6 class="m-0 text-dark f-w-600">Designing</h6>
                        <div class="text-muted f-s-14 f-w-500">Logo Designing</div>
                      </a>
                      <div class="dropdown">
                        <button class="bg-none border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="ti ti-dots-vertical text-dark"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                          <li>
                            <a class="dropdown-item" href="#">
                              <i class="ti ti-edit text-success"></i> Edit
                            </a>
                          </li>
                          <li>
                            <a class="dropdown-item delete-button" href="#">
                              <i class="ti ti-trash text-danger"></i> Delete
                            </a>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="d-flex">
                      <div>
                        <h6 class="text-dark f-s-14 f-w-500">Start Date : <span class="text-success">2024-07-16 </span></h6>
                        <h6 class="text-dark f-s-14 f-w-500">End Date : <span class="text-danger">2024-09-26</span></h6>
                      </div>
                      <div class="flex-grow-1 text-end">
                        <p class="f-w-500 text-secondary">Goal</p>
                        <h6 class="f-w-600">$400</h6>
                      </div>
                    </div>
                    <p class="text-muted f-s-14 text-secondary txt-ellipsis-2">I am a keen, hardworking, reliable and
                      excellent timekeeper. I am a bright and receptive person</p>
                    <div class="text-end mb-2">
                      <span class="badge text-light-success">Progress</span>
                    </div>
                    <div class="progress w-100" role="progressbar" aria-valuenow="75" aria-valuemin="0"
                      aria-valuemax="100">
                      <div class="progress-bar bg-success" style="width: 75%"> 75% </div>
                    </div>
                  </div>
                  <div class="card-footer">
                    <div class="row">
                      <div class="col-6">
                        <span class="text-dark f-w-600"><i class="ti ti-brand-wechat"></i> 5 Volunteers</span>
                      </div>
                      <div class="col-6">

                        <ul class="avatar-group float-end breadcrumb-start ">
                          <li class="h-25 w-25 d-flex-center b-r-50 text-bg-danger b-2-light position-relative"
                            data-bs-toggle="tooltip" data-bs-title="Sabrina Torres">
                            <img src="../assets/images/avtar/4.png" alt=""
                                  class="img-fluid b-r-50 overflow-hidden">
                          </li>
                          <li class="h-25 w-25 d-flex-center b-r-50 text-bg-success b-2-light position-relative"
                            data-bs-toggle="tooltip" data-bs-title="Sabrina Torres">
                            <img src="../assets/images/avtar/1.png" alt=""
                                  class="img-fluid b-r-50 overflow-hidden">
                          </li>
                          <li class="h-25 w-25 d-flex-center b-r-50 text-bg-success b-2-light position-relative"
                            data-bs-toggle="tooltip" data-bs-title="Sabrina Torres">
                            <img src="../assets/images/avtar/5.png" alt=""
                                  class="img-fluid b-r-50 overflow-hidden">
                          </li>
                          <li class="text-bg-primary h-25 w-25 d-flex-center b-r-50" data-bs-toggle="tooltip"
                            data-bs-title="5 More">
                            2+
                          </li>
                        </ul>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
          <div id="tab-3" class="tabs-content">
            <div class="row">
              <div class="col-md-6 col-xl-4 project-card">
                <div class="card hover-effect">
                  <div class="card-header">
                    <div class="d-flex align-items-center">
                      <div class="h-40 w-40 d-flex-center b-r-50 overflow-hidden">
                        <img src="../assets/images/icons/logo4.png" alt="" class="img-fluid">
                      </div>
                      <a href="project_details.html" target="_blank" class="flex-grow-1 ps-2">
                        <h6 class="m-0 text-dark f-w-600"> Web Development</h6>
                        <div class="text-muted f-s-14 f-w-500">Weather Application</div>
                      </a>
                      <div class="dropdown">
                        <button class="bg-none border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="ti ti-dots-vertical text-dark"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                          <li>
                            <a class="dropdown-item" href="#">
                              <i class="ti ti-edit text-success"></i> Edit
                            </a>
                          </li>
                          <li>
                            <a class="dropdown-item delete-button" href="#">
                              <i class="ti ti-trash text-danger"></i> Delete
                            </a>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="d-flex">
                      <div>
                        <h6 class="text-dark f-s-14 f-w-500">Start Date : <span class="text-success">2024-06-16 </span></h6>
                        <h6 class="text-dark f-s-14 f-w-500">End Date : <span class="text-danger">2024-01-01</span></h6>
                      </div>
                      <div class="flex-grow-1 text-end">
                        <p class="f-w-500 text-secondary">Goal</p>
                        <h6 class="f-w-600">$400k</h6>
                      </div>
                    </div>
                    <p class="text-muted f-s-14 text-secondary txt-ellipsis-2">I am a keen, hardworking, reliable and
                      excellent timekeeper. I am a bright and receptive person</p>
                    <div class="text-end mb-2">
                      <span class="badge text-light-success">Progress</span>
                    </div>
                    <div class="progress w-100" role="progressbar" aria-valuenow="90" aria-valuemin="0"
                      aria-valuemax="100">
                      <div class="progress-bar bg-success" style="width: 90%"> 90% </div>
                    </div>
                  </div>
                  <div class="card-footer">
                    <div class="row">
                      <div class="col-6">
                        <span class="text-dark f-w-600"><i class="ti ti-brand-wechat"></i> 34 Volunteers</span>
                      </div>
                      <div class="col-6">

                        <ul class="avatar-group float-end breadcrumb-start ">
                          <li class="h-25 w-25 d-flex-center b-r-50 text-bg-danger b-2-light position-relative"
                            data-bs-toggle="tooltip" data-bs-title="Sabrina Torres">
                            <img src="../assets/images/avtar/4.png" alt=""
                                  class="img-fluid b-r-50 overflow-hidden">
                          </li>
                          <li class="h-25 w-25 d-flex-center b-r-50 text-bg-success b-2-light position-relative"
                            data-bs-toggle="tooltip" data-bs-title="Sabrina Torres">
                            <img src="../assets/images/avtar/1.png" alt=""
                                  class="img-fluid b-r-50 overflow-hidden">
                          </li>
                          <li class="h-25 w-25 d-flex-center b-r-50 text-bg-success b-2-light position-relative"
                            data-bs-toggle="tooltip" data-bs-title="Sabrina Torres">
                            <img src="../assets/images/avtar/5.png" alt=""
                                  class="img-fluid b-r-50 overflow-hidden">
                          </li>
                          <li class="text-bg-primary h-25 w-25 d-flex-center b-r-50" data-bs-toggle="tooltip"
                            data-bs-title="5 More">
                            10+
                          </li>
                        </ul>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
              <div class="col-md-6 col-xl-4 project-card">
                <div class="card hover-effect">
                  <div class="card-header">
                    <div class="d-flex align-items-center">
                      <div class="h-40 w-40 d-flex-center b-r-50 overflow-hidden">
                        <img src="../assets/images/icons/logo5.png" alt="" class="img-fluid">
                      </div>
                      <a href="project_details.html" target="_blank" class="flex-grow-1 ps-2">
                        <h6 class="m-0 text-dark f-w-600"> Web Design</h6>
                        <div class="text-muted f-s-14 f-w-500">Application Designing</div>
                      </a>
                      <div class="dropdown">
                        <button class="bg-none border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="ti ti-dots-vertical text-dark"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                          <li>
                            <a class="dropdown-item" href="#">
                              <i class="ti ti-edit text-success"></i> Edit
                            </a>
                          </li>
                          <li>
                            <a class="dropdown-item delete-button" href="#">
                              <i class="ti ti-trash text-danger"></i> Delete
                            </a>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="d-flex">
                      <div>
                        <h6 class="text-dark f-s-14 f-w-500">Start Date : <span class="text-success">2024-06-16 </span></h6>
                        <h6 class="text-dark f-s-14 f-w-500">End Date : <span class="text-danger">2024-01-01</span></h6>
                      </div>
                      <div class="flex-grow-1 text-end">
                        <p class="f-w-500 text-secondary">Goal</p>
                        <h6 class="f-w-600">$200k</h6>
                      </div>
                    </div>
                    <p class="text-muted f-s-14 text-secondary txt-ellipsis-2">I am a keen, hardworking, reliable and
                      excellent timekeeper. I am a bright and receptive person</p>
                    <div class="text-end mb-2">
                      <span class="badge text-light-primary">Progress</span>
                    </div>
                    <div class="progress w-100" role="progressbar" aria-valuenow="50" aria-valuemin="0"
                      aria-valuemax="100">
                      <div class="progress-bar bg-primary" style="width: 50%"> 50% </div>
                    </div>
                  </div>
                  <div class="card-footer">
                    <div class="row">
                      <div class="col-6">
                        <span class="text-dark f-w-600"><i class="ti ti-brand-wechat"></i> 15 Volunteers</span>
                      </div>
                      <div class="col-6">

                        <ul class="avatar-group float-end breadcrumb-start ">
                          <li class="h-25 w-25 d-flex-center b-r-50 text-bg-danger b-2-light position-relative"
                            data-bs-toggle="tooltip" data-bs-title="Sabrina Torres">
                            <img src="../assets/images/avtar/4.png" alt=""
                                  class="img-fluid b-r-50 overflow-hidden">
                          </li>
                          <li class="h-25 w-25 d-flex-center b-r-50 text-bg-success b-2-light position-relative"
                            data-bs-toggle="tooltip" data-bs-title="Sabrina Torres">
                            <img src="../assets/images/avtar/1.png" alt=""
                                  class="img-fluid b-r-50 overflow-hidden">
                          </li>
                          <li class="h-25 w-25 d-flex-center b-r-50 text-bg-success b-2-light position-relative"
                            data-bs-toggle="tooltip" data-bs-title="Sabrina Torres">
                            <img src="../assets/images/avtar/5.png" alt=""
                                  class="img-fluid b-r-50 overflow-hidden">
                          </li>
                          <li class="text-bg-primary h-25 w-25 d-flex-center b-r-50" data-bs-toggle="tooltip"
                            data-bs-title="5 More">
                            10+
                          </li>
                        </ul>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Projects end -->
  </div>
</main>
@endsection