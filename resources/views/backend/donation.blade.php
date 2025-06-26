@extends('layouts.backend.app_admin_dashboard')
@section('content')
 <!-- Modal -->
<div class="modal fade" id="donationModal" tabindex="-1" aria-labelledby="donationModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="donationModalLabel">Add Donation</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form class="app-form" method="POST" action="{{ route('donations.store') }}" enctype="multipart/form-data">
          @csrf

          <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" class="form-control" name="title" placeholder="Donation title" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Amount Goal</label>
            <input type="number" step="0.01" class="form-control" name="amount" placeholder="e.g. 50000" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Raised Amount</label>
            <input type="number" step="0.01" class="form-control" name="raised" value="0">
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
            <label class="form-label">Donation Description</label>
            <textarea class="form-control" rows="3" name="donation_content" placeholder="Enter details..."></textarea>
          </div>

          <div class="mb-3">
            <label class="form-label">Slug</label>
            <input type="text" class="form-control" name="slug" placeholder="unique-slug">
          </div>

          <div class="mb-3">
            <label class="form-label">Excerpt</label>
            <input type="text" class="form-control" name="excerpt" placeholder="Short summary">
          </div>

          <div class="mb-3">
            <label class="form-label">Deadline</label>
            <input type="date" class="form-control" name="deadline">
          </div>

          <div class="mb-3">
            <label class="form-label">Image</label>
            <input type="file" class="form-control" name="image" accept=".jpg,.jpeg,.png">
          </div>

          <div class="mb-3">
            <label class="form-label">Gallery Images</label>
            <input type="file" class="form-control" name="image_gallery[]" multiple accept=".jpg,.jpeg,.png">
          </div>

          <div class="mb-3">
            <label class="form-label">FAQ</label>
            <textarea class="form-control" name="faq" rows="3" placeholder="Questions fréquentes..."></textarea>
          </div>

          <div class="mb-3">
            <label class="form-label">Meta Title</label>
            <input type="text" class="form-control" name="meta_title">
          </div>

          <div class="mb-3">
            <label class="form-label">Meta Tags (comma-separated)</label>
            <input type="text" class="form-control" name="meta_tags">
          </div>

          <div class="mb-3">
            <label class="form-label">Meta Description</label>
            <textarea class="form-control" name="meta_description" rows="2"></textarea>
          </div>

          <div class="mb-3">
            <label class="form-label">Featured?</label>
            <select name="featured" class="form-control">
              <option value="no">No</option>
              <option value="yes">Yes</option>
            </select>
          </div>

          <!-- Optional: Meta Open Graph -->
          <div class="mb-3">
            <label class="form-label">OG Meta Title</label>
            <input type="text" class="form-control" name="og_meta_title">
          </div>

          <div class="mb-3">
            <label class="form-label">OG Meta Description</label>
            <textarea class="form-control" name="og_meta_description" rows="2"></textarea>
          </div>

          <div class="mb-3">
            <label class="form-label">OG Meta Image</label>
            <input type="file" class="form-control" name="og_meta_image" accept=".jpg,.jpeg,.png">
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Add Donation</button>
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
  <div class="col-12">
    <h4 class="main-title">Donations</h4>
    <ul class="app-line-breadcrumbs mb-3">
      <li>
        <a href="#" class="f-s-14 f-w-500">
          <span>
            <i class="ph-duotone ph-hand-heart f-s-16"></i> Donations
          </span>
        </a>
      </li>
      <li>
        <a href="#" class="f-s-14 f-w-500">Manage Donations</a>
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
            <li class="tab-link active" data-tab="1">All Donations</li>
            <li class="ms-auto">
              <div class="text-end">
                <button class="btn btn-primary w-45 h-45 icon-btn b-r-10 m-2" data-bs-toggle="modal" data-bs-target="#donationModal"><i class="ti ti-plus f-s-18"></i></button>
              </div>
            </li>
          </ul>
        </div>
        <div class="content-wrapper" id="card-container">
          <div id="tab-1" class="tabs-content active">
            <div class="row">
              @foreach($donations as $donation)
                <div class="col-md-6 col-xl-4">
                  <div class="card hover-effect">
                    <div class="card-header">
                      <div class="d-flex align-items-center">
                        <div class="h-40 w-40 d-flex-center b-r-50 overflow-hidden">
                          <img src="{{ asset('storage/' . $donation->image) }}" alt="Donation Image" class="img-fluid">
                        </div>
                        <div class="flex-grow-1 ps-2">
                          <h6 class="m-0 text-dark f-w-600">{{ $donation->title }}</h6>
                          <div class="text-muted f-s-14">{{ $donation->created_by }}</div>
                        </div>
                        <!-- Dropdown actions -->
                      </div>
                    </div>
                    <div class="card-body">
                      <p>{{ Str::limit($donation->donation_content, 100) }}</p>
                      <div class="text-end mb-2">
                        <span class="badge bg-primary">{{ $donation->status }}</span>
                      </div>
                      <div class="progress w-100">
                        @php
                          $progress = $donation->amount > 0 ? round(($donation->raised / $donation->amount) * 100) : 0;
                        @endphp
                        <div class="progress-bar bg-success" style="width: {{ $progress }}%">{{ $progress }}%</div>
                      </div>
                    </div>
                    <div class="card-footer text-end">
                      <small>Deadline: {{ $donation->deadline }}</small>
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
@endsection