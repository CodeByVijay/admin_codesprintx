@extends('layout.app')
@section('title', 'View Testimonial')
@section('content')

    {{-- breadcrumb --}}
    <x-breadcrumb :items="[
        ['label' => 'Home', 'url' => route('dashboard')],
        ['label' => 'Testimonials', 'url' => route('testimonials.index')],
        ['label' => 'View Testimonial', 'url' => '#'],
    ]" title="View Testimonial" backUrl="{{ route('testimonials.index') }}" />

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <h3 class="card-title">Testimonial Details</h3>
                            <div class="card-tools">
                                <a href="{{ route('testimonials.edit', $testimonial->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- Client Info Section -->
                                    <div class="testimonial-card bg-light p-4 rounded mb-4">
                                        <div class="d-flex align-items-start">
                                            @if($testimonial->client_image)
                                                <div class="client-image mr-3">
                                                    <img src="{{ asset('storage/' . $testimonial->client_image) }}"
                                                         alt="{{ $testimonial->client_name }}"
                                                         class="img-circle elevation-2"
                                                         style="width: 80px; height: 80px; object-fit: cover;">
                                                </div>
                                            @else
                                                <div class="client-image mr-3">
                                                    <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center"
                                                         style="width: 80px; height: 80px;">
                                                        <i class="fas fa-user fa-2x text-white"></i>
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="client-info flex-grow-1">
                                                <h4 class="mb-1">{{ $testimonial->client_name }}</h4>
                                                @if($testimonial->client_position || $testimonial->client_company)
                                                    <p class="text-muted mb-2">
                                                        @if($testimonial->client_position)
                                                            {{ $testimonial->client_position }}
                                                        @endif
                                                        @if($testimonial->client_position && $testimonial->client_company)
                                                            at
                                                        @endif
                                                        @if($testimonial->client_company)
                                                            <strong>{{ $testimonial->client_company }}</strong>
                                                        @endif
                                                    </p>
                                                @endif

                                                <!-- Rating -->
                                                <div class="rating mb-3">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        @if($i <= $testimonial->rating)
                                                            <i class="fas fa-star text-warning"></i>
                                                        @else
                                                            <i class="far fa-star text-muted"></i>
                                                        @endif
                                                    @endfor
                                                    <span class="ml-2 text-muted">({{ $testimonial->rating }}/5)</span>
                                                </div>

                                                <!-- Status Badges -->
                                                <div class="status-badges">
                                                    @if($testimonial->is_active)
                                                        <span class="badge badge-success">Active</span>
                                                    @else
                                                        <span class="badge badge-danger">Inactive</span>
                                                    @endif
                                                    @if($testimonial->is_featured)
                                                        <span class="badge badge-info ml-1">Featured</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Testimonial Message -->
                                        <div class="testimonial-message mt-4">
                                            <h5>Testimonial Message:</h5>
                                            <blockquote class="blockquote">
                                                <p class="mb-0">"{{ $testimonial->message }}"</p>
                                            </blockquote>
                                        </div>
                                    </div>

                                    <!-- Meta Information -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="info-box">
                                                <span class="info-box-icon bg-info"><i class="fas fa-calendar"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">Created On</span>
                                                    <span class="info-box-number">{{ $testimonial->created_at->format('d M Y, h:i A') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="info-box">
                                                <span class="info-box-icon bg-success"><i class="fas fa-edit"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">Last Updated</span>
                                                    <span class="info-box-number">{{ $testimonial->updated_at->format('d M Y, h:i A') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <a href="{{ route('testimonials.edit', $testimonial->id) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Edit Testimonial
                            </a>
                            <a href="{{ route('testimonials.index') }}" class="btn btn-secondary ml-2">
                                <i class="fas fa-arrow-left"></i> Back to List
                            </a>
                            <form action="{{ route('testimonials.destroy', $testimonial->id) }}" method="POST" style="display:inline-block;" class="ml-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this testimonial?')">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <!-- Quick Actions -->
                    <div class="card card-outline card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Quick Actions</h3>
                        </div>
                        <div class="card-body">
                            <div class="d-grid gap-2">
                                <a href="{{ route('testimonials.create') }}" class="btn btn-primary btn-block">
                                    <i class="fas fa-plus"></i> Add New Testimonial
                                </a>
                                <a href="{{ route('testimonials.edit', $testimonial->id) }}" class="btn btn-warning btn-block">
                                    <i class="fas fa-edit"></i> Edit This Testimonial
                                </a>
                                <a href="{{ route('testimonials.index') }}" class="btn btn-secondary btn-block">
                                    <i class="fas fa-list"></i> All Testimonials
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Statistics -->
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <h3 class="card-title">Testimonial Stats</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="description-block border-right">
                                        <span class="description-percentage text-success">
                                            <i class="fas fa-star"></i>
                                        </span>
                                        <h5 class="description-header">{{ $testimonial->rating }}/5</h5>
                                        <span class="description-text">RATING</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="description-block">
                                        <span class="description-percentage text-info">
                                            <i class="fas fa-{{ $testimonial->is_active ? 'check' : 'times' }}"></i>
                                        </span>
                                        <h5 class="description-header">{{ $testimonial->is_active ? 'Active' : 'Inactive' }}</h5>
                                        <span class="description-text">STATUS</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
