@unless ($breadcrumbs->isEmpty())

    <ol class="breadcrumb" style="background-color: white;">
        @foreach ($breadcrumbs as $breadcrumb)

            @if (!is_null($breadcrumb->url) && !$loop->last)
                <li class="breadcrumb-item" style="color:black;"><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
            @else
                <li class="breadcrumb-item active" style="color:black;">{{ $breadcrumb->title }}</li>
            @endif

        @endforeach
    </ol>

@endunless
