@extends('layouts.backend.app_admin_dashboard')

@section('content')
<main>
    <div class="container-fluid">
        <!-- Breadcrumb -->
         <div class="row m-1">
             <div class="col-15">
                <h4 class="main-title">{{ $campaign->name }} - Details</h4>
                <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.campaign') }}">Campaigns</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Details</li>
                    </ol>
             
            </div> 
        </div> 
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('warning'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{ session('warning') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
        <!-- Campaign Summary -->
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5>Campaign Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Orphanage:</strong> {{ $campaign->orphanage->name ?? 'N/A' }}</p>
                                <p><strong>Goal Amount:</strong> {{ number_format($campaign->goal_amount, 2) }} FCFA</p>
                                <p><strong>Raised Amount:</strong> {{ number_format($campaign->raised_amount, 2) }} FCFA</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Start Date:</strong> {{ \Carbon\Carbon::parse($campaign->start_date)->format('M d, Y') }}</p>
                                <p><strong>End Date:</strong> {{ \Carbon\Carbon::parse($campaign->end_date)->format('M d, Y') }}</p><p><strong>Status:</strong> 
                                    <span class="badge bg-{{ 
                                        $campaign->status === 'approved' ? 'success' : 
                                        ($campaign->status === 'rejected' ? 'danger' : 'warning') 
                                    }}">
                                        {{ ucfirst($campaign->status) }}
                                    </span>
                                </p>
                            </div>
                        </div>
                        <hr>
                        <p><strong>Description:</strong></p>
                        <p>{{ $campaign->description }}</p>
                    </div>
                </div>
            </div>

            <!-- Progress Card -->
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5>Funding Progress</h5>
                    </div>
                    <div class="card-body">
                        @php
                            $progress = $campaign->goal_amount > 0 
                                ? ($campaign->raised_amount / $campaign->goal_amount) * 100 
                                : 0;
                        @endphp
                        <div class="progress mb-3" style="height: 30px;">
                            <div class="progress-bar bg-success progress-bar-striped" 
                                 role="progressbar" 
                                 style="width: {{ $progress }}%" 
                                 aria-valuenow="{{ $progress }}" 
                                 aria-valuemin="0" 
                                 aria-valuemax="100">
                                {{ round($progress, 2) }}%
                            </div>
                        </div>
                        <div class="row text-center">
                            <div class="col-md-6">
                                <h6>Raised</h6>
                                <p class="text-success">{{ number_format($campaign->raised_amount, 2) }} FCFA</p>
                            </div>
                            <div class="col-md-6">
                                <h6>Goal</h6>
                                <p>{{ number_format($campaign->goal_amount, 2) }} FCFA</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Volunteer Management Section -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Volunteer Management</h5>
                        <div class="d-flex ">
                            <div class="me-3">
                         <div class="input-group">
                            <input type="text" id="volunteerSearch" class="form-control" placeholder="Search volunteers...">
                            <button class="btn btn-primary" type="submit">
                                          <i class="fa fa-search"></i>
                                      </button>
                        </div>
                        </div>
                        
                        <div class="dropdown">
                                <button class="btn btn-success dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                               <i class="fa fa-download me-1"></i> Export
                                </button>
                                <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('admin.campaigns.export.pdf', $campaign->id) }}"><i class="fa-solid fa-file-pdf fa-fw"></i>Pdf</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.campaigns.export.excel', $campaign->id) }}"><i class="fa-solid fa-file-excel fa-fw"></i>Excell</a></li>
                                </ul>
                        </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if($campaign->volunteers->isEmpty())
                            <div class="alert alert-info">No volunteers have applied for this campaign yet.</div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Status</th>
                                            <th>Applied On</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($campaign->volunteers as $volunteer)
                                        <tr>
                                            <td>{{ $volunteer->user->first_name }} {{ $volunteer->user->last_name }}</td>
                                            <td>{{ $volunteer->user->email }}</td>
                                            <td>{{ $volunteer->user->phone ?? 'N/A' }}</td>
                                            <td>
                                                <span class="badge bg-{{ 
                                                    $volunteer->status === 'approved' ? 'success' : 
                                                    ($volunteer->status === 'rejected' ? 'danger' : 'warning') 
                                                }}">
                                                    {{ ucfirst($volunteer->status) }}
                                                </span>
                                            </td>
                                            <td>{{ $volunteer->created_at->format('M d, Y') }}</td>
                                           <td>
                                                @if($volunteer->status === 'pending')
                                                <form action="{{ route('admin.volunteers.approve', $volunteer->id) }}" method="POST" style="display:inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-success">
                                                        <i class="fa-solid fa-thumbs-up fa-fw"></i>
                                                    </button>
                                                </form>
                                                
                                                <form action="{{ route('admin.volunteers.reject', $volunteer->id) }}" method="POST" style="display:inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fa-solid fa-thumbs-down fa-fw"></i>
                                                    </button>
                                                </form>
                                                @elseif($volunteer->status === 'approved' && !$volunteer->reward_granted)
                                                <form action="{{ route('admin.volunteers.grant-reward', $volunteer->id) }}" method="POST" style="display:inline">
                                                    @csrf
                                                    <button   type="submit" class="btn btn-light-success icon-btn b-r-4" 
                                                           >
                                                        <i class="fa-solid  fa-gift fa-fw"></i>
                                                    </button>
                                                </form>
                                            
                                                @else
                                                <span class="badge text-bg-success">rewarded</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


@endsection