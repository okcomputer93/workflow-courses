<x-layout>
    <x-slot name="head">
        <title>Workflow | Profile</title>
    </x-slot>

    <h1>User Profile</h1>

    <h2>{{ $user->name }}</h2>

    <h3>{{ $user->email }}</h3>

    <p>{{ $user->role->schooling }}</p>

    <img src="{{ $user->avatar }}" alt="{{ $user->name . " 's avatar" }}">

</x-layout>
