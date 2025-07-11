@extends('layout.app')
@section('title', 'Dashboard')

@section('content')

    {{-- breadcrumb --}}
    <x-breadcrumb :items="[
        ['label' => 'Home', 'url' => route('dashboard')],
        ['label' => 'Dashboard', 'url' => route('dashboard')],
    ]" title="Dashboard" />

    <!-- Main content -->
    <section class="content">
        @include('layout.flash-message')

        <div class="container-fluid">

            <!-- Welcome Section -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body bg-gradient-primary text-white rounded">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <h2 class="h3 mb-2 font-weight-bold">Welcome back, {{ Auth::user()->name }}!</h2>
                                    <p class="mb-0 opacity-75">Here's what's happening with your courses and testimonials today.</p>
                                </div>
                                <div class="col-md-4 text-center">
                                    <i class="fas fa-chart-line fa-3x opacity-50"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="row mb-4">
                <!-- Total Courses -->
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="h2 font-weight-bold text-primary mb-1">{{ $totalCourses }}</h3>
                                    <p class="text-muted mb-0 font-weight-medium">Total Courses</p>
                                </div>
                                <div class="col-4 text-right">
                                    <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                        <i class="fas fa-graduation-cap fa-lg text-white"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <a href="{{ route('courses.index') }}" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-eye mr-1"></i> View All
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Testimonials -->
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="h2 font-weight-bold text-success mb-1">{{ $totalTestimonials }}</h3>
                                    <p class="text-muted mb-0 font-weight-medium">Total Testimonials</p>
                                </div>
                                <div class="col-4 text-right">
                                    <div class="bg-success rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                        <i class="fas fa-comments fa-lg text-white"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <a href="{{ route('testimonials.index') }}" class="btn btn-outline-success btn-sm">
                                    <i class="fas fa-eye mr-1"></i> View All
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Active Courses -->
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="h2 font-weight-bold text-info mb-1">{{ $activeCourses }}</h3>
                                    <p class="text-muted mb-0 font-weight-medium">Active Courses</p>
                                </div>
                                <div class="col-4 text-right">
                                    <div class="bg-info rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                        <i class="fas fa-play-circle fa-lg text-white"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <a href="{{ route('courses.index', ['status' => 'active']) }}" class="btn btn-outline-info btn-sm">
                                    <i class="fas fa-eye mr-1"></i> View Active
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Inactive Courses -->
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="h2 font-weight-bold text-secondary mb-1">{{ $inactiveCourses }}</h3>
                                    <p class="text-muted mb-0 font-weight-medium">Inactive Courses</p>
                                </div>
                                <div class="col-4 text-right">
                                    <div class="bg-secondary rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                        <i class="fas fa-pause-circle fa-lg text-white"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <a href="{{ route('courses.index', ['status' => 'inactive']) }}" class="btn btn-outline-secondary btn-sm">
                                    <i class="fas fa-eye mr-1"></i> View Inactive
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Stats Overview -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-gradient-light border-0">
                            <h5 class="font-weight-bold mb-0 text-dark">
                                <i class="fas fa-chart-pie mr-2 text-primary"></i>
                                Course Status Overview
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="row text-center">
                                <div class="col-md-4 mb-3">
                                    <div class="border-right">
                                        <div class="d-flex align-items-center justify-content-center mb-2">
                                            <div class="bg-primary rounded-circle mr-2" style="width: 12px; height: 12px;"></div>
                                            <h6 class="mb-0 font-weight-bold text-dark">Total Courses</h6>
                                        </div>
                                        <h3 class="text-primary font-weight-bold">{{ $totalCourses }}</h3>
                                        <small class="text-muted">All courses in system</small>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="border-right">
                                        <div class="d-flex align-items-center justify-content-center mb-2">
                                            <div class="bg-success rounded-circle mr-2" style="width: 12px; height: 12px;"></div>
                                            <h6 class="mb-0 font-weight-bold text-dark">Active Courses</h6>
                                        </div>
                                        <h3 class="text-success font-weight-bold">{{ $activeCourses }}</h3>
                                        <small class="text-muted">{{ $totalCourses > 0 ? round(($activeCourses / $totalCourses) * 100, 1) : 0 }}% of total</small>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="d-flex align-items-center justify-content-center mb-2">
                                        <div class="bg-warning rounded-circle mr-2" style="width: 12px; height: 12px;"></div>
                                        <h6 class="mb-0 font-weight-bold text-dark">Inactive Courses</h6>
                                    </div>
                                    <h3 class="text-warning font-weight-bold">{{ $inactiveCourses }}</h3>
                                    <small class="text-muted">{{ $totalCourses > 0 ? round(($inactiveCourses / $totalCourses) * 100, 1) : 0 }}% of total</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Area -->
            <div class="row">
                <!-- Recent Courses -->
                <div class="col-lg-8 mb-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-gradient-light border-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="font-weight-bold mb-0 text-dark">
                                    <i class="fas fa-graduation-cap mr-2 text-primary"></i>
                                    Recent Courses
                                </h5>
                                <a href="{{ route('courses.index') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-list mr-1"></i> View All Courses
                                </a>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            @if($recentCourses->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead class="bg-light">
                                            <tr>
                                                <th class="border-0 px-4 py-3">Course</th>
                                                <th class="border-0 px-4 py-3">Status</th>
                                                <th class="border-0 px-4 py-3">Created</th>
                                                <th class="border-0 px-4 py-3 text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($recentCourses as $course)
                                                <tr>
                                                    <td class="px-4 py-3">
                                                        <div class="d-flex align-items-center">
                                                            <div class="rounded-circle d-flex align-items-center justify-content-center mr-3"
                                                                 style="width: 45px; height: 45px; background: {{ $course->bg_color }}15; border: 2px solid {{ $course->bg_color }}30;">
                                                                <i class="{{ $course->icon }} text-primary"></i>
                                                            </div>
                                                            <div>
                                                                <h6 class="mb-1 font-weight-bold">{{ $course->title }}</h6>
                                                                <p class="text-muted small mb-0">{{ Str::limit($course->short_desc, 50) }}</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-4 py-3">
                                                        @if($course->is_active)
                                                            <span class="badge badge-success px-3 py-2">
                                                                <i class="fas fa-check-circle mr-1"></i> Active
                                                            </span>
                                                        @else
                                                            <span class="badge badge-warning px-3 py-2">
                                                                <i class="fas fa-pause-circle mr-1"></i> Inactive
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td class="px-4 py-3">
                                                        <small class="text-muted">
                                                            <i class="fas fa-clock mr-1"></i>
                                                            {{ $course->created_at->diffForHumans() }}
                                                        </small>
                                                    </td>
                                                    <td class="px-4 py-3 text-center">
                                                        <div class="btn-group" role="group">
                                                            <a href="{{ route('courses.show', $course->id) }}" class="btn btn-outline-primary btn-sm" title="View Course">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                            <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-outline-info btn-sm" title="Edit Course">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <form action="{{ route('courses.toggle-status', $course->id) }}" method="POST" class="d-inline">
                                                                @csrf
                                                                @method('PATCH')
                                                                @if($course->is_active)
                                                                    <button type="submit" class="btn btn-outline-warning btn-sm" onclick="return confirm('Deactivate this course?')" title="Deactivate Course">
                                                                        <i class="fas fa-pause"></i>
                                                                    </button>
                                                                @else
                                                                    <button type="submit" class="btn btn-outline-success btn-sm" onclick="return confirm('Activate this course?')" title="Activate Course">
                                                                        <i class="fas fa-play"></i>
                                                                    </button>
                                                                @endif
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="text-center py-5">
                                    <div class="mb-3">
                                        <i class="fas fa-graduation-cap fa-4x text-muted"></i>
                                    </div>
                                    <h5 class="text-muted mb-2">No courses created yet</h5>
                                    <p class="text-muted mb-3">Start building your course catalog to see them here</p>
                                    <a href="{{ route('courses.create') }}" class="btn btn-primary">
                                        <i class="fas fa-plus mr-2"></i> Create Your First Course
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Sidebar: Quick Actions & Featured Testimonials -->
                <div class="col-lg-4 mb-4">
                    <!-- Quick Actions -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-gradient-light border-0">
                            <h5 class="font-weight-bold mb-0 text-dark">
                                <i class="fas fa-bolt mr-2 text-warning"></i>
                                Quick Actions
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <a href="{{ route('courses.create') }}" class="btn btn-primary btn-block btn-lg">
                                        <i class="fas fa-plus mr-2"></i> Create New Course
                                    </a>
                                </div>
                                <div class="col-12 mb-3">
                                    <a href="{{ route('testimonials.create') }}" class="btn btn-success btn-block">
                                        <i class="fas fa-comment mr-2"></i> Add Testimonial
                                    </a>
                                </div>
                                <div class="col-6 mb-2">
                                    <a href="{{ route('courses.index', ['status' => 'active']) }}" class="btn btn-outline-info btn-block btn-sm">
                                        <i class="fas fa-check-circle mr-1"></i> Active
                                    </a>
                                </div>
                                <div class="col-6 mb-2">
                                    <a href="{{ route('courses.index', ['status' => 'inactive']) }}" class="btn btn-outline-warning btn-block btn-sm">
                                        <i class="fas fa-pause-circle mr-1"></i> Inactive
                                    </a>
                                </div>
                                <div class="col-12">
                                    <a href="{{ route('courses.index') }}" class="btn btn-outline-dark btn-block">
                                        <i class="fas fa-list mr-2"></i> All Courses
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Featured Testimonials -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-gradient-light border-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="font-weight-bold mb-0 text-dark">
                                    <i class="fas fa-star mr-2 text-warning"></i>
                                    Featured Reviews
                                </h6>
                                <span class="badge badge-warning">{{ $featuredTestimonials->count() }}</span>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            @if($featuredTestimonials->count() > 0)
                                @foreach($featuredTestimonials as $testimonial)
                                    <div class="d-flex align-items-start mb-3 pb-3 @if(!$loop->last) border-bottom @endif">
                                        <div class="bg-gradient-warning rounded-circle d-flex align-items-center justify-content-center mr-3 flex-shrink-0"
                                             style="width: 40px; height: 40px;">
                                            <i class="fas fa-user text-white"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="font-weight-bold mb-1">{{ $testimonial->client_name ?? 'Anonymous Client' }}</h6>
                                            <p class="small text-muted mb-2">{{ Str::limit($testimonial->message ?? 'No review message available', 70) }}</p>
                                            <div class="text-warning small">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fas fa-star"></i>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="text-center mt-3">
                                    <a href="{{ route('testimonials.index') }}" class="btn btn-outline-warning btn-sm">
                                        <i class="fas fa-eye mr-1"></i> View All Reviews
                                    </a>
                                </div>
                            @else
                                <div class="text-center py-4">
                                    <div class="mb-3">
                                        <i class="fas fa-comments fa-3x text-muted"></i>
                                    </div>
                                    <h6 class="text-muted mb-2">No featured testimonials</h6>
                                    <p class="text-muted small mb-3">Add testimonials to showcase client feedback</p>
                                    <a href="{{ route('testimonials.create') }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-plus mr-1"></i> Add First Review
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
