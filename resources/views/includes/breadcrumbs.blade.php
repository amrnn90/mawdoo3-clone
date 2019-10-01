@if (count($breadcrumbs))

    <ol class="breadcrumb">
        @foreach ($breadcrumbs as $breadcrumb)
            @if (!$loop->first)
                <span class="breadcrumb__separator">/</span>
            @endif

            @if ($breadcrumb->url && !$loop->last)
                <li class="breadcrumb__item"><a href="{{ $breadcrumb->url }}" title="{{ $breadcrumb->title }}">{{ $breadcrumb->title }}</a></li>
            @else
                <li class="breadcrumb__item breadcrumb__item--active" title="{{ $breadcrumb->title }}">{{ $breadcrumb->title }}</li>
            @endif

        @endforeach
    </ol>

@endif