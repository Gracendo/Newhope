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
                            <th>{{__('Role')}}</th>
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
                              <td>{{$data->role}}</td>
                              <td>{{$data->email}} @if($data->email_verified == 1) <i class="fas fa-check-circle text-success"></i> @endif</td>
                              <td>
                                <!-- {{$data->status}} -->
                                @if($data->status =='approved')
                                      <span class="badge text-bg-primary">{{__('Approved')}}</span>
                                    @elseif($data->status == 'pending')
                                      <span class="badge text-bg-warning">{{__('Pending Approval')}}</span>
                                    @else
                                      <span class="badge text-bg-danger">{{__('Rejected')}}</span>
                                  @endif
                                </td>
                                <td>
                                      @if($data->status =='approved')
                                          <button type="button" class="btn btn-light-success icon-btn b-r-4">
                                              <i class="ti ti-edit text-success"></i> 
                                          </button>
                                          <button type="button" class="btn btn-light-danger icon-btn b-r-4 delete-btn">
                                              <i class="ti ti-trash"></i>
                                          </button>
                                      @else
                                          @if($data->status !== 'approved')
                                              <form action="{{ route('admin.users.approve', $data->id) }}" method="POST" style="display: inline;">
                                                  @csrf
                                                  <button type="submit" class="btn btn-sm btn-success">
                                                      <i class="fa-solid fa-thumbs-up fa-fw"></i>
                                                  </button>
                                              </form>
                                          @endif
                                      
                                          @if($data->status !== 'rejected')
                                              <!-- Reject Button Triggering Modal -->
                                              <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" 
                                                  data-bs-target="#rejectModal-{{$data->id}}">
                                                  <i class="fa-solid fa-thumbs-down fa-fw"></i>
                                              </button>
                                              
                                              <!-- Rejection Modal -->
                                              <div class="modal fade" id="rejectModal-{{$data->id}}" tabindex="-1" aria-hidden="true">
                                                  <div class="modal-dialog">
                                                      <div class="modal-content">
                                                          <form action="{{ route('admin.users.reject', $data->id) }}" method="POST">
                                                              @csrf
                                                              <div class="modal-header">
                                                                  <h5 class="modal-title">Reject User</h5>
                                                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                              </div>
                                                              <div class="modal-body">
                                                                  <div class="mb-3">
                                                                      <label class="form-label">Reason (optional)</label>
                                                                      <textarea name="reason" class="form-control" rows="3" placeholder="Enter rejection reason..."></textarea>
                                                                  </div>
                                                              </div>
                                                              <div class="modal-footer">
                                                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                  <button type="submit" class="btn btn-danger">Confirm Rejection</button>
                                                              </div>
                                                          </form>
                                                      </div>
                                                  </div>
                                              </div>
                                          @endif
                                      @endif
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
