<x-layout header="false" footer="false">
    <x-slot name="head">
        <title>Workflow | Register</title>
    </x-slot>
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <x-form.form class="h-screen" method="post" action="/register" >
            <x-slot name="title">
                Register in Workflow
            </x-slot>
            <x-form.input type="text" name="name">Name</x-form.input>
            <x-form.input type="email" name="email">Email Address</x-form.input>
            <x-form.input type="password" name="password">Password</x-form.input>
            <x-form.input type="password" name="password_confirmation">Confirm Your Password</x-form.input>
            <div class="flex items-center justify-center w-full">
                <a class="text-sm font-medium text-indigo-600 hover:text-indigo-500" href="/login">Already have an account?</a>
            </div>
            <x-form.button>
                Register
                <x-slot name="icon">
                    <x-icon.user></x-icon.user>
                </x-slot>
            </x-form.button>
        </x-form.form>
    </div>
</x-layout>
