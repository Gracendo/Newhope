@extends('layouts.backend.app_admin_dashboard')
@section('content')
 <!-- Create Campaign Modal -->
<div class="modal fade" id="projectCard" tabindex="-1" aria-labelledby="projectCardLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="projectCardLabel">Create Campaign</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="app-form" method="POST" action="{{ route('campaigns.store') }}" enctype="multipart/form-data">
          @csrf

          <!-- <div class="mb-3">
            <label for="orphanage_id" class="form-label">Orphanage</label>
            <select name="orphanage_id" id="orphanage_id" class="form-control" required>
              <option value="">Select orphanage</option>
              @foreach($orphanages as $orphanage)
                <option value="{{ $orphanage->id }}">{{ $orphanage->name }}</option>
              @endforeach
            </select>
          </div> -->
          <div class="mb-3">
             <label for="orphanage_id" class="form-label">Orphanage</label>
            @if(auth()->user()->role === 'orphanagemanager')
                @php
                    $orphanage = auth()->user()->orphanage; 
                @endphp
                <input type="text" class="form-control" value="{{ $orphanage->name }}" readonly>
                <input type="hidden" name="orphanage_id" value="{{ $orphanage->id }}">
            @else
                <select name="orphanage_id" id="orphanage_id" class="form-control" required>
                    <option value="">Select orphanage</option>
                    @foreach($orphanages as $orphanage)
                        <option value="{{ $orphanage->id }}">{{ $orphanage->name }}</option>
                    @endforeach
                </select>
            @endif
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
            <input type="date" class="form-control" name="start_date"  min="{{ now()->addWeeks(2)->format('Y-m-d') }}">
          </div>

          <div class="mb-3">
            <label class="form-label">End Date</label>
            <input type="date"  id="endDate" class="form-control" name="end_date" min="{{ now()->addWeeks(4)->format('Y-m-d') }}">
          </div>

          <div class="mb-3" style="display:none">
            <label class="form-label">Project Duration</label>
            <input type="text"  readonly id="projectDuration" class="form-control" name="project_duration" placeholder="e.g. 6 months">
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

          <!-- <div class="mb-3">
            <label class="form-label">Preferred Amounts (comma-separated)</label>
            <input type="text" class="form-control" name="prefered_amounts" placeholder="e.g. 500,1000,2500">
          </div> -->
           @if(auth()->user()->role === 'admin')
          <div class="mb-3">
            <label class="form-label">Raised Amount</label>
            <input type="number" step="0.01" class="form-control" name="raised_amount" value="0">
          </div>
         
          <div class="mb-3">
           
            <label class="form-label">Status</label>
                            <select name="status">
                                <option value="pending">Pending</option>
                                <option value="approved">Approved</option>
                                <option value="rejected">Rejected</option>
                            </select>
                      
          </div>
            @endif
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


