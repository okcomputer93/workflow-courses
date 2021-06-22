<x-layout>
    <x-slot name="head">
        <title>Workflow | Registro</title>
    </x-slot>
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <x-form.form method="patch" action="{{ route('user-role-information.update') }}" >
            <x-slot name="title">
                Regístrate como Profesor
            </x-slot>
            <x-form.input type="text" name="career" :focus="true">Profesión</x-form.input>
            <x-form.textarea name="about">Acerca de tí</x-form.textarea>
            <x-form.input type="text" name="twitter_user">Usuario Twitter</x-form.input>
            <x-form.input type="text" name="github_user">Usuario Github</x-form.input>
            <input type="hidden" name="role" value="professor">
            <x-form.button>
                Registrarme
                <x-slot name="icon">
                    <x-icon.user></x-icon.user>
                </x-slot>
            </x-form.button>
        </x-form.form>
    </div>
</x-layout>
