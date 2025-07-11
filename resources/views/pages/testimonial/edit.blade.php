@extends('layout.app')
@section('title', 'Edit Testimonial')
@section('content')

    {{-- breadcrumb --}}
    <x-breadcrumb :items="[
        ['label' => 'Home', 'url' => route('dashboard')],
        ['label' => 'Testimonials', 'url' => route('testimonials.index')],
        ['label' => 'Edit Testimonial', 'url' => '#'],
    ]" title="Edit Testimonial" backUrl="{{ route('testimonials.index') }}" />

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
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">Edit Testimonial</h3>
                </div>

                <div class="card-body">
                    <form action="{{ route('testimonials.update', $testimonial->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="client_name">Client Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="client_name" id="client_name"
                                        placeholder="Enter Client Name" minlength="2" maxlength="100" required
                                        value="{{ old('client_name', $testimonial->client_name) }}">
                                    @error('client_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="client_position">Client Position</label>
                                    <input type="text" class="form-control" name="client_position" id="client_position"
                                        placeholder="Enter Client Position" maxlength="100"
                                        value="{{ old('client_position', $testimonial->client_position) }}">
                                    @error('client_position')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="client_company">Client Company</label>
                                    <input type="text" class="form-control" name="client_company" id="client_company"
                                        placeholder="Enter Client Company" maxlength="100"
                                        value="{{ old('client_company', $testimonial->client_company) }}">
                                    @error('client_company')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="rating">Rating <span class="text-danger">*</span></label>
                                    <select class="form-control" name="rating" id="rating" required>
                                        <option value="">Select Rating</option>
                                        <option value="5" {{ old('rating', $testimonial->rating) == '5' ? 'selected' : '' }}>5 Stars (Excellent)</option>
                                        <option value="4" {{ old('rating', $testimonial->rating) == '4' ? 'selected' : '' }}>4 Stars (Good)</option>
                                        <option value="3" {{ old('rating', $testimonial->rating) == '3' ? 'selected' : '' }}>3 Stars (Average)</option>
                                        <option value="2" {{ old('rating', $testimonial->rating) == '2' ? 'selected' : '' }}>2 Stars (Poor)</option>
                                        <option value="1" {{ old('rating', $testimonial->rating) == '1' ? 'selected' : '' }}>1 Star (Very Poor)</option>
                                    </select>
                                    @error('rating')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="message">Testimonial Message <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="message" id="message" rows="5"
                                        placeholder="Enter testimonial message" minlength="10" maxlength="1000" required>{{ old('message', $testimonial->message) }}</textarea>
                                    @error('message')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="client_image">Client Image (Optional)</label>
                                    <input type="file" class="form-control-file" name="client_image" id="client_image"
                                        accept="image/*">
                                    <small class="text-muted">Accepted formats: JPEG, PNG, JPG, GIF. Max size: 2MB</small>
                                    @error('client_image')
                                        <span class="text-danger d-block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Current Image -->
                                @if($testimonial->client_image)
                                    <div class="current-image mb-3">
                                        <label>Current Image:</label>
                                        <div>
                                            <img src="{{ asset('storage/' . $testimonial->client_image) }}"
                                                 alt="{{ $testimonial->client_name }}"
                                                 class="img-thumbnail"
                                                 style="max-width: 150px; max-height: 150px; object-fit: cover;">
                                        </div>
                                    </div>
                                @endif

                                <!-- Image Preview -->
                                <div id="imagePreview" style="display: none;">
                                    <label>New Image Preview:</label>
                                    <div>
                                        <img id="preview" src="#" alt="Preview" class="img-thumbnail" style="max-width: 150px; max-height: 150px;">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status Options</label>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="is_active" id="is_active" value="1" {{ old('is_active', $testimonial->is_active) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">
                                            Active (Visible on website)
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="is_featured" id="is_featured" value="1" {{ old('is_featured', $testimonial->is_featured) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_featured">
                                            Featured (Highlight this testimonial)
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update Testimonial
                            </button>
                            <a href="{{ route('testimonials.index') }}" class="btn btn-secondary ml-2">
                                <i class="fas fa-arrow-left"></i> Back to List
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('script')
<script>
    // Image preview functionality
    document.getElementById('client_image').addEventListener('change', function(e) {
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
</script>
@endpush
