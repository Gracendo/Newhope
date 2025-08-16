@extends('layouts.backend.app_admin_dashboard')
@section('content')
   
<main>
<!-- Breadcrumb with role indicator -->
  <div class="container-fluid">
    <div class="row m-1">
      <div class="col-12">
        <h4 class="main-title">Donations Management</h4>
        <ul class="app-line-breadcrumbs mb-3">
          <li>
            <a href="#" class="f-s-14 f-w-500">
              <span>
                <i class="ph-duotone ph-hand-heart f-s-16"></i> Donations
              </span>
            </a>
          </li>
          <li>
            <a href="#" class="f-s-14 f-w-500">Donation Management</a>
          </li>
        </ul>
        @if(auth('admin')->user()->role === 'orphanagemanager')
            <div class="alert alert-info">
              <i class="ph-info-fill me-2"></i> 
              You are viewing only donations to your orphanage/campaigns. 
              Amounts displayed reflect 90% of actual donations (10% platform fee deducted).
            </div>
        @endif
      </div>
    </div>
<!-- Breadcrumb end -->

    <!-- Projects start -->
    <div class="row">
      <!-- Donation Statistics Card -->
      
      <!-- Summary Stats Card -->
      <div class="col-xl-4">
        <div class="card mb-4">
            <div class="card-header">
                <h5>Quick Stats</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6 mb-3">
                        <div class="stat-card bg-primary-light">
                            <h6>Total Donations</h6>
                            <h3>{{ number_format($totalDonations, 2) }} FCFA</h3>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
      </div>
    </div>
    <!-- start here    -->
<!-- Default Datatable start -->
              <div class="col-12">
                <div class="card ">
                  <div class="card-header d-flex  justify-content-between align-items-center ">
                     <h5>Donations Management</h5>
                     <div class="me-3">
                      <div class=" dropdown ">
                        <button class="btn btn-success dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                          <i class="fa fa-download me-1"></i> Export
                        </button>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="#"><i class="fa-solid fa-file-pdf fa-fw"></i>Pdf</a></li>
                          <li><a class="dropdown-item" href="#"><i class="fa-solid fa-file-excel fa-fw"></i>Excell</a></li>
                        </ul>
                      </div>
                     </div>
                     
                    </div>
                  <div class="card-body p-0">
                    <div class="app-datatable-default overflow-auto">
                      <table id="example" class="display app-data-table default-data-table">
                        <thead>
                          <tr>
                            
                            <th>Reference</th>
                            <th>Donor</th>
                            <th>Amount</th>
                            <th>Destination</th>
                            <th>Method</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Actions</th>
                   
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($donations as $donation)
                          <tr>
                            <td>{{ $donation->reference ?? 'N/A' }}</td>
                            <td>
                              @if($donation->anonymous)
                                <span class="badge bg-secondary">Anonymous</span>
                              @else
                                {{ $donation->donor_name ?? 'Guest' }}
                              @endif
                            </td>
                            <td>
                              @if(auth('admin')->user()->role === 'orphanagemanager')
                                {{ number_format($donation->amount * 0.9, 2) }} FCFA
                              @else
                                {{ number_format($donation->amount, 2) }} FCFA
                              @endif
                            </td>
                            <td>
                              @if($donation->orphanage)
                                <span class="badge bg-info">Orphanage: {{ Str::limit($donation->orphanage->name, 15) }}</span>
                              @elseif($donation->campaign)
                                <span class="badge bg-primary">Campaign: {{ Str::limit($donation->campaign->name, 15) }}</span>
                              @else
                                <span class="badge bg-secondary">General</span>
                              @endif
                            </td>
                            <td>
                              <span class="badge bg-{{ $donation->payment_method === 'MTN' ? 'dark' : 'warning text-dark' }}">
                                {{ $donation->payment_method }}
                              </span>
                            </td>
                            <td>
                              <span class="badge bg-{{ 
                                $donation->status === 'successful' ? 'success' : 
                                ($donation->status === 'failed' ? 'danger' : 'warning') 
                              }}">
                                {{ ucfirst($donation->status) }}
                              </span>
                            </td>
                            <td>{{ $donation->created_at->format('M d, Y') }}</td>
                            <td>
                              <button class="btn btn-sm btn-info" data-bs-toggle="modal" 
                                data-bs-target="#donationDetailsModal{{ $donation->id }}">
                                <i class="fa fa-eye"></i>
                              </button>
                            </td>
                          </tr>
                          @endforeach
                  </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Default Datatable end -->

    <!--///////-->
    
    <!-- Projects end -->
    
    <!-- Donation Details Modal -->
    @foreach($donations as $donation)
    <div class="modal fade" id="donationDetailsModal{{ $donation->id }}" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Donation Details</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row mb-3">
              <div class="col-6">
                <p class="mb-1"><strong>Reference:</strong></p>
                <p>{{ $donation->reference ?? 'N/A' }}</p>
              </div>
              <div class="col-6">
                <p class="mb-1"><strong>Date:</strong></p>
                <p>{{ $donation->created_at->format('M d, Y H:i') }}</p>
              </div>
            </div>
            
            <div class="row mb-3">
              <div class="col-6">
                <p class="mb-1"><strong>Donor:</strong></p>
                <p>
                  @if($donation->anonymous)
                    Anonymous
                  @else
                    {{ $donation->donor_name }}<br>
                    <small>{{ $donation->donor_email }}</small>
                  @endif
                </p>
              </div>
              <div class="col-6">
                <p class="mb-1"><strong>Amount:</strong></p>
                <p>
                  {{ number_format($donation->amount, 2) }} FCFA
                  @if(auth('admin')->user()->role === 'orphanagemanager')
                    <br><small class="text-success">You receive: {{ number_format($donation->amount * 0.9, 2) }} FCFA</small>
                  @endif
                </p>
              </div>
            </div>
            
            <div class="row mb-3">
              <div class="col-12">
                <p class="mb-1"><strong>Destination:</strong></p>
                <p>
                  @if($donation->orphanage)
                    Orphanage: {{ $donation->orphanage->name }}
                  @elseif($donation->campaign)
                    Campaign: {{ $donation->campaign->title }}
                  @else
                    General Donation
                  @endif
                </p>
              </div>
            </div>
            
            <div class="row">
              <div class="col-6">
                <p class="mb-1"><strong>Payment Method:</strong></p>
                <p>{{ $donation->payment_method }}</p>
              </div>
              <div class="col-6">
                <p class="mb-1"><strong>Status:</strong></p>
                <p>
                  <span class="badge bg-{{ 
                    $donation->status === 'successful' ? 'success' : 
                    ($donation->status === 'failed' ? 'danger' : 'warning') 
                  }}">
                    {{ ucfirst($donation->status) }}
                  </span>
                </p>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</main>

@endsection