<!-- Edit Campaign Modal -->
<div class="modal fade" id="editcampaign" tabindex="-1" aria-labelledby="editcampaignLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editcampaignLabel">Edit Campaign</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="app-form" method="POST" id="editCampaignForm" enctype="multipart/form-data">
          @csrf
          @method('PUT')

          <div class="mb-3">
            <label for="edit_orphanage_id" class="form-label">Orphanage</label>
            <select name="orphanage_id" id="edit_orphanage_id" class="form-control" required>
              <option value="">Select orphanage</option>
              @foreach($orphanages as $orphanage)
                <option value="{{ $orphanage->id }}">{{ $orphanage->name }}</option>
              @endforeach
            </select>
          </div>

          <div class="mb-3">
            <label for="edit_pName" class="form-label">Campaign Name</label>
            <input type="text" class="form-control" placeholder="Designing" id="edit_pName" name="name" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Image</label>
            <input type="file" class="form-control" name="image" accept=".jpg,.jpeg,.png">
            <small class="text-muted">Leave empty to keep current image</small>
            <div id="currentImagePreview" class="mt-2"></div>
          </div>

          <div class="mb-3">
            <label class="form-label">Gallery Images (multiple)</label>
            <input type="file" class="form-control" name="gallery[]" multiple accept=".jpg,.jpeg,.png">
            <small class="text-muted">Leave empty to keep current gallery</small>
            <div id="currentGalleryPreview" class="d-flex flex-wrap mt-2"></div>
          </div>

          <div class="mb-3">
            <label class="form-label">Start Date</label>
            <input type="date" class="form-control" name="start_date" id="edit_start_date">
          </div>

          <div class="mb-3">
            <label class="form-label">End Date</label>
            <input type="date" class="form-control" name="end_date" id="edit_end_date">
          </div>

          <div class="mb-3">
            <label class="form-label">Project Duration</label>
            <input type="text" class="form-control" name="project_duration" id="edit_project_duration" placeholder="e.g. 6 months">
          </div>

          <div class="mb-3">
            <label class="form-label">Campaign Objectif</label>
            <textarea class="form-control" rows="3" name="objectif" id="edit_objectif" placeholder="Enter campaign goal"></textarea>
          </div>

          <div class="mb-3">
            <label class="form-label">Campaign Description</label>
            <textarea class="form-control" rows="3" name="description" id="edit_description" placeholder="Enter description"></textarea>
          </div>

          <div class="mb-3">
            <label class="form-label">Goal Amount</label>
            <input type="number" step="0.01" class="form-control" name="goal_amount" id="edit_goal_amount" placeholder="10000">
          </div>

          <div class="mb-3">
            <label class="form-label">Raised Amount</label>
            <input type="number" step="0.01" class="form-control" name="raised_amount" id="edit_raised_amount" value="0">
          </div>

          <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" id="edit_status" class="form-control">
              <option value="pending">Pending</option>
              <option value="inProgress">In progress</option>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label">Business Plan (PDF)</label>
            <input type="file" class="form-control" name="business_plan" accept=".pdf">
            <small class="text-muted">Leave empty to keep current business plan</small>
            <div id="currentBusinessPlanPreview" class="mt-2"></div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Update</button>
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
            <li class="tab-link" data-tab="2">Pending Campaigns</li>
            <li class="tab-link" data-tab="3"> Approved Campaigns</li>
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
            @foreach($campaigns as $campaign)
            <div class="col-md-6 col-xl-4 project-card" data-status="{{ $campaign->status }}">
                <div class="card hover-effect">
                    <!-- Card Header -->
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <!-- Campaign Image -->
                            <div class="h-40 w-40 d-flex-center b-r-50 overflow-hidden">
                                <img src="{{ asset('storage/' . $campaign->image) }}" alt="Campaign Image" class="img-fluid">
                            </div>
                            
                            <!-- Campaign Name and Orphanage -->
                            <div class="flex-grow-1 ps-2">
                                <h6 class="m-0 text-dark f-w-600">{{ $campaign->name }}</h6>
                                <div class="text-muted f-s-14 f-w-500">
                                    {{ $campaign->orphanage->name ?? 'N/A' }}
                                </div>
                            </div>
                            
                            <!-- Dropdown Menu -->
                            <div class="dropdown">
                                <button class="bg-none border-0" type="button" data-bs-toggle="dropdown">
                                    <i class="ti ti-dots-vertical text-dark"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end">
                                    
                                    @if(auth()->user()->role === 'admin')
                                    <!-- Download Button (Always Visible) -->
                                    <a class="dropdown-item" href="{{ route('admin.campaigns.download', $campaign->id) }}">
                                        <i class="ti ti-download text-info"></i> Download Plan
                                    </a>
                                        <!-- Approve/Reject Buttons -->
                                        @if($campaign->isPending())
                                            <a class="dropdown-item approve-btn" href="#" data-campaign-id="{{ $campaign->id }}">
                                                <i class="ti ti-check text-success"></i> Approve
                                            </a>
                                            <a class="dropdown-item reject-btn" href="#" data-campaign-id="{{ $campaign->id }}">
                                                <i class="ti ti-x text-danger"></i> Reject
                                            </a>
                                        @endif
                                    @endif
                                    
                                    <!-- Edit Button -->
                                    <a class="dropdown-item" href="#" 
                                       data-bs-toggle="modal" 
                                       data-bs-target="#editcampaign"
                                       data-campaign-id="{{ $campaign->id }}">
                                        <i class="ti ti-edit text-success"></i> Edit
                                    </a>
                                    
                                    <!-- Delete Button -->
                                    <a class="dropdown-item delete-button" href="#">
                                        <i class="ti ti-trash text-danger"></i> Delete
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Card Body -->
                    <div class="card-body">
                        <!-- Dates -->
                        <div class="d-flex">
                            <div>
                                <h6 class="text-dark f-s-14">Start Date: <span class="text-success">{{ $campaign->start_date }}</span></h6>
                                <h6 class="text-dark f-s-14">End Date: <span class="text-danger">{{ $campaign->end_date }}</span></h6>
                            </div>
                            <div class="flex-grow-1 text-end">
                                <p class="f-w-500 text-secondary">Goal Amount</p>
                                <h6 class="f-w-600">{{ number_format($campaign->goal_amount, 0) }}FCFA</h6>
                            </div>
                        </div>
                        
                        <!-- Campaign Description -->
                        <p class="text-muted f-s-14 text-secondary txt-ellipsis-2">
                           {{ Str::limit($campaign->description, 30, '...') }}
                        </p>
                        
                        <!-- Status Badge -->
                        <div class="text-end mb-2">
                            @if($campaign->isApproved())
                                <span class="badge bg-success">Approved</span>
                            @elseif($campaign->isPending())
                                <span class="badge bg-warning">Pending</span>
                            @elseif($campaign->isRejected())
                                <span class="badge bg-danger">Rejected</span>
                            @endif
                        </div>
                        
                        <!-- Progress Bar -->
                        @php
                            $progress = $campaign->goal_amount > 0 
                                ? round(($campaign->raised_amount / $campaign->goal_amount) * 100)
                                : 0;
                        @endphp
                        <div class="progress w-100" role="progressbar" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar bg-primary" style="width: {{ $progress }}%">{{ $progress }}%</div>
                        </div>
                    </div>
                    
                    <!-- Card Footer -->
                    <div class="card-footer">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <!-- <span class="text-dark f-w-600">
                                    <i class="ti ti-brand-wechat f-s-18"></i> 
                                    {{ $campaign->volunteers_count ?? 0 }} Volunteers
                                </span> -->
                            </div>
                            
                            <!-- Details Button (Only for approved campaigns) -->
                            <div class="col-6 text-end">
                                @if($campaign->isApproved())
                                    <a href="{{ route('admin.campaignDetails', $campaign->id) }}" 
                                       class="btn btn-sm btn-primary">
                                        See Details
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
      </div>
    </div>
    <!-- Projects end -->
  </div>
