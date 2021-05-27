@php
    $random = range(2, 6);
    shuffle($random);
@endphp

<div class="skeleton-card">
    <article class="bg-white rounded-sm rounded-md"
             style="min-width: 36rem;"
    >
        <div class="flex items-center">
            <div class="w-44 h-44 bg-gray-200 flex-initial"></div>
            <div class="flex-auto flex flex-col justify-between h-72 p-6 pr-8">
                <div class="flex items-center w-full h-6 space-x-2">
                    <div class="w-1/{{ $random[0] }} h-full bg-gray-200 rounded-lg"></div>
                    <div class="w-1/{{ $random[1] }} h-full bg-gray-200 rounded-lg"></div>
                </div>
                <div class="flex flex-col h-12 w-full space-y-2">
                    <div class="flex items-center space-x-2 h-1/2">
                        <div class="w-1/{{ $random[2] }} h-full bg-gray-200"></div>
                        <div class="w-full h-full bg-gray-200"></div>
                    </div>
                    <div class="flex items-center space-x-2 h-1/2">
                        <div class="w-1/{{ $random[3] }} h-full bg-gray-200"></div>
                        <div class="w-1/{{ $random[4] }} h-full bg-gray-200"></div>
                    </div>
                </div>
                <div class="w-1/3 h-4 bg-gray-200"></div>
                <div class="flex items-center space-x-1 h-3 w-full">
                    <div class="w-1/{{ $random[2] }} h-full bg-gray-200"></div>
                    <div class="w-1/{{ $random[4] }} h-full bg-gray-200"></div>
                </div>
                <div class="self-end w-1/4 h-10 bg-gray-200 rounded"></div>
            </div>
        </div>
    </article>
</div>
