@extends('layouts.app')

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>My Profile</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item">My Profile</li>
                </ol>
            </nav>
        </div>

        <section class="section profile">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body pt-3">
                            <ul class="nav nav-tabs nav-tabs-bordered">
                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                                </li>
                            </ul>
                            <div class="tab-content pt-2">
                                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                    <h5 class="card-title">Profile Details</h5>
                                    <div class="row">
                                        <div class="col-lg-2 col-md-4 label ">Name</div>
                                        <div class="col-lg-9 col-md-8">{{ Auth::user()->name }}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-2 col-md-4 label">Email</div>
                                        <div class="col-lg-9 col-md-8">{{ Auth::user()->email }}</div>
                                    </div>
                                </div>

                                <div class="tab-pane fade pt-3" id="profile-change-password">
                                    <form id="form_new_password">
                                        <div class="row mb-3">
                                            <label for="current_password" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                                            <div class="col-md-4 col-lg-4">
                                                <input name="current_password" type="password" class="form-control" id="current_password">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="password" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                                            <div class="col-md-4 col-lg-4">
                                                <input name="password" id="password" type="password" class="form-control">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="password" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                                            <div class="col-md-4 col-lg-4">
                                                <input name="password_confirmation" id="password_confirmation" type="password" class="form-control">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-4 col-lg-4">
                                                <button type="submit" class="btn btn-primary" id="btn_submit_password">Change Password</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('js')
    <script src="{{url('/js/profile.js')}}" type="application/javascript"></script>
@endsection
