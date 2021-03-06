<x-layout header="false" footer="false">

    <x-social-media-meta-tags title="Regístrate en Workflow"
                              description="Regístrate para acceder a nuestros cursos en línea"
                              image="/images/header-person.png"
    ></x-social-media-meta-tags>

    <x-slot name="head">
        <title>Workflow | Registro</title>
    </x-slot>
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <x-form.form :back="true" method="post" action="/register" >
            <x-slot name="title">
                Bienvenido a Workflow
            </x-slot>
            <x-form.input type="text" name="name" :focus="true">Nombre</x-form.input>
            <x-form.input type="email" name="email">Correo Electrónico</x-form.input>
            <x-form.input type="password" name="password">Contraseña</x-form.input>
            <x-form.input type="password" name="password_confirmation">Confirma tu contraseña</x-form.input>
            <x-form.button>
                Registrarme
                <x-slot name="icon">
                    <x-icon.user></x-icon.user>
                </x-slot>
            </x-form.button>
            <div class="flex items-center justify-center w-full">
                <a class="text-sm font-medium text-indigo-600 hover:text-indigo-500" href="/login">¿Ya tienes una cuenta?</a>
            </div>
        </x-form.form>
    </div>
</x-layout>
