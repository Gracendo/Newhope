@extends('layouts.backend.app_admin_dashboard')
@section('content')
<!-- Default Datatable start -->
              <div class="col-12">
                <div class="card ">
                  <div class="card-header" style="margin-top:20px;">
                    <h5>LIST OF USERS</h5>
                    <p>This table contains the list of all users in the system  </p>
                  <a href="{{route('admin.addUser')}}" onclick="window.location.href='{{ route('admin.addUser') }}'; return false;" type="button" class="btn btn-outline-primary" style="float:right;">ADD USER</a>
                    </div>
                  <div class="card-body p-0">
                    <div class="app-datatable-default overflow-auto">
                      <table id="example" class="display app-data-table default-data-table">
                        <thead>
                          <tr>
                            <th>{{__('ID')}}</th>
                            <th>{{__('Name')}}</th>
                            <th>{{__('Phone')}}</th>
                            <th>{{__('Email')}}</th>
                            <th>{{__('User Verify Status')}}</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($all_user as $data)
                            <tr>
                              <td>{{$data->id}}</td>
                              <td>{{$data->first_name}} {{$data->last_name}} <span class="badge text-light-primary">({{$data->username}})</span></td>
                              <td>{{$data->phone}}</td>
                              <td>{{$data->email}} @if($data->email_verified == 1) <i class="fas fa-check-circle text-success"></i> @endif</td>
                              <td>
                                @if($data->user_verify_status == 0)
                                    <span class="badge badge-danger">{{__('Not Verified')}}</span>
                                  @elseif($data->user_verify_status == 1)
                                    <span class="badge badge-warning">{{__('Pending Approval')}}</span>
                                  @else
                                    <span class="badge badge-success">{{__('Verified')}}</span>
                                @endif
                              </td>
                              <td>
                                <button type="button" class="btn btn-light-success icon-btn b-r-4">
                                  <i class="ti ti-edit text-success"></i> 
                                </button>
                                <button type="button" class="btn btn-light-danger icon-btn b-r-4 delete-btn">
                                  <i class="ti ti-trash"></i>
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


 @endsection
