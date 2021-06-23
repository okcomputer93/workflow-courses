<x-layout header="false" footer="false">
    <x-slot name="head">
        <title>Workflow | Login</title>
    </x-slot>
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <x-form.form :back="true"
                     method="post"
                     action="/forgot-password"
        >
            <x-slot name="title">
                Restaurar Contraseña
            </x-slot>
            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif
            <x-form.input focus="true" type="email" name="email">Correo Electrónico</x-form.input>
            <x-form.button>
                Restaurar
                <x-slot name="icon">
                    <x-icon.lock></x-icon.lock>
                </x-slot>
            </x-form.button>
            <div class="flex items-center justify-center w-full">
                <a class="text-sm font-medium text-indigo-600 hover:text-indigo-500"
                   href="/register"
                >
                    ¿No tienes una cuenta?
                </a>
            </div>
        </x-form.form>
    </div>
</x-layout>
