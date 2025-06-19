@extends('layouts.backend.app_admin_dashboard')
@section('content')
<!-- Tooltips start -->
              <div class="col-12">
                <div class="card">
                  <div class="card-header d-flex flex-column gap-2">
                    <h5>Tooltips</h5>
                    <p class="text-secondary">If your form layout allows it, you can swap the SP <span
                            class="text-danger"> .{valid|invalid}-feedback</span> classes for
                      <span class="text-danger"> .{valid|invalid}-tooltip</span> classes to display validation feedback
                      in a styled tooltip. Be sure to
                      have a parent with <span class="text-danger">position: relative </span>on it for tooltip
                      positioning. In the example below, our
                      column classes have this already, but your project may require an alternative setup.
                    </p>
                  </div>
                  <div class="card-body">
                    <form class="row g-3 app-form" id="form-validation">
                      <div class="col-md-6">
                        <label for="userName" class="form-label">User Name</label>
                        <input type="text" class="form-control" id="userName" name="userName">
                        <div class="mt-1">
                          <span id="userNameError" class="text-danger"></span>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email">
                        <div class="mt-1">
                          <span id="emailError" class="text-danger"></span>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password">
                        <div class="mt-1">
                          <span id="passwordError" class="text-danger"></span>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" placeholder="1234 Main St">
                        <div class="mt-1">
                          <span id="addressError" class="text-danger"></span>
                        </div>
                      </div>
                      <div class="col-md-5">
                        <label for="address2" class="form-label">Address 2</label>
                        <input type="text" class="form-control" id="address2" placeholder="Address">
                        <div class="mt-1">
                          <span id="addressError2" class="text-danger"></span>
                        </div>
                      </div>
                      <div class="col-md-5">
                        <label for="city" class="form-label">City</label>
                        <input type="text" class="form-control" id="city">
                        <div class="mt-1">
                          <span id="cityError" class="text-danger"></span>
                        </div>
                      </div>
                      <div class="col-md-2">
                        <label for="zipCode" class="form-label">Zip</label>
                        <input type="text" class="form-control" id="zipCode">
                        <div class="mt-1">
                          <span id="zipCodeError" class="text-danger"></span>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-check d-flex gap-1">
                          <input class="form-check-input mg-2" type="checkbox" id="gridCheck">
                          <label class="form-check-label" for="gridCheck">
                            Check me out
                          </label>
                        </div>
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
