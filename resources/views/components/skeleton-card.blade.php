@php
    $random = range(2, 6);
    shuffle($random);
@endphp

<article class="skeleton-card bg-white rounded-sm rounded-md h-96 w-72 xl:h-80 xl:w-full">
    <div class="flex flex-col items-center h-full w-full xl:flex-row">
        <div class="w-32 h-52 bg-gray-200 flex-initial xl:w-64 xl:h-44"></div>
        <div class="flex-auto flex flex-col justify-between items-center h-full w-full space-y-3 p-6 xl:items-start xl:space-y-0">
            <div class="flex items-center justify-center w-full h-6 space-x-2 xl:justify-start">
                <div class="w-1/{{ $random[0] }} h-full bg-gray-200 rounded-lg"></div>
                <div class="w-1/{{ $random[1] }} h-full bg-gray-200 rounded-lg"></div>
            </div>
            <div class="flex flex-col h-20 w-full space-y-2">
                <div class="flex items-center justify-center space-x-2 h-1/3 xl:justify-start">
                    <div class="w-1/{{ $random[0] }} h-full bg-gray-200"></div>
                    <div class="w-full h-full bg-gray-200"></div>
                </div>
                <div class="flex items-center justify-center space-x-2 h-1/3 xl:justify-start">
                    <div class="w-full h-full bg-gray-200"></div>
                    <div class="w-1/{{ $random[1] }} h-full bg-gray-200"></div>
                    <div class="w-1/{{ $random[2] }} h-full bg-gray-200"></div>
                </div>
                <div class="flex items-center justify-center space-x-2 h-1/3 xl:justify-start">
                    <div class="w-1/{{ $random[2] }} h-full bg-gray-200"></div>
                    <div class="w-1/{{ $random[3] }} h-full bg-gray-200"></div>
                </div>
            </div>
            <div class="w-1/3 h-4 bg-gray-200"></div>
            <div class="flex items-center justify-center space-x-1 h-3 w-full xl:justify-start">
                <div class="w-1/{{ $random[2] }} h-full bg-gray-200"></div>
                <div class="w-1/{{ $random[4] }} h-full bg-gray-200"></div>
            </div>
            <div class="self-center w-2/5 h-10 bg-gray-200 rounded px-4 rounded-full py-2 xl:self-end xl:px-8 xl:py-3 xl:w-1/3"></div>
        </div>
    </div>
</article>
