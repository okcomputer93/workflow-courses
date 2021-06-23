<x-layout header="false" footer="false">
    <x-slot name="head">
        <title>Workflow | Olvidé Mi Contraseña</title>
    </x-slot>
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <x-form.form :back="true"
                     backUrl="{{ route('login') }}"
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
                Enviar Email
                <x-slot name="icon">
                    <x-icon.inbox-in></x-icon.inbox-in>
                </x-slot>
            </x-form.button>
        </x-form.form>
    </div>
</x-layout>
