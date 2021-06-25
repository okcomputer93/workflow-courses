@props([
    'card' => 'summary',
    'title',
    'description',
    'image' => false
])

@push('opengraph')
    <meta name="twitter:card" content="{{ $card }}" />
    <meta name="twitter:site" content="@workflow" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:title" content="{{ $title }}" />
    <meta property="og:description" content="{{ $description }}" />
    @if($image)
        <meta property="og:image" content="{{ $image }}" />
    @endif
@endpush
