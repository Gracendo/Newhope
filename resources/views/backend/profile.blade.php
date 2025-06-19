@extends('layouts.backend.app_admin_dashboard')
@section('content')
<div class="profile-tab profile-container">
                                                    <div class="image-details">
                                                        <div class="profile-image"></div>
                                                        <div class="profile-pic">
                                                            <div class="avatar-upload">
                                                                <div class="avatar-edit">
                                                                    <input type="file" id="imageUpload"
                                                                        accept=".png, .jpg, .jpeg">
                                                                    <label for="imageUpload"><i
                                                                            class="ti ti-photo-heart"></i></label>
                                                                </div>
                                                                <div class="avatar-preview">
                                                                    <div id="imgPreview">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="person-details">
                                                        <h5 class="f-w-600">Ninfa Monaldo
                                                            <img width="20" height="20" src="../assets/images/profile-app/01.png" alt="instagram-check-mark">
                                                        </h5>
                                                        <p>Web designer &amp; Developer</p>
                                                    </div>

                                                    <form class="app-form">
                                                        <h5 class="mb-2 text-dark f-w-600">User Info</h5>
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Username</label>
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Maria C. Eck">
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Email address</label>
                                                                    <input type="email" class="form-control"
                                                                        placeholder="MariaCEck@teleworm.us">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Password</label>
                                                                    <input type="password" class="form-control"
                                                                        placeholder="*******">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Confirm Password</label>
                                                                    <input type="password" class="form-control"
                                                                        placeholder="*******">
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="app-divider-v dotted"></div>
                                                            </div>
                                                            <h5 class="mb-2 text-dark f-w-600">Personal Info</h5>
                                                            <div class="col-12">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Address</label>
                                                                    <textarea class="form-control"
                                                                        placeholder="1098 Asylum Avenu New Haven, CT 06510"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Address 2</label>
                                                                    <textarea class="form-control"
                                                                        placeholder="51244 Ankunding Villages, Reicheltown, IL 84366"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="inputCity"
                                                                        class="form-label">City</label>
                                                                    <input type="text" class="form-control"
                                                                        id="inputCity" placeholder="oregon">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="mb-3">
                                                                    <label for="inputState"
                                                                        class="form-label">State</label>
                                                                    <select id="inputState" class="form-select">
                                                                        <option selected>Choose...</option>
                                                                        <option>USA</option>
                                                                        <option>Canada</option>
                                                                        <option>Australia</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="mb-3">
                                                                    <label for="inputZip" class="form-label">Zip</label>
                                                                    <input type="text" class="form-control"
                                                                        id="inputZip" placeholder="CT 06510">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-xl-4">
                                                                <div class="">
                                                                    <label class="form-label">language</label>
                                                                    <select
                                                                        class="select-langauge form-select select-basic"
                                                                        name="state">
                                                                        <option value="EN">English</option>
                                                                        <option value="GU">Gujarati</option>
                                                                        <option value="HI">Hindi</option>
                                                                        <option value="DU">Dutch</option>
                                                                        <option value="FR">French</option>
                                                                        <option value="RU">Russian</option>
                                                                        <option value="KO">Korean</option>
                                                                        <option value="TA">Tamil</option>
                                                                        <option value="SP">Spanish</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="text-end">
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Submit</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
@endsection