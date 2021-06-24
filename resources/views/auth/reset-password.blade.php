<x-layout header="false" footer="false">
    <x-slot name="head">
        <title>Workflow | Restaurar Contraseña</title>
    </x-slot>
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <x-form.form :back="true"
                     backUrl="{{ route('login') }}"
                     method="post"
                     action="/reset-password"
        >
            <x-slot name="title">
                Nueva Contraseña
            </x-slot>
            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif
            <x-form.input :focus="true" type="email" name="email">Correo Electrónico</x-form.input>
            <x-form.input type="password" name="password">Nueva Contraseña</x-form.input>
            <x-form.input type="password" name="password_confirmation">Confirma tu contraseña</x-form.input>
            <input type="hidden" name="token" value="{{ request()->route('token') }}">
            <x-form.button>
                Restaurar
                <x-slot name="icon">
                    <x-icon.key></x-icon.key>
                </x-slot>
            </x-form.button>
        </x-form.form>
    </div>
</x-layout>
