<x-layout header="false" footer="false">
    <x-slot name="head">
        <title>Workflow | Mi Perfil</title>
    </x-slot>
    @push('scripts')
        <script src="{{ asset('js/profile.js') }}"></script>
    @endpush
    <div id="app">
        <router-view></router-view>
    </div>

</x-layout>
