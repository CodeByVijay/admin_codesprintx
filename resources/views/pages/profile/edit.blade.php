@extends('layout.app')
@section('title', 'Edit Profile')

@push('style')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endpush

@section('content')

    {{-- breadcrumb --}}
    <x-breadcrumb :items="[
        ['label' => 'Home', 'url' => route('dashboard')],
        ['label' => 'My Profile', 'url' => route('profile.show')],
        ['label' => 'Edit Profile', 'url' => '#'],
    ]" title="Edit Profile" backUrl="{{ route('profile.show') }}" />

    <section class="content">
        @include('layout.flash-message')

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="container-fluid">
            <div class="row">
                <!-- Profile Information -->
                <div class="col-md-6">
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <h3 class="card-title">Profile Information</h3>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <!-- Current Profile Picture -->
                                <div class="form-group text-center">
                                    <label>Current Profile Picture</label>
                                    <div class="mb-3">
                                        @if($user->profile_picture)
                                            <img src="{{ asset('storage/' . $user->profile_picture) }}"
                                                 alt="{{ $user->name }}"
                                                 class="img-circle elevation-2"
                                                 style="width: 120px; height: 120px; object-fit: cover;"
                                                 id="currentProfileImage">
                                        @else
                                            <img src="{{ asset('asset/dist/img/user4-128x128.jpg') }}"
                                                 alt="Default profile"
                                                 class="img-circle elevation-2"
                                                 style="width: 120px; height: 120px; object-fit: cover;"
                                                 id="currentProfileImage">
                                        @endif
                                    </div>
                                    @if($user->profile_picture)
                                        <a href="{{ route('profile.remove-picture') }}"
                                           class="btn btn-sm btn-danger"
                                           onclick="return confirm('Are you sure you want to remove your profile picture?')">
                                            <i class="fas fa-trash"></i> Remove Picture
                                        </a>
                                    @endif
                                </div>

                                <!-- Profile Picture Upload -->
                                <div class="form-group">
                                    <label for="profile_picture">New Profile Picture</label>
                                    <input type="file" class="form-control-file" name="profile_picture" id="profile_picture" accept="image/*">
                                    <small class="text-muted">Accepted formats: JPEG, PNG, JPG, GIF. Max size: 2MB</small>
                                    @error('profile_picture')
                                        <span class="text-danger d-block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Image Preview -->
                                <div id="imagePreview" style="display: none;" class="form-group text-center">
                                    <label>New Image Preview:</label>
                                    <div>
                                        <img id="preview" src="#" alt="Preview" class="img-circle elevation-2" style="width: 120px; height: 120px; object-fit: cover;">
                                    </div>
                                </div>

                                <!-- Name -->
                                <div class="form-group">
                                    <label for="name">Full Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" id="name"
                                        placeholder="Enter your full name" minlength="2" maxlength="255" required
                                        value="{{ old('name', $user->name) }}">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="form-group">
                                    <label for="email">Email Address <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" name="email" id="email"
                                        placeholder="Enter your email address" required
                                        value="{{ old('email', $user->email) }}">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Update Profile
                                    </button>
                                    <a href="{{ route('profile.show') }}" class="btn btn-secondary ml-2">
                                        <i class="fas fa-arrow-left"></i> Back to Profile
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Change Password -->
                <div class="col-md-6">
                    <div class="card card-outline card-warning" id="password-section">
                        <div class="card-header">
                            <h3 class="card-title">Change Password</h3>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('profile.update-password') }}" method="POST">
                                @csrf
                                @method('PUT')

                                <!-- Current Password -->
                                <div class="form-group">
                                    <label for="current_password">Current Password <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" name="current_password" id="current_password"
                                            placeholder="Enter your current password" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text" onclick="togglePassword('current_password')" style="cursor: pointer;">
                                                <i class="fas fa-eye" id="current_password_icon"></i>
                                            </span>
                                        </div>
                                    </div>
                                    @error('current_password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- New Password -->
                                <div class="form-group">
                                    <label for="password">New Password <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" name="password" id="password"
                                            placeholder="Enter new password" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text" onclick="togglePassword('password')" style="cursor: pointer;">
                                                <i class="fas fa-eye" id="password_icon"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <small class="text-muted">
                                        Password must be at least 8 characters long and contain uppercase, lowercase letters and numbers.
                                    </small>
                                    @error('password')
                                        <span class="text-danger d-block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Confirm Password -->
                                <div class="form-group">
                                    <label for="password_confirmation">Confirm New Password <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation"
                                            placeholder="Confirm new password" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text" onclick="togglePassword('password_confirmation')" style="cursor: pointer;">
                                                <i class="fas fa-eye" id="password_confirmation_icon"></i>
                                            </span>
                                        </div>
                                    </div>
                                    @error('password_confirmation')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-warning">
                                        <i class="fas fa-lock"></i> Update Password
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Security Tips -->
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <h3 class="card-title">Security Tips</h3>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled">
                                <li><i class="fas fa-check text-success mr-2"></i> Use a strong password with mixed case letters</li>
                                <li><i class="fas fa-check text-success mr-2"></i> Include numbers and special characters</li>
                                <li><i class="fas fa-check text-success mr-2"></i> Don't share your password with anyone</li>
                                <li><i class="fas fa-check text-success mr-2"></i> Change your password regularly</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('script')
<script>
    // Image preview functionality
    document.getElementById('profile_picture').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview').src = e.target.result;
                document.getElementById('imagePreview').style.display = 'block';
            }
            reader.readAsDataURL(file);
        } else {
            document.getElementById('imagePreview').style.display = 'none';
        }
    });

    // Password toggle functionality
    function togglePassword(fieldId) {
        const field = document.getElementById(fieldId);
        const icon = document.getElementById(fieldId + '_icon');

        if (field.type === 'password') {
            field.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            field.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
</script>
@endpush
