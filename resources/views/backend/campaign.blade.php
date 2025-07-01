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

          <!-- <div class="mb-3">
            <label class="form-label">Preferred Amounts (comma-separated)</label>
            <input type="text" class="form-control" name="prefered_amounts" placeholder="e.g. 500,1000,2500">
          </div> -->

          <div class="mb-3">
            <label class="form-label">Raised Amount</label>
            <input type="number" step="0.01" class="form-control" name="raised_amount" value="0">
          </div>

          <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-control">
              <option value="pending">Pending</option>
              <option value="inProgress">In progress</option>
             
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
                                      <!-- <a class="dropdown-item" href="{{ route('campaigns.edit', $project->id) }}" data-bs-toggle="modal" data-bs-target="#editcampaign">
                                        <i class="ti ti-edit text-success"></i> Edit
                                      </a> -->
                                      <a class="dropdown-item" href="#" 
                                          data-bs-toggle="modal" 
                                          data-bs-target="#editcampaign"
                                          data-campaign-id="{{ $project->id }}">
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
</script>
@endsection