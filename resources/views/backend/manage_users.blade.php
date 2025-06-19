@extends('layouts.backend.app_admin_dashboard')
@section('content')
<!-- Simple Table start -->
<div class="col-xl-12" style="margin-top:40px;">
                            <div class="card">
                                <div class="card-header" >
                                    <h5> LIST OF USERS</h5>
                                    <p>This table shows the list of all the users in the system
                                    </p>
									<button type="button" class="btn btn-outline-primary" style="float:right;">ADD USER</button>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table align-middle mb-0">
                                            <thead>
                                            <tr>
                                                <th scope="col">Id</th>
                                                <th scope="col">Username</th>
                                                <th scope="col">Country Id</th>
                                                <th scope="col">City</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Contact</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>
                                                    <div class="d-flex align-items-center ">
                                                        <div class="h-30 w-30 d-flex-center b-r-50 overflow-hidden text-bg-primary me-2 simple-table-avtar">
                                                            <img src="../assets/images/avtar//1.png" alt=""
                                                                 class="img-fluid">
                                                        </div>
                                                        <p class="mb-0 f-w-500 ">Tiger Nixon</p>
                                                    </div>
                                                </td>
                                                <td class="f-w-500">Architect</td>
                                                <td class="text-secondary f-w-600">Edinburgh</td>
                                                <td><span class="badge text-light-primary">active</span></td>
                                                <td class="text-success f-w-500">$320,800</td>
                                                <td>+1 (025) 466-7506</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="h-30 w-30 d-flex-center b-r-50 overflow-hidden text-bg-secondary me-2 simple-table-avtar">
                                                            <img src="../assets/images/avtar//2.png" alt=""
                                                                 class="img-fluid">
                                                        </div>
                                                        <p class="mb-0 f-w-500 ">Garrett</p>
                                                    </div>
                                                </td>
                                                <td class="f-w-500">Accountant</td>
                                                <td class="text-secondary f-w-600">Tokyo</td>
                                                <td><span class="badge text-light-secondary">pending</span></td>
                                                <td class="text-success f-w-500">$170,750</td>
                                                <td>+1 (790) 476-9505</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="h-30 w-30 d-flex-center b-r-50 overflow-hidden text-bg-success me-2 simple-table-avtar">
                                                            <img src="../assets/images/avtar//3.png" alt=""
                                                                 class="img-fluid">
                                                        </div>
                                                        <p class="mb-0 f-w-500 ">Ashton Cox</p>
                                                    </div>
                                                </td>
                                                <td class="f-w-500">Technical</td>
                                                <td class="text-secondary f-w-600">Francisco</td>
                                                <td><span class="badge text-light-success">pending</span></td>
                                                <td class="text-success f-w-500">$86,000</td>
                                                <td>+1 (227) 375-6641</td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="h-30 w-30 d-flex-center b-r-50 overflow-hidden text-bg-info me-2 simple-table-avtar">
                                                            <img src="../assets/images/avtar//4.png" alt=""
                                                                 class="img-fluid">
                                                        </div>
                                                        <p class="mb-0 f-w-500 ">Cedric Kelly</p>
                                                    </div>
                                                </td>
                                                <td class="f-w-500">Developer</td>
                                                <td class="text-secondary f-w-600">Edinburgh</td>
                                                <td><span class="badge text-light-info">active</span></td>
                                                <td class="text-success f-w-500">$433,060</td>
                                                <td>+1 (213) 619-7749</td>
                                            </tr>
                                            <tr>
                                                <td>5</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="h-30 w-30 d-flex-center b-r-50 overflow-hidden text-bg-warning me-2 simple-table-avtar">
                                                            <img src="../assets/images/avtar//5.png" alt=""
                                                                 class="img-fluid">
                                                        </div>
                                                        <p class="mb-0 f-w-500 ">Airi Satou</p>
                                                    </div>
                                                </td>
                                                <td class="f-w-500">Accountant</td>
                                                <td class="text-secondary f-w-600">Tokyo</td>
                                                <td><span class="badge text-light-warning">pending</span></td>
                                                <td class="text-success f-w-500">$162,700</td>
                                                <td>+1 (152) 465-2290</td>
                                            </tr>
                                            <tr>
                                                <td >6</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="h-30 w-30 d-flex-center b-r-50 overflow-hidden text-bg-danger me-2 simple-table-avtar">
                                                            <img src="../assets/images/avtar//6.png" alt=""
                                                                 class="img-fluid">
                                                        </div>
                                                        <p class="mb-0 f-w-500 ">Williamson</p>x
                                                    </div>
                                                </td>
                                                <td class="f-w-500">Integration</td>
                                                <td class="text-secondary f-w-600">New York</td>
                                                <td><span
                                                        class="badge text-light-danger">active</span></td>
                                                <td class="text-success f-w-500">$372,000</td>
                                                <td>+1 (185) 793-6446</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Simple Table end -->
@endsection
