<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">{{ $title ?? 'Dashboard' }}</h1>
            </div><div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    @foreach($items as $item)
                        <li class="breadcrumb-item {{ !isset($item['url']) ? 'active' : '' }}">
                            @if(isset($item['url']))
                                <a href="{{ $item['url'] }}">{{ $item['label'] }}</a>
                            @else
                                {{ $item['label'] }}
                            @endif
                        </li>
                    @endforeach
                </ol>
            </div></div></div></div>
