<x-layout header="false" footer="false">
    <x-slot name="head">
        <title>Workflow | Login</title>
    </x-slot>
        <div class="min-h-screen flex items-center justify-center bg-gray-100">
            <x-form.form class="h-screen" method="post" action="/login" >
                <x-slot name="title">
                    Sign in to your account
                </x-slot>
                <x-form.input type="email" name="email">Email Address</x-form.input>
                <x-form.input type="password" name="password">Password</x-form.input>
                <div>
                    <div class="flex flex-col sm:flex-row items-center justify-between w-full">
                        <div class="flex items-center pb-4 sm:pb-0">
                            <input class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" id="remember" name="remember" type="checkbox">
                            <label class="ml-2 block text-sm text-gray-900" for="remember">Remember me</label>
                        </div>
                        <a class="text-sm font-medium text-indigo-600 hover:text-indigo-500" href="/forgot-password">Forgot your password?</a>
                    </div>
                </div>
                <x-form.button>
                    Sign Up
                    <x-slot name="icon">
                        <x-icon.lock></x-icon.lock>
                    </x-slot>
                </x-form.button>
            </x-form.form>
        </div>
</x-layout>