</main>
<script>

document.addEventListener('DOMContentLoaded', function() {
    // Handle edit button clicks
    document.querySelectorAll('[data-bs-target="#editcampaign"]').forEach(button => {
        button.addEventListener('click', function() {
            const campaignId = this.getAttribute('data-campaign-id');
            if (!campaignId) return;
            
            // Show loading state
            const modal = new bootstrap.Modal(document.getElementById('editcampaign'));
            modal.show();
            
            // Fetch campaign data
            fetch(`/admin-dash/campaigns/${campaignId}/edit`, {
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => {
                const contentType = response.headers.get('content-type');
                if (!contentType || !contentType.includes('application/json')) {
                    return response.text().then(text => {
                        throw new Error(`Expected JSON but got: ${text.substring(0, 100)}...`);
                    });
                }
                return response.json();
            })
            .then(data => {
                console.log('Full response data:', data); // Debug complet
                
                // Accédez aux données via data.campaign
                const campaign = data.campaign;
                console.log('Campaign name:', campaign.name); // Maintenant ça devrait fonctionner
                
                // Populate form fields
                document.getElementById('edit_orphanage_id').value = campaign.orphanage_id;
                document.getElementById('edit_pName').value = campaign.name;
                document.getElementById('edit_start_date').value = campaign.start_date;
                document.getElementById('edit_end_date').value = campaign.end_date;
                document.getElementById('edit_project_duration').value = campaign.project_duration || '';
                document.getElementById('edit_objectif').value = campaign.objectif || '';
                document.getElementById('edit_description').value = campaign.description || '';
                document.getElementById('edit_goal_amount').value = campaign.goal_amount || 0;
                document.getElementById('edit_raised_amount').value = campaign.raised_amount || 0;
                document.getElementById('edit_status').value = campaign.status || 'pending';
                
                // Show current image
                const imagePreview = document.getElementById('currentImagePreview');
                imagePreview.innerHTML = data.current_image_url ? 
                    `<img src="${data.current_image_url}" alt="Current Image" style="max-width: 100px; max-height: 100px;" class="img-thumbnail">` : 
                    'No image uploaded';
                
                // Show current business plan
                const businessPlanPreview = document.getElementById('currentBusinessPlanPreview');
                businessPlanPreview.innerHTML = data.business_plan_url ? 
                    `<a href="${data.business_plan_url}" target="_blank" class="btn btn-sm btn-info">View Current Business Plan</a>` : 
                    'No business plan uploaded';
                
                // Update form action
                document.getElementById('editCampaignForm').action = `/admin-dash/campaigns/${campaignId}`;
            })
            .catch(error => {
                console.error('Error fetching campaign data:', error);
                alert('Error loading campaign data. Please check console for details.');
            });
        });
    });
});
////
// Handle approve/reject buttons
document.querySelectorAll('.approve-btn, .reject-btn').forEach(button => {
    button.addEventListener('click', function(e) {
        e.preventDefault();
        const campaignId = this.getAttribute('data-campaign-id');
        const isApprove = this.classList.contains('approve-btn');
        const url = isApprove 
            ? `/admin-dash/campaigns/${campaignId}/approve`
            : `/admin-dash/campaigns/${campaignId}/reject`;
            
        fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload(); // Refresh to show updated status
            } else {
                alert('Operation failed: ' + (data.message || 'Unknown error'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please check console for details.');
        });
    });
});

// Update card click behavior
// document.querySelectorAll('.project-card .card-header a').forEach(link => {
//     link.addEventListener('click', function(e) {
//         const card = this.closest('.project-card');
//         const status = card.dataset.status; // Make sure to add data-status to your card
        
//         if (status === 'pending' || status === 'rejected') {
//             e.preventDefault();
//             alert('This campaign is not yet approved for viewing.');
//         }
//     });
// });
////
document.getElementById('start_date').addEventListener('change', function() {
    const startDate = new Date(this.value);
    const endDateInput = document.getElementById('end_date');
    
    // Set minimum end date (start date + 1 week)
    const minEndDate = new Date(startDate);
    minEndDate.setDate(minEndDate.getDate() + 7);
    endDateInput.min = minEndDate.toISOString().split('T')[0];
    
    // Calculate duration if end date exists
    calculateDuration();
});

document.getElementById('end_date').addEventListener('change', calculateDuration);

function calculateDuration() {
    const start = document.getElementById('start_date').value;
    const end = document.getElementById('end_date').value;
    
    if (start && end) {
        const diffTime = new Date(end) - new Date(start);
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
        document.getElementById('project_duration').value = diffDays + ' days';
    }
}
</script>

<style>
.clickable {
    cursor: pointer;
}
.non-clickable {
    cursor: not-allowed;
    opacity: 0.7;
}
</style>
@endsection