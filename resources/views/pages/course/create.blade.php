@extends('layout.app')
@section('title', 'Add New Program')
@section('content')

    {{-- breadcrumb --}}
    <x-breadcrumb :items="[
        ['label' => 'Home', 'url' => route('dashboard')],
        ['label' => 'New Program', 'url' => '#'],
        // ['label' => 'Specific Product', 'url' => ''],
    ]" title="Add New Program" backUrl="{{ route('courses.index') }}" />

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
            {{-- <div class="row">
                <div class="col-md-12"> --}}

            {{-- <div class="card card-primary"> --}}
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">Add New Program</h3>
                </div>

                <div class="card-body">
                    <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="programName">Program Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="title" id="programName"
                                        placeholder="Enter Program Name" minlength="5" maxlength="100" required
                                        value="{{ old('title') }}">
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="programDescription">Program Description(Short)
                                        <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="short_desc" id="programDescription"
                                        placeholder="Enter Program Short Description" minlength="20" maxlength="300"
                                        required value="{{ old('short_desc') }}">
                                    @error('short_desc')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="programSkills">Program Skills (comma separated)
                                        <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="skills" id="programSkills"
                                        placeholder="Enter Program Skills comma separated e.g. HTML,CSS,JS,PHP" required
                                        value="{{ old('skills') }}">
                                    @error('skills')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="colorPicker">Color <span class="text-danger">*</span></label>
                                    <div class="input-group my-colorpicker2">
                                        <input type="text" name="bg_color" class="form-control"
                                            placeholder="Card Background Color" required value="{{ old('bg_color') }}">
                                        @error('bg_color')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fas fa-square"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group" style="position: relative;">
                                    <label for="chooseIcon">Font Awesome Icon <span class="text-danger">*</span> </label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="icon" id="chooseIcon"
                                            placeholder="Search Card icon, eg: fa-user" autocomplete="off"
                                            style="border-top-right-radius: 0; border-bottom-right-radius: 0;" required
                                            value="{{ old('icon') }}">
                                        @error('icon')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="iconInputPreview"
                                                style="background: #fff; border-left: 0; border-top-left-radius: 0; border-bottom-left-radius: 0;"
                                                title="Preview"></span>
                                        </div>
                                    </div>
                                    <div id="iconSuggestions" class="list-group mt-1"
                                        style="position: absolute; left: 0; right: 0; top: 100%; z-index: 1000; width: 100%; display: none; max-height: 220px; overflow-y: auto;">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="programDescription">Program Description(Long)
                                        <span class="text-danger">*</span></label>
                                    <textarea id="summernote" name="long_desc" placeholder="Write Long Description">{{ old('long_desc') }}</textarea>
                                    @error('long_desc')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12 card">
                                <div class="card-header">
                                    <h3 class="card-title">Pricing Section</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="original_price_3_month">3 Month
                                                    Normal Price <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="original_price_3_month"
                                                    id="original_price_3_month" placeholder="Enter 3 Month Normal Price"
                                                    required value="{{ old('original_price_3_month') }}">
                                                @error('original_price_3_month')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="price_3_month">3 Month Discounted
                                                    Price <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="price_3_month"
                                                    id="price_3_month" placeholder="Enter 3 Month Discounted Price"
                                                    required value="{{ old('price_3_month') }}">
                                                @error('price_3_month')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="original_price_6_month">6 Month
                                                    Normal Price <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="original_price_6_month"
                                                    id="original_price_6_month" placeholder="Enter 6 Month Normal Price"
                                                    required value="{{ old('original_price_6_month') }}">
                                                @error('original_price_6_month')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="price_6_month">6 Month Discounted
                                                    Price <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="price_6_month"
                                                    id="price_6_month" placeholder="Enter 6 Month Discounted Price"
                                                    required value="{{ old('price_6_month') }}">
                                                @error('price_6_month')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <label for="offer_end_at">Offer End Date
                                                </label>
                                                <div class="input-group date" id="reservationdatetime"
                                                    data-target-input="nearest">
                                                    <input type="text" name="offer_end_at" id="offer_end_at"
                                                        class="form-control datetimepicker-input"
                                                        data-target="#reservationdatetime"
                                                        placeholder="Enter Offer End Date"
                                                        value="{{ old('offer_end_at') }}" />
                                                    @error('offer_end_at')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <div class="input-group-append" data-target="#reservationdatetime"
                                                        data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>


                            <div class="col-md-12 card">
                                <div class="card-header">
                                    <h3 class="card-title">SEO Section</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="meta_description">Meta Description
                                                    <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="meta_description"
                                                    id="meta_description" placeholder="Enter Meta Description" required
                                                    value="{{ old('meta_description') }}">
                                                @error('meta_description')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="meta_keywords">Meta Keywords(comma
                                                    separated) <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="meta_keywords"
                                                    id="meta_keywords"
                                                    placeholder="Enter Meta Keywords comma separated e.g. HTML,CSS,JS"
                                                    required value="{{ old('meta_keywords') }}">
                                                @error('meta_keywords')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 card">
                                <div class="card-header">
                                    <h3 class="card-title">Live Projects Section <span class="text-danger">*</span></h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">

                                        <!-- Live Projects dynamic input section -->
                                        <div id="projects-section" class="col-12">
                                            <div class="form-row align-items-center mb-2 project-row">
                                                <div class="col-md-5">
                                                    <input type="text" name="projects[0][name]" class="form-control"
                                                        placeholder="Project Name" required
                                                        value="{{ old('projects.0.name') }}">
                                                    @error('projects.0.name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" name="projects[0][description]"
                                                        class="form-control" placeholder="Project Description" required
                                                        value="{{ old('projects.0.description') }}">
                                                    @error('projects.0.description')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-1">
                                                    <button type="button" class="btn btn-success add-project"><i
                                                            class="fa fa-plus"></i></button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>


                                                        <div class="col-md-12 card">
                                <div class="card-header">
                                    <h3 class="card-title">What You Will Learn <span class="text-danger">*</span></h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div id="what-you-learn-section" class="col-12">
                                            @php
                                                $whatYouLearn = old('what_you_learn', []);
                                            @endphp
                                            @if (empty($whatYouLearn))
                                                @php $whatYouLearn = ['']; @endphp
                                            @endif
                                            @foreach ($whatYouLearn as $i => $item)
                                                <div class="form-row align-items-center mb-2 what-you-learn-row">
                                                    <div class="col-md-11">
                                                        <input type="text" name="what_you_learn[{{ $i }}]"
                                                            class="form-control" placeholder="What will you learn?"
                                                            required value="{{ old('what_you_learn.' . $i, $item) }}">
                                                        @error('what_you_learn.' . $i)
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-1">
                                                        @if ($i == 0)
                                                            <button type="button"
                                                                class="btn btn-success add-what-you-learn"><i
                                                                    class="fa fa-plus"></i></button>
                                                        @else
                                                            <button type="button"
                                                                class="btn btn-danger remove-what-you-learn"><i
                                                                    class="fa fa-trash"></i></button>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="card-footer float-right">
                            <button type="submit" class="btn btn-success">Submit</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>

                    </form>
                </div>



            </div>
            {{--
                </div>
            </div> --}}

        </div>
    </section>

@endsection
@push('script')
    <script>
        // Live Projects Section: Add/Remove rows
        $(document).ready(function() {
            // What You Learn Section: Add/Remove rows
            let learnIndex = $('.what-you-learn-row').length;
            $(document).on('click', '.add-what-you-learn', function() {
                const newRow = `
                    <div class="form-row align-items-center mb-2 what-you-learn-row">
                        <div class="col-md-11">
                            <input type="text" name="what_you_learn[${learnIndex}]" class="form-control" placeholder="What will you learn?" required>
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn btn-danger remove-what-you-learn"><i class="fa fa-trash"></i></button>
                        </div>
                    </div>`;
                $('#what-you-learn-section').append(newRow);
                learnIndex++;
            });
            $(document).on('click', '.remove-what-you-learn', function() {
                if ($('.what-you-learn-row').length > 1) {
                    $(this).closest('.what-you-learn-row').remove();
                    // Re-index all what-you-learn rows' input names
                    $('.what-you-learn-row').each(function(idx, row) {
                        $(row).find('input[name^="what_you_learn"]').attr('name',
                            `what_you_learn[${idx}]`);
                    });
                    learnIndex = $('.what-you-learn-row').length;
                }
            });
            let projectIndex = 1;
            $(document).on('click', '.add-project', function() {
                const newRow =
                    `<div class=\"form-row align-items-center mb-2 project-row\">\n                    <div class=\"col-md-5\">\n                        <input type=\"text\" name=\"projects[${projectIndex}][name]\" class=\"form-control\" placeholder=\"Project Name\" required>\n                    </div>\n                    <div class=\"col-md-6\">\n                        <input type=\"text\" name=\"projects[${projectIndex}][description]\" class=\"form-control\" placeholder=\"Project Description\" required>\n                    </div>\n                    <div class=\"col-md-1\">\n                        <button type=\"button\" class=\"btn btn-danger remove-project\"><i class=\"fa fa-trash\"></i></button>\n                    </div>\n                </div>`;
                $('#projects-section').append(newRow);
                projectIndex++;
            });
            $(document).on('click', '.remove-project', function() {
                // Only allow removing if more than 1 row exists
                if ($('.project-row').length > 1) {
                    $(this).closest('.project-row').remove();
                }
            });
        });
        // Load FontAwesome icon list from the given JSON file in public assets
        let iconList = [];
        $.getJSON('/asset/fontawesome.json', function(data) {
            iconList = data || [];
        });

        $(document).ready(function() {
            const $input = $('#chooseIcon');
            const $suggestions = $('#iconSuggestions');
            const $preview = $('#iconPreview');
            const $inputPreview = $('#iconInputPreview');

            function showPreview(icon) {
                if (icon && iconList.includes(icon)) {
                    $inputPreview.html(`<i class="${icon}"></i>`);
                    $preview.html(`<i class="${icon}"></i>`);
                } else {
                    $inputPreview.html('<i class="fa fa-question text-muted"></i>');
                    $preview.html('');
                }
            }

            $input.on('input', function() {
                const val = $(this).val().trim().toLowerCase();
                $suggestions.empty();
                $suggestions.hide();
                showPreview(val);
                if (val.length < 1) return;
                const matches = iconList.filter(icon => icon.toLowerCase().includes(val)).slice(0, 300);
                if (matches.length) {
                    matches.forEach(icon => {
                        $suggestions.append(
                            `<a href="#" class="list-group-item list-group-item-action d-flex align-items-center" data-icon="${icon}"><i class="${icon} mr-2"></i> <span>${icon}</span></a>`
                        );
                    });
                    $suggestions.show();
                }
            });

            $suggestions.on('click', 'a', function(e) {
                e.preventDefault();
                const icon = $(this).data('icon');
                $input.val(icon);
                showPreview(icon);
                $suggestions.hide();
            });

            $input.on('focus', function() {
                if ($suggestions.children().length > 0) $suggestions.show();
            });

            $input.on('blur', function() {
                setTimeout(() => $suggestions.hide(), 200);
            });

            $input.on('change', function() {
                const icon = $(this).val().trim();
                showPreview(icon);
            });

            // Initial preview icon
            showPreview('');




            //color picker with addon
            $('.my-colorpicker2').colorpicker()

            $('.my-colorpicker2').on('colorpickerChange', function(event) {
                $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
            })

            $('#summernote').summernote({
                placeholder: 'Write Long Description',
                tabsize: 2,
                height: 200,
                // toolbar: [
                //     ['style', ['bold', 'italic', 'underline', 'clear']],
                //     ['font', ['strikethrough', 'superscript', 'subscript']],
                //     ['fontsize', ['fontsize']],
                //     ['color', ['color']],
                //     ['para', ['ul', 'ol', 'paragraph']],
                //     ['height', ['height']]
                // ]
            })

            //Date and time picker
            $('#reservationdatetime').datetimepicker({
                icons: {
                    time: 'far fa-clock'
                },
                format: 'YYYY-MM-DD HH:mm:ss'
            });
        });
    </script>
@endpush
