@props([
'auth' => 'false'
])
@push('scripts')
    <script src="{{ asset('js/header-menu.js') }}" defer></script>
@endpush
<nav class="bg-blue-dark font-sans">
    <div class="max-w-7xl mx-auto">
        <div class="flex items-center justify-between px-2 md:px-6">
            <div class="flex-1 visible sm:hidden text-gray-300 hover:text-white"
                 id="menu-open"
            >
                <x-icon.menu></x-icon.menu>
            </div>
            <div class="flex-shrink-0 flex justify-between items-center">
                <h1 class="pr-2">
                    <a href="{{ url('/') }}">
                        <img class="hidden lg:block h-8 w-auto" src="/images/workflow-logo.svg" alt="Workflow Logo">
                        <img class="block lg:hidden h-8 w-auto" src="/images/workflow-mark.svg" alt="Workflow Logo">
                    </a>
                </h1>
                <div
                    class="fixed top-0 transform transition-transform duration-500 -translate-x-full left-0 bg-blue-dark w-2/3 z-40 sm:translate-x-0 sm:w-auto sm:bg-transparent h-full sm:relative sm:ml-6 sm:h-auto"
                    id="menu"
                >
                    <div class="mt-10 sm:mt-0 space-y-6 sm:space-y-0">
                        <div class="block ml-5 text-gray-300 sm:hidden mb-1"
                             id="menu-close"
                        >
                            <x-icon.x></x-icon.x>
                        </div>
                        {{ $slot }}
                    </div>
                </div>
            </div>
            <div class="flex-1 flex justify-end">
                @if($auth !== 'false')
                    @guest
                        @if (Route::has('login'))
                            <a href="{{ route('login') }}"
                               class="inline-block inline-block px-1 sm:px-4 py-7 cursor-pointer text-xs sm:text-base text-gray-400 font-medium border-b-4 border-transparent hover:text-gray-100 hover:border-indigo-500 hover:border-b-4">
                                {{ __('Login') }}
                            </a>
                        @endif
                        @if (Route::has('register'))
                            <x-button class="m-5" href="/register">Regístrate</x-button>
                        @endif
                    @else
                        <a class="inline-block inline-block px-1 sm:px-4 py-6 cursor-pointer text-xs sm:text-base text-gray-300 font-medium border-b-4 border-transparent hover:text-gray-100 hover:border-indigo-500 hover:border-b-4"
                           href="/user"
                        >
                            <div class="flex justify-center items-center">
                                <img class="rounded-full h-8 w-8 mr-3 ring-4 ring-indigo-500"
                                     src="{{ asset(Auth::user()->avatar) }}"
                                     alt="{{ Auth::user()->name }} avatar"
                                >
                                <span class="hidden md:inline">{{ Auth::user()->name }}</span>
                            </div>
                        </a>
                        <x-form-button action="{{ route('logout') }}" method="POST"
                                       class="inline-block inline-block px-1 sm:px-4 py-7 cursor-pointer text-xs sm:text-base text-gray-500 font-medium border-b-4 border-transparent hover:text-gray-100 hover:border-indigo-500 hover:border-b-4 hidden md:block">
                            {{ __('Logout') }}
                        </x-form-button>
                    @endguest
                @endif
            </div>
        </div>
    </div>
</nav>
