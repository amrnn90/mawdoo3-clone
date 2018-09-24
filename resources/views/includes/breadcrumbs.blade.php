@if (count($breadcrumbs))

    <ol class="breadcrumb">
        @foreach ($breadcrumbs as $breadcrumb)
            @if (!$loop->first)
                <span class="breadcrumb__separator">/</span>
            @endif

            @if ($breadcrumb->url && !$loop->last)
                <li class="breadcrumb__item"><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
            @else
                <li class="breadcrumb__item breadcrumb__item--active">{{ $breadcrumb->title }}</li>
            @endif

        @endforeach
    </ol>

@endif