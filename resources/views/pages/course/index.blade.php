@extends('layout.app')
@section('title', 'Courses List')
@section('content')

    {{-- breadcrumb --}}
    <x-breadcrumb :items="[
        ['label' => 'Home', 'url' => route('dashboard')],
        ['label' => 'Courses', 'url' => route('courses.index')],
        // ['label' => 'Specific Product', 'url' => ''],
    ]" title="Courses" />

    <section class="content">
        <div class="container-fluid">

            {{-- Buttons Add right side --}}
            <div class="d-flex justify-content-between align-items-center my-2">
                <div class="btn-group" role="group">
                    <a href="{{ route('courses.index') }}" class="btn btn-outline-secondary {{ !request('status') ? 'active' : '' }}">
                        <i class="fas fa-list"></i> All Courses
                    </a>
                    <a href="{{ route('courses.index', ['status' => 'active']) }}" class="btn btn-outline-success {{ request('status') == 'active' ? 'active' : '' }}">
                        <i class="fas fa-check-circle"></i> Active
                    </a>
                    <a href="{{ route('courses.index', ['status' => 'inactive']) }}" class="btn btn-outline-warning {{ request('status') == 'inactive' ? 'active' : '' }}">
                        <i class="fas fa-pause-circle"></i> Inactive
                    </a>
                </div>
                <a href="{{ route('courses.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add Course
                </a>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <h3 class="card-title">Course List</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="courseTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Short Description</th>
                                        <th>Status</th>
                                        <th>Offer End Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($courses as $i=>$course)
                                        <tr>
                                            <td>{{ $i+1  }}</td>
                                            <td>{{ $course->title }}</td>
                                            <td>{{ \Illuminate\Support\Str::limit($course->short_desc, 60) }}</td>
                                            <td>
                                                @if($course->is_active)
                                                    <span class="badge badge-success px-3 py-2">
                                                        <i class="fas fa-check-circle mr-1"></i> Active
                                                    </span>
                                                @else
                                                    <span class="badge badge-secondary px-3 py-2">
                                                        <i class="fas fa-pause-circle mr-1"></i> Inactive
                                                    </span>
                                                @endif
                                            </td>
                                            <td>{{ $course->offer_end_at ? \Carbon\Carbon::parse($course->offer_end_at)->format('d M Y h:i A') : '-' }}</td>
                                            <td>
                                                {{-- Status Toggle Button --}}
                                                <form action="{{ route('courses.toggle-status', $course->id) }}" method="POST" style="display:inline-block;" class="mr-1">
                                                    @csrf
                                                    @method('PATCH')
                                                    @if($course->is_active)
                                                        <button type="submit" class="btn btn-sm btn-warning" onclick="return confirm('Are you sure you want to deactivate this course?')" title="Deactivate Course">
                                                            <i class="fas fa-pause"></i> Deactivate
                                                        </button>
                                                    @else
                                                        <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Are you sure you want to activate this course?')" title="Activate Course">
                                                            <i class="fas fa-play"></i> Activate
                                                        </button>
                                                    @endif
                                                </form>

                                                <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-sm btn-info mr-1"><i class="fas fa-edit"></i> Edit</a>
                                                <a href="{{ route('courses.show', $course->id) }}" class="btn btn-sm btn-primary mr-1"><i class="fas fa-eye"></i> View</a>
                                                <form action="{{ route('courses.destroy', $course->id) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i> Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">No courses found.</td>
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
            $('#courseTable').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
                "responsive": true,
                "buttons": ["csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#courseTable_wrapper .col-md-6:eq(0)');
        });
    </script>
@endpush
