@extends('layouts.backend.app_admin_dashboard')
@section('content')
<!-- Browser Defaults -->
              <div class="col-12" style="margin-top:25px">
                <div class="card">
                  <div class="card-header d-flex flex-column gap-2">
                    <h5>Update Account Information</h5>
                    <p class="text-secondary">Please, fill in the blanks with the required information.</p>
                  </div>
                  <div class="card-body">
                    <form class="row g-3" method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
                      <div class="col-md-4">
                        <label for="validationDefault01" class="form-label">First name</label>
                        <input type="text" class="form-control" id="validationDefault01" value="{{ Auth::user()->first_name }}" name="first_name" required>
                      </div>
                      <div class="col-md-4">
                        <label for="validationDefault02" class="form-label">Last name</label>
                        <input type="text" class="form-control" id="validationDefault02" value="{{ Auth::user()->last_name }}"  name="last_name"  required>
                      </div>
                      <div class="col-md-4">
                        <label for="validationDefaultUsername" class="form-label">Username</label>
                        <div class="input-group">
                          <input type="text" class="form-control" id="validationDefaultUsername" value="{{ Auth::user()->username }}"
                                  name="username"  required>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <label for="validationDefault03" class="form-label">Email</label>
                        <input type="email" class="form-control"name="email" id="validationDefault03" value="{{ Auth::user()->email }}" placeholder="enter your email" required>
                      </div>
                      <div class="col-md-5">
                        <label for="image" class="form-label">Profile picture</label>
                        <input type="file" class="form-control"name="image" id="image"  required>
                    
                      </div>
                      
                      
                      <div class="col-12">
                        <button class="btn btn-primary" type="submit">Submit form</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <!-- Browser Defaults -->
@endsection