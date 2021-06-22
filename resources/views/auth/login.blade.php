<x-layout header="false" footer="false">
    <x-slot name="head">
        <title>Workflow | Login</title>
    </x-slot>
        <div class="min-h-screen flex items-center justify-center bg-gray-100">
            <x-form.form :back="true"
                         method="post"
                         action="/login"
            >
                <x-slot name="title">
                    Entrar a tu cuenta
                </x-slot>
                <x-form.input focus="true" type="email" name="email">Correo Electrónico</x-form.input>
                <x-form.input type="password" name="password">Contraseña</x-form.input>
                <div class="flex flex-col sm:flex-row items-center justify-between w-full">
                    <div class="flex items-center pb-4 sm:pb-0">
                        <input class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" id="remember" name="remember" type="checkbox">
                        <label class="ml-2 block text-sm text-gray-900" for="remember">Recordarme</label>
                    </div>
                    <a class="text-sm font-medium text-indigo-600 hover:text-indigo-500" href="/forgot-password">¿Olvidaste tu contraseña?</a>
                </div>
                <x-form.button>
                    Entrar
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
