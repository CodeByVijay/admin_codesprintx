@extends('layout.app')
@section('title', 'View Course')
@section('content')
    <x-breadcrumb :items="[
        ['label' => 'Home', 'url' => route('dashboard')],
        ['label' => 'Courses', 'url' => route('courses.index')],
        ['label' => 'View Course', 'url' => '#'],
    ]" title="View Course" backUrl="{{ route('courses.index') }}" />

    <section class="content">
        <div class="container-fluid">

            <!-- Course Hero Card -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card border-0 shadow-lg">
                        <div class="card-body p-0">
                            <div class="row no-gutters">
                                <!-- Course Icon Section -->
                                <div class="col-md-3 d-flex align-items-center justify-content-center p-5" style="background: linear-gradient(135deg, {{ $course->bg_color }}, {{ $course->bg_color }}dd);">
                                    <div class="text-center text-white">
                                        <div class="bg-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 100px; height: 100px;">
                                            <i class="{{ $course->icon }} fa-3x" style="color: {{ $course->bg_color }};"></i>
                                        </div>
                                        <h4 class="text-white font-weight-bold">{{ $course->title }}</h4>
                                    </div>
                                </div>

                                <!-- Course Info Section -->
                                <div class="col-md-9 p-4">
                                    <div class="row h-100">
                                        <div class="col-md-8">
                                            <div class="d-flex justify-content-between align-items-start mb-3">
                                                <h2 class="h3 font-weight-bold text-dark mb-0">Course Overview</h2>
                                                @if($course->is_active)
                                                    <span class="badge badge-success px-3 py-2">
                                                        <i class="fas fa-check-circle mr-1"></i> Active
                                                    </span>
                                                @else
                                                    <span class="badge badge-secondary px-3 py-2">
                                                        <i class="fas fa-pause-circle mr-1"></i> Inactive
                                                    </span>
                                                @endif
                                            </div>
                                            <p class="lead text-muted mb-4">{{ $course->short_desc }}</p>

                                            <!-- Skills Tags -->
                                            <div class="mb-4">
                                                <h6 class="font-weight-bold text-uppercase text-muted mb-2">
                                                    <i class="fas fa-tools mr-1"></i> Skills Covered
                                                </h6>
                                                @php
                                                    $skills = is_array($course->skills) ? $course->skills : (is_string($course->skills) && str_starts_with($course->skills, '[') ? json_decode($course->skills, true) : (is_string($course->skills) ? explode(',', $course->skills) : []));
                                                @endphp
                                                <div class="d-flex flex-wrap">
                                                    @foreach($skills as $skill)
                                                        <span class="badge badge-light border mr-2 mb-2 px-3 py-2">
                                                            <i class="fas fa-code mr-1" style="color: {{ $course->bg_color }};"></i>
                                                            {{ trim($skill) }}
                                                        </span>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Pricing Section -->
                                        <div class="col-md-4">
                                            <div class="card border-0 bg-light h-100">
                                                <div class="card-header bg-transparent border-0 pb-0">
                                                    <h6 class="font-weight-bold text-uppercase text-muted mb-0">
                                                        <i class="fas fa-tag mr-1"></i> Pricing Plans
                                                    </h6>
                                                </div>
                                                <div class="card-body pt-2">
                                                    <!-- 3 Month Pricing -->
                                                    <div class="mb-3 p-3 bg-white rounded border-left" style="border-left-color: {{ $course->bg_color }} !important; border-left-width: 4px !important;">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div>
                                                                <h6 class="mb-1 font-weight-bold">3 Months</h6>
                                                                @if($course->original_price_3_month && $course->original_price_3_month > $course->price_3_month)
                                                                    <small class="text-muted text-decoration-line-through">${{ $course->original_price_3_month }}</small>
                                                                @endif
                                                            </div>
                                                            <h5 class="mb-0 font-weight-bold" style="color: {{ $course->bg_color }};">${{ $course->price_3_month }}</h5>
                                                        </div>
                                                    </div>

                                                    <!-- 6 Month Pricing -->
                                                    <div class="mb-3 p-3 bg-white rounded border-left" style="border-left-color: {{ $course->bg_color }} !important; border-left-width: 4px !important;">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div>
                                                                <h6 class="mb-1 font-weight-bold">6 Months</h6>
                                                                @if($course->original_price_6_month && $course->original_price_6_month > $course->price_6_month)
                                                                    <small class="text-muted text-decoration-line-through">${{ $course->original_price_6_month }}</small>
                                                                @endif
                                                            </div>
                                                            <h5 class="mb-0 font-weight-bold" style="color: {{ $course->bg_color }};">${{ $course->price_6_month }}</h5>
                                                        </div>
                                                    </div>

                                                    @if($course->offer_end_at)
                                                        <div class="alert alert-warning mb-0 py-2">
                                                            <small class="mb-0">
                                                                <i class="fas fa-clock mr-1"></i>
                                                                Offer expires: {{ \Carbon\Carbon::parse($course->offer_end_at)->format('M d, Y') }}
                                                            </small>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Sections -->
            <div class="row">
                <!-- Main Content -->
                <div class="col-lg-8">

                    <!-- Course Description -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white border-0 pb-0">
                            <h5 class="font-weight-bold mb-0">
                                <i class="fas fa-info-circle mr-2" style="color: {{ $course->bg_color }};"></i>
                                Course Description
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="text-muted">{!! nl2br(e($course->long_desc)) !!}</div>
                        </div>
                    </div>

                    <!-- What You Will Learn -->
                    @php
                        $whatYouLearn = is_array($course->what_you_learn) ? $course->what_you_learn : (is_string($course->what_you_learn) && str_starts_with($course->what_you_learn, '[') ? json_decode($course->what_you_learn, true) : []);
                    @endphp
                    @if(!empty($whatYouLearn))
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white border-0 pb-0">
                            <h5 class="font-weight-bold mb-0">
                                <i class="fas fa-graduation-cap mr-2" style="color: {{ $course->bg_color }};"></i>
                                What You Will Learn
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach($whatYouLearn as $index => $item)
                                    <div class="col-md-6 mb-3">
                                        <div class="d-flex align-items-start">
                                            <div class="rounded-circle d-flex align-items-center justify-content-center mr-3 flex-shrink-0" style="width: 30px; height: 30px; background: {{ $course->bg_color }}20;">
                                                <i class="fas fa-check" style="color: {{ $course->bg_color }}; font-size: 0.8rem;"></i>
                                            </div>
                                            <span class="text-dark">{{ $item }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Live Projects -->
                    @php
                        $projects = is_array($course->projects) ? $course->projects : (is_string($course->projects) && str_starts_with($course->projects, '[') ? json_decode($course->projects, true) : []);
                    @endphp
                    @if(!empty($projects))
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white border-0 pb-0">
                            <h5 class="font-weight-bold mb-0">
                                <i class="fas fa-project-diagram mr-2" style="color: {{ $course->bg_color }};"></i>
                                Live Projects
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach($projects as $project)
                                    <div class="col-md-6 mb-3">
                                        <div class="card border-0 h-100" style="background: {{ $course->bg_color }}10;">
                                            <div class="card-body p-3">
                                                <h6 class="font-weight-bold mb-2" style="color: {{ $course->bg_color }};">
                                                    <i class="fas fa-folder-open mr-1"></i>
                                                    {{ $project['name'] ?? 'Untitled Project' }}
                                                </h6>
                                                <p class="text-muted small mb-0">{{ $project['description'] ?? 'No description available' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif

                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">

                    <!-- Course Meta Information -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white border-0 pb-0">
                            <h6 class="font-weight-bold text-uppercase text-muted mb-0">
                                <i class="fas fa-info mr-1"></i> Course Information
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="list-group list-group-flush">
                                <div class="list-group-item px-0 py-2 border-0">
                                    <small class="text-muted d-block">Course ID</small>
                                    <span class="font-weight-bold">#{{ $course->id }}</span>
                                </div>
                                <div class="list-group-item px-0 py-2 border-0">
                                    <small class="text-muted d-block">Created Date</small>
                                    <span class="font-weight-bold">{{ $course->created_at->format('M d, Y') }}</span>
                                </div>
                                <div class="list-group-item px-0 py-2 border-0">
                                    <small class="text-muted d-block">Last Updated</small>
                                    <span class="font-weight-bold">{{ $course->updated_at->format('M d, Y') }}</span>
                                </div>
                                @if($course->offer_end_at)
                                <div class="list-group-item px-0 py-2 border-0">
                                    <small class="text-muted d-block">Offer Expires</small>
                                    <span class="font-weight-bold text-warning">{{ \Carbon\Carbon::parse($course->offer_end_at)->format('M d, Y h:i A') }}</span>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- SEO Information -->
                    @if($course->meta_description || $course->meta_keywords)
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white border-0 pb-0">
                            <h6 class="font-weight-bold text-uppercase text-muted mb-0">
                                <i class="fas fa-search mr-1"></i> SEO Information
                            </h6>
                        </div>
                        <div class="card-body">
                            @if($course->meta_description)
                            <div class="mb-3">
                                <small class="text-muted d-block mb-1">Meta Description</small>
                                <p class="small text-dark mb-0">{{ $course->meta_description }}</p>
                            </div>
                            @endif
                            @if($course->meta_keywords)
                            <div>
                                <small class="text-muted d-block mb-1">Keywords</small>
                                <p class="small text-dark mb-0">{{ $course->meta_keywords }}</p>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif

                    <!-- Action Buttons -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-body text-center">
                            <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-primary btn-block mb-2">
                                <i class="fas fa-edit mr-1"></i> Edit Course
                            </a>

                            {{-- Status Toggle Button --}}
                            <form action="{{ route('courses.toggle-status', $course->id) }}" method="POST" class="mb-2">
                                @csrf
                                @method('PATCH')
                                @if($course->is_active)
                                    <button type="submit" class="btn btn-warning btn-block" onclick="return confirm('Are you sure you want to deactivate this course?')">
                                        <i class="fas fa-pause mr-1"></i> Deactivate Course
                                    </button>
                                @else
                                    <button type="submit" class="btn btn-success btn-block" onclick="return confirm('Are you sure you want to activate this course?')">
                                        <i class="fas fa-play mr-1"></i> Activate Course
                                    </button>
                                @endif
                            </form>

                            <a href="{{ route('courses.index') }}" class="btn btn-outline-secondary btn-block">
                                <i class="fas fa-arrow-left mr-1"></i> Back to Courses
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
