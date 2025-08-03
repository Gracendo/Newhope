@extends('layouts.backend.app_admin_dashboard')
@section('content')

<main>
          <div class="container-fluid">
            <div class="row">
             
              <!-- campaigns -->
              <div class=" col-xxl-16 order--2-lg">
                <div class="card equal-card">
                  <div class="card-body">
                    <div class="row" >
                      <div class="col-sm-16">
                        <h5 class="header-title-text">Campaign Status</h5>

                        <div class="project-status-box">
                          <div class="project-status-card bg-primary">
                            <span class="bg-light-light h-45 w-45 d-flex-center b-r-50">
                              <i class="ph-fill  ph-projector-screen-chart"></i>
                            </span>
                            <p class="mb-0 mt-2">Total Campaigns</p>
                            <h4 class="text-white f-w-600">{{ $statusCounts['total'] }}</h4>
                          </div>
                          <div class="project-status-card bg-warning">
                            <span class="bg-light-dark h-45 w-45 d-flex-center b-r-50">
                              <i class="ph ph-chart-line-up"></i>
                            </span>
                            <p class="mb-0 mt-2">Pending</p>
                            <h4 class="text-white f-w-600">{{ $statusCounts['pending'] }}</h4>
                          </div>
                          <div class="project-status-card">
                            <span class="bg-light-secondary h-45 w-45 d-flex-center b-r-50">
                              <i class="ph-bold  ph-check-circle"></i>
                            </span>
                            <p class="mb-0 mt-2">Active</p>
                            <h4 class="f-w-600">{{ $statusCounts['active'] }}</h4>
                          </div>
                          <div class="project-status-card bg-success">
                            <span class="bg-light h-45 w-45 d-flex-center b-r-50">
                              <!-- <i class="ph-bold  ph-check-circle"></i> -->
                               <i class="fa-solid fa-archive fa-fw"></i>
                              
                            </span>
                            <p class="mb-0 mt-2">Completed</p>
                            <h4 class="f-w-600">{{ $statusCounts['completed'] }}</h4>
                          </div>
                          <div class="project-status-card bg-dark">
                            <span class="bg-light-danger h-45 w-45 d-flex-center b-r-50">
                              <!-- <i class="ph-bold  ph-check-circle"></i> -->
                              <i class="fa-solid fa-times-circle fa-fw"></i>
                            </span>
                            <p class="mb-0 mt-2">Rejected</p>
                            <h4 class="f-w-600">{{ $statusCounts['rejected'] }}</h4>
                          </div>
                        </div>

                        
                        
                      </div> 
                    </div>
                  </div>
                </div>
              </div>
               
              <!-- table start -->
              <div class="col-xxl-19 order-1-md">
                  <div class="card">
                      <div class="card-header d-flex justify-content-between align-items-center">
                          <h5>Campaigns Management</h5>
                          <div class="d-flex">
                              <!-- Search Box -->
                              <form method="GET" class="me-3">
                                  <div class="input-group">
                                      <input type="text" name="search" class="form-control" 
                                            placeholder="Search campaigns..." 
                                            value="{{ request()->input('search') }}">
                                      <button class="btn btn-primary" type="submit">
                                          <i class="fa fa-search"></i>
                                      </button>
                                  </div>
                              </form>
                
                <!-- Export Buttons -->
                              <div class="dropdown">
                                  <button class="btn btn-success dropdown-toggle" type="button" 
                                          data-bs-toggle="dropdown" aria-expanded="false">
                                      <i class="fa fa-download me-1"></i> Export
                                  </button>
                                  <ul class="dropdown-menu">
                                      <li><a class="dropdown-item" href="#"><i class="fa fa-file-excel me-2"></i> Excel</a></li>
                                      <li><a class="dropdown-item" href="#"><i class="fa fa-file-pdf me-2"></i> PDF</a></li>
                                              </ul>
                                          </div>
                                      </div>
                              </div>
        
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="bg-light">
                                    <tr>
                                        <th width="5%">#</th>
                                        <th>Campaign</th>
                                        <th>Status</th>
                                        <th>Orphanage</th>
                                        <th>Volunteers</th>
                                        <th>Goal (FCFA)</th>
                                        <th>Raised (FCFA)</th>
                                        <th>Progress</th>
                                        <th>End Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($campaigns as $campaign)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if($campaign->image)
                                                <div class="flex-shrink-0 me-3">
                                                    <img src="{{ asset('storage/'.$campaign->image) }}" 
                                                        alt="{{ $campaign->name }}" 
                                                        class="rounded-circle" width="40" height="40">
                                                </div>
                                                @endif
                                                <div class="flex-grow-1">
                                                    <h6 class="mb-0">{{ $campaign->name }}</h6>
                                                    <small class="text-muted">
                                                        {{ $campaign->created_at->format('M d, Y') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @php
                                                $isCompleted = $campaign->status === 'approved' && 
                                                              $campaign->end_date < now()
                                            @endphp
                                            
                                            
                                            <span class="badge rounded-pill bg-{{ 
                                                $isCompleted ? 'info' : 
                                                ($campaign->status === 'approved' ? 'success' : 
                                                ($campaign->status === 'pending' ? 'warning' : 'danger'))
                                            }}">
                                                {{ $isCompleted ? 'Completed' : ucfirst($campaign->status) }}
                                            </span>
                                        </td>
                                        <td>{{ optional($campaign->orphanage)->name ?? 'N/A' }}</td>
                                        <td>
                                            <div class="avatar-group">
                                                @foreach($campaign->volunteers->take(3) as $volunteer)
                                                <div class="avatar-xs" data-bs-toggle="tooltip" 
                                                    title="{{ $volunteer->user->name ?? 'Volunteer' }}">
                                                    <span class="avatar-title rounded-circle bg-{{ 
                                                        $volunteer->status === 'approved' ? 'success' : 
                                                        ($volunteer->status === 'pending' ? 'warning' : 'secondary')
                                                    }}">
                                                        {{ substr($volunteer->user->name ?? 'V', 0, 1) }}
                                                    </span>
                                                </div>
                                                @endforeach
                                                @if($campaign->volunteers->count() > 3)
                                                <div class="avatar-xs" data-bs-toggle="tooltip" 
                                                    title="{{ $campaign->volunteers->count() - 3 }} more">
                                                    <span class="avatar-title rounded-circle bg-secondary">
                                                        +{{ $campaign->volunteers->count() - 3 }}
                                                    </span>
                                                </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td>{{ number_format($campaign->goal_amount) }}</td>
                                        <td>{{ number_format($campaign->raised_amount) }}</td>
                                        <td>
                                            @php
                                                $progress = $campaign->goal_amount > 0 
                                                    ? ($campaign->raised_amount / $campaign->goal_amount) * 100 
                                                    : 0;
                                            @endphp
                                            <div class="d-flex align-items-center">
                                                <div class="progress flex-grow-1" style="height: 6px;">
                                                    <div class="progress-bar bg-{{ 
                                                        $progress >= 100 ? 'success' : 
                                                        ($progress > 50 ? 'primary' : 'warning')
                                                    }}" role="progressbar" style="width: {{ $progress }}%"></div>
                                                </div>
                                                <small class="ms-2">{{ round($progress) }}%</small>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="{{ $campaign->end_date < now() ? 'text-danger' : '' }}">
                                                {{ $campaign->end_date }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-light dropdown-toggle" 
                                                        type="button" data-bs-toggle="dropdown">
                                                    Actions
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item" 
                                                          href="{{ route('admin.campaignDetails', $campaign->id) }}">
                                                            <i class="fa fa-eye me-2"></i> View
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="#">
                                                            <i class="fa fa-edit me-2"></i> Edit
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="10" class="text-center py-4">
                                            <div class="d-flex flex-column align-items-center">
                                                <i class="fa fa-folder-open fa-2x text-muted mb-2"></i>
                                                No campaigns found
                                            </div>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Pagination -->
                        <div class="card-footer d-flex justify-content-between align-items-center">
                            <div class="text-muted">
                                Showing {{ $campaigns->firstItem() }} to {{ $campaigns->lastItem() }} 
                                of {{ $campaigns->total() }} entries
                            </div>
                            <div>
                                {{ $campaigns->links() }}
                            </div>
                        </div>
                    </div>
            </div>
        </div>
              
            
            </div>
          </div>
        </main>
@endsection