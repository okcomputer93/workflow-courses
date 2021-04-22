@props([
    'auth' => 'false'
])

<nav class="bg-white font-sans">
    <div class="max-w-7xl mx-auto">
        <div class="flex items-center justify-between px-6">
            <h1 class="flex-1 visible sm:hidden">Me</h1>
            <div class="flex-shrink-0 flex justify-between items-center">
                <h1 class="pr-2">
                    <a href="{{ url('/') }}">
                        <img class="hidden lg:block h-8 w-auto" src="/images/workflow-logo.svg" alt="Workflow Logo">
                        <img class="block lg:hidden h-8 w-auto" src="/images/workflow-mark.svg" alt="Workflow Logo">
                    </a>
                </h1>
                <div class="hidden sm:block sm:ml-6">
                    {{ $slot }}
                </div>
            </div>
            <div class="flex-1 flex justify-end">
                @if($auth !== 'false')
                        @guest
                            @if (Route::has('login'))
                                <a href="{{ route('login') }}" class="inline-block inline-block px-1 sm:px-4 py-6 cursor-pointer text-xs sm:text-base text-gray-500 font-medium border-b-2 border-transparent hover:text-gray-900 hover:border-indigo-500 hover:border-b-4">
                                    {{ __('Login') }}
                                </a>
                            @endif
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="inline-block inline-block px-1 sm:px-4 py-6 cursor-pointer text-xs sm:text-base text-gray-500 font-medium border-b-2 border-transparent hover:text-gray-900 hover:border-indigo-500 hover:border-b-4">
                                    {{ __('Register') }}
                                </a>
                            @endif
                        @else
                            <a href="#" class="inline-block">
                                {{ Auth::user()->name }}
                            </a>
                            <a href="{{ route('logout') }}" class="inline-block">
                                {{ __('Logout') }}
                            </a>
                    @endguest
                @endif
            </div>
        </div>
    </div>
</nav>
