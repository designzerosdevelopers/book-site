
@foreach (\App\Helpers\SiteviewHelper::customCode('Stylesheet', 'For Footer Section') as $links)
@if ($links->file == 1)
    <link href="{{ asset($links->link) }}" rel="stylesheet">
@else
    <link href="{{ $links->link }}" rel="stylesheet">
@endif
@endforeach

@foreach (\App\Helpers\SiteviewHelper::customCode('JavaScript', 'For Footer Section') as $links)
@if ($links->file == 1)
<script src="{{ asset($links->link) }}"></script>
@else
<script src="{{ $links->link }}"></script>
@endif
@endforeach