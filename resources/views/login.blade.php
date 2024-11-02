@extends('layouts.guest')
{{-- capitalize $role + login --}}
@section('title')
    {{ strtoupper($role) }} Login
@endsection

@section('content')
    <main class="container mx-auto flex justify-center items-center min-h-screen">
        <div class="max-w-md mx-auto bg-white px-6 py-12 rounded shadow-md flex flex-col items-center justify-center">
            <h1 class="text-2xl font-bold text-center mb-8">{{ ucfirst($role) }} </h1>
            <img src="/logo.png" alt="Student organization collaboration and events management">
            <form class="w-full mt-8" method="POST" action="{{ route('authenticate') }}">
                @csrf
                @method('POST')
                @if ($errors->any())
                    <div class="w-full mb-4">
                        <ul class="list-disc list-inside text-red-600">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <x-text-input name="email" label="Email" type="email" required />
                <x-text-input name="password" label="Password" type="password" required />
                <x-primary-button class="w-full" type="submit">Login</x-primary-button>
            </form>
        </div>


    </main>
@endsection
