@extends('layout.app')
@section('title', 'View Program')
@section('content')
    <x-breadcrumb :items="[
        ['label' => 'Home', 'url' => route('dashboard')],
        ['label' => 'Programs', 'url' => route('courses.index')],
        ['label' => 'View Program', 'url' => '#'],
    ]" title="View Program" backUrl="{{ route('courses.index') }}" />

    <section class="content">
        <div class="container-fluid">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">Program Details</h3>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <div class="col-12 mb-4">
                            <div class="card shadow border-0" style="max-width: 600px; margin: 0 auto;">
                                <div class="card-body d-flex align-items-center" style="background: {{ $course->bg_color }}; border-radius: 1rem;">
                                    <div class="mr-4 text-center">
                                        <span style="display:inline-block; width:70px; height:70px; background: #fff; border-radius: 50%; box-shadow: 0 2px 8px rgba(0,0,0,0.08); display:flex; align-items:center; justify-content:center;">
                                            <i class="{{ $course->icon }}" style="font-size:2.5rem; color: {{ $course->bg_color }};"></i>
                                        </span>
                                    </div>
                                    @php
                                        // Calculate text color for contrast
                                        function getContrastYIQ($hexcolor) {
                                            $hexcolor = str_replace('#', '', $hexcolor);
                                            if(strlen($hexcolor) == 3) $hexcolor = $hexcolor[0].$hexcolor[0].$hexcolor[1].$hexcolor[1].$hexcolor[2].$hexcolor[2];
                                            $r = hexdec(substr($hexcolor,0,2));
                                            $g = hexdec(substr($hexcolor,2,2));
                                            $b = hexdec(substr($hexcolor,4,2));
                                            $yiq = (($r*299)+($g*587)+($b*114))/1000;
                                            return ($yiq >= 180) ? '#222' : '#fff';
                                        }
                                        $textColor = getContrastYIQ($course->bg_color);
                                    @endphp
                                    <div style="color: {{ $textColor }}; width:100%;">
                                        <h3 class="mb-1" style="font-weight: 700; color: inherit;">{{ $course->title }}</h3>
                                        <div class="mb-2" style="color: {{ $textColor == '#fff' ? 'rgba(255,255,255,0.85)' : '#555' }};">{{ $course->short_desc }}</div>
                                        <div class="mb-2">
                                            <strong>Skills:</strong>
                                            @php
                                                $skills = is_array($course->skills) ? $course->skills : (is_string($course->skills) && str_starts_with($course->skills, '[') ? json_decode($course->skills, true) : (is_string($course->skills) ? explode(',', $course->skills) : []));
                                            @endphp
                                            <span>
                                                @foreach($skills as $skill)
                                                    <span class="badge mx-1" style="background: #fff; color: {{ $course->bg_color }}; border: 1px solid {{ $course->bg_color }}; font-weight: 500;">{{ $skill }}</span>
                                                @endforeach
                                            </span>
                                        </div>
                                        <div class="mb-2">
                                            <strong>Offer End Date:</strong> {{ $course->offer_end_at ? \Carbon\Carbon::parse($course->offer_end_at)->format('Y-m-d') : '-' }}
                                        </div>
                                        <div class="mb-2">
                                            <strong>Pricing:</strong>
                                            <span class="badge mx-1" style="background: #fff; color: {{ $course->bg_color }}; border: 1px solid {{ $course->bg_color }}; font-weight: 500;">
                                                3 Month: <span style="font-weight:700;">{{ $course->price_3_month }}</span>
                                                @if($course->original_price_3_month && $course->original_price_3_month > $course->price_3_month)
                                                    <span style="text-decoration:line-through; color:#888; margin-left:4px;">{{ $course->original_price_3_month }}</span>
                                                @endif
                                            </span>
                                            <span class="badge mx-1" style="background: #fff; color: {{ $course->bg_color }}; border: 1px solid {{ $course->bg_color }}; font-weight: 500;">
                                                6 Month: <span style="font-weight:700;">{{ $course->price_6_month }}</span>
                                                @if($course->original_price_6_month && $course->original_price_6_month > $course->price_6_month)
                                                    <span style="text-decoration:line-through; color:#888; margin-left:4px;">{{ $course->original_price_6_month }}</span>
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <dt class="col-sm-3">Long Description</dt>
                        <dd class="col-sm-9">{!! nl2br(e($course->long_desc)) !!}</dd>

                        <dt class="col-sm-3">Meta Description</dt>
                        <dd class="col-sm-9">{{ $course->meta_description }}</dd>

                        <dt class="col-sm-3">Meta Keywords</dt>
                        <dd class="col-sm-9">{{ $course->meta_keywords }}</dd>

                        <dt class="col-sm-3">Live Projects</dt>
                        <dd class="col-sm-9">
                            @php
                                $projects = is_array($course->projects) ? $course->projects : (is_string($course->projects) && str_starts_with($course->projects, '[') ? json_decode($course->projects, true) : []);
                            @endphp
                            @if(!empty($projects))
                                <div class="row">
                                    @foreach($projects as $project)
                                        <div class="col-md-6 mb-2">
                                            <div class="card h-100 shadow-sm border-0" style="background: #f8f9fa; border-left: 4px solid {{ $course->bg_color }};">
                                                <div class="card-body p-2">
                                                    <div class="font-weight-bold" style="color: {{ $course->bg_color }}; font-size: 1.1rem;">
                                                        <i class="fa fa-project-diagram mr-1"></i> {{ $project['name'] ?? '' }}
                                                    </div>
                                                    <div class="text-muted small">{{ $project['description'] ?? '' }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <span class="text-muted">No projects listed.</span>
                            @endif
                        </dd>
                    </dl>
                    <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-info">Edit</a>
                    <a href="{{ route('courses.index') }}" class="btn btn-secondary">Back</a>
                </div>
            </div>
        </div>
    </section>
@endsection
