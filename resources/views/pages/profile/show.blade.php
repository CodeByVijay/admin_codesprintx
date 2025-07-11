@extends('layout.app')
@section('title', 'My Profile')

@push('style')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endpush

@section('content')

    {{-- breadcrumb --}}
    <x-breadcrumb :items="[
        ['label' => 'Home', 'url' => route('dashboard')],
        ['label' => 'My Profile', 'url' => '#'],
    ]" title="My Profile" />

    <section class="content">
        @include('layout.flash-message')

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                @if($user->profile_picture)
                                    <img class="profile-user-img img-fluid img-circle"
                                         src="{{ asset('storage/' . $user->profile_picture) }}"
                                         alt="{{ $user->name }}"
                                         style="width: 150px; height: 150px; object-fit: cover;">
                                @else
                                    <img class="profile-user-img img-fluid img-circle"
                                         src="{{ asset('asset/dist/img/user4-128x128.jpg') }}"
                                         alt="User profile picture"
                                         style="width: 150px; height: 150px; object-fit: cover;">
                                @endif
                            </div>

                            <h3 class="profile-username text-center">{{ $user->name }}</h3>
                            <p class="text-muted text-center">{{ $user->email }}</p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Member Since</b> <a class="float-right">{{ $user->created_at->format('M d, Y') }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Last Updated</b> <a class="float-right">{{ $user->updated_at->format('M d, Y') }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Profile Status</b> <a class="float-right"><span class="badge badge-success">Active</span></a>
                                </li>
                            </ul>

                            <a href="{{ route('profile.edit') }}" class="btn btn-primary btn-block"><b>Edit Profile</b></a>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- About Me Box -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">About Me</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <strong><i class="fas fa-user mr-1"></i> Name</strong>
                            <p class="text-muted">{{ $user->name }}</p>
                            <hr>

                            <strong><i class="fas fa-envelope mr-1"></i> Email</strong>
                            <p class="text-muted">{{ $user->email }}</p>
                            <hr>

                            <strong><i class="fas fa-calendar mr-1"></i> Joined</strong>
                            <p class="text-muted">{{ $user->created_at->format('F d, Y \a\t h:i A') }}</p>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->

                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Activity</a></li>
                                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="activity">
                                    <!-- Activity content -->
                                    <div class="timeline timeline-inverse">
                                        <!-- timeline time label -->
                                        <div class="time-label">
                                            <span class="bg-danger">
                                                {{ now()->format('d M. Y') }}
                                            </span>
                                        </div>
                                        <!-- /.timeline-label -->

                                        <!-- timeline item -->
                                        <div>
                                            <i class="fas fa-user bg-info"></i>
                                            <div class="timeline-item">
                                                <span class="time"><i class="far fa-clock"></i> {{ $user->updated_at->diffForHumans() }}</span>
                                                <h3 class="timeline-header border-0">Profile last updated</h3>
                                            </div>
                                        </div>
                                        <!-- END timeline item -->

                                        <!-- timeline item -->
                                        <div>
                                            <i class="fas fa-sign-in-alt bg-green"></i>
                                            <div class="timeline-item">
                                                <span class="time"><i class="far fa-clock"></i> {{ $user->created_at->diffForHumans() }}</span>
                                                <h3 class="timeline-header border-0">Account created</h3>
                                            </div>
                                        </div>
                                        <!-- END timeline item -->

                                        <div>
                                            <i class="far fa-clock bg-gray"></i>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->

                                <div class="tab-pane" id="settings">
                                    <!-- Settings content -->
                                    <div class="row">
                                        <div class="col-12">
                                            <h5>Quick Actions</h5>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <div class="card card-outline card-info">
                                                        <div class="card-body text-center">
                                                            <i class="fas fa-edit fa-2x text-info mb-3"></i>
                                                            <h6>Edit Profile</h6>
                                                            <p class="text-muted">Update your personal information</p>
                                                            <a href="{{ route('profile.edit') }}" class="btn btn-info btn-sm">Edit Profile</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <div class="card card-outline card-warning">
                                                        <div class="card-body text-center">
                                                            <i class="fas fa-lock fa-2x text-warning mb-3"></i>
                                                            <h6>Change Password</h6>
                                                            <p class="text-muted">Update your account password</p>
                                                            <a href="{{ route('profile.edit') }}#password-section" class="btn btn-warning btn-sm">Change Password</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>

@endsection
