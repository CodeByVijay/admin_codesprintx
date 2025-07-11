@extends('layout.app')
@section('title', 'Testimonials List')
@section('content')

    {{-- breadcrumb --}}
    <x-breadcrumb :items="[
        ['label' => 'Home', 'url' => route('dashboard')],
        ['label' => 'Testimonials', 'url' => route('testimonials.index')],
    ]" title="Testimonials" />

    <section class="content">
        <div class="container-fluid">

            {{-- Buttons Add  right side --}}
            <div class="d-flex justify-content-end my-2">
                <a href="{{ route('testimonials.create') }}" class="btn btn-primary mx-2">
                    <i class="fas fa-plus"></i> Add New Testimonial
                </a>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <h3 class="card-title">Testimonials List</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="testimonialTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Client Image</th>
                                        <th>Client Name</th>
                                        <th>Position/Company</th>
                                        <th>Message</th>
                                        <th>Rating</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($testimonials as $i=>$testimonial)
                                        <tr>
                                            <td>{{ $i+1  }}</td>
                                            <td>
                                                @if($testimonial->client_image)
                                                    <img src="{{ asset('storage/' . $testimonial->client_image) }}"
                                                         alt="{{ $testimonial->client_name }}"
                                                         class="img-circle elevation-2"
                                                         style="width: 40px; height: 40px; object-fit: cover;">
                                                @else
                                                    <span class="badge badge-secondary">No Image</span>
                                                @endif
                                            </td>
                                            <td>{{ $testimonial->client_name }}</td>
                                            <td>
                                                @if($testimonial->client_position || $testimonial->client_company)
                                                    {{ $testimonial->client_position }}
                                                    @if($testimonial->client_position && $testimonial->client_company) at @endif
                                                    {{ $testimonial->client_company }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>{{ \Illuminate\Support\Str::limit($testimonial->message, 80) }}</td>
                                            <td>
                                                @for($i = 1; $i <= 5; $i++)
                                                    @if($i <= $testimonial->rating)
                                                        <i class="fas fa-star text-warning"></i>
                                                    @else
                                                        <i class="far fa-star text-muted"></i>
                                                    @endif
                                                @endfor
                                                ({{ $testimonial->rating }}/5)
                                            </td>
                                            <td>
                                                @if($testimonial->is_active)
                                                    <span class="badge badge-success">Active</span>
                                                @else
                                                    <span class="badge badge-danger">Inactive</span>
                                                @endif
                                                @if($testimonial->is_featured)
                                                    <span class="badge badge-info ml-1">Featured</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('testimonials.edit', $testimonial->id) }}" class="btn btn-sm btn-info"><i class="fas fa-edit"></i> Edit</a>
                                                <a href="{{ route('testimonials.show', $testimonial->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i> View</a>
                                                <form action="{{ route('testimonials.destroy', $testimonial->id) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i> Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">No testimonials found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            <ul class="pagination pagination-sm m-0 float-right">

                            </ul>
                        </div>
                    </div>

                </div>

            </div>
    </section>

@endsection
@push('script')
    <script>
        $(function() {
            $('#testimonialTable').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
                "responsive": true,
                "buttons": ["csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#testimonialTable_wrapper .col-md-6:eq(0)');
        });
    </script>
@endpush
