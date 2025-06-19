@extends('layouts.backend.app_admin_dashboard')
@section('content')
<!-- Tooltips start -->
              <div class="col-12" style="margin-top:20px">
                <div class="card">
                  <div class="card-header d-flex flex-column gap-2">
                    <h5>ADD USER</h5>
                    <p class="text-secondary">Create a new user by filling in the required information. <span
                            class="text-danger"> Be ware of entering the right credentials. </span> 
                  </div>
                  <div class="card-body">
                    <form class="row g-3 app-form" id="form-validation">
                      <div class="col-md-4">
                        <label for="userName" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="userName" name="first_name"placeholder="Martin">
                        <div class="mt-1">
                          <span id="userNameError" class="text-danger"></span>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <label for="validationCustom02" class="form-label">Last name</label>
                        <input type="text" class="form-control" id="validationCustom02" placeholder="Otto" name="last_name" required>
                        <div class="valid-feedback">
                          Looks good!
                        </div>
                      </div>
                      <div class="col-md-4">
                        <label for="validationCustomUsername" class="form-label">Username</label>
                        <div class="input-group has-validation">
                          <span class="input-group-text" id="inputGroupPrepend">@</span>
                          <input type="text" class="form-control" id="validationCustomUsername"
                                 aria-describedby="inputGroupPrepend" name="username" required>
                          <div class="invalid-feedback">
                            Please choose a username.
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email">
                        <div class="mt-1">
                          <span id="emailError" class="text-danger"></span>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                        <div class="mt-1">
                          <span id="passwordError" class="text-danger"></span>
                        </div>
                      </div>
                      <div class="col-md-2">
                        <label for="Countryid" class="form-label">Country ID</label>
                        <input type="text" class="form-control" id="Countryid" name="Country_id">
                        <div class="mt-1">
                          <span id="zipCodeError" class="text-danger"></span>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <label for="zipCode" class="form-label">Zip</label>
                        <input type="text" class="form-control" id="zipCode" name="code_zip">
                        <div class="mt-1">
                          <span id="zipCodeError" class="text-danger"></span>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <label for="address" class="form-label">State OR REGION </label>
                        <input type="text" class="form-control" id="address" name="state" placeholder="TEXAS / NORTH">
                        <div class="mt-1">
                          <span id="addressError" class="text-danger"></span>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <label for="city" class="form-label">City</label>
                        <input type="text" class="form-control" id="city" name="city">
                        <div class="mt-1">
                          <span id="cityError" class="text-danger"></span>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="1234 Main St">
                        <div class="mt-1">
                          <span id="addressError" class="text-danger"></span>
                        </div>
                      </div>
                      
                       
                      <div class="col-md-6">
                        <label for="validationCustom04" class="form-label">Status</label>
                        <select class="form-select" id="validationCustom04" name="status" required>
                          <option selected disabled value="">Choose...</option>
                          <option>Orphanage Manager</option>
                          <option>Contributor</option>

                        </select> 
                      </div>
                      <div class="col-md-6">
                        <label for="validationCustomUsername" class="form-label">Phone number</label>
                        <div class="input-group has-validation">
                          <span class="input-group-text" id="inputGroupPrepend">+237</span>
                          <input type="number" class="form-control" id="validationCustomUsername"
                                 aria-describedby="inputGroupPrepend" name="phone" required>
                        </div>
                        <br>
                      
                      </div>
                      <div class="col-12">
                        <button type="submit" value="Submit" class="btn btn-primary">Submit form</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <!-- Tooltips end -->
@endsection
