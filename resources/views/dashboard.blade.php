@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-semibold leading-tight mb-4">Dashboard</h2>
        <p class="text-gray-700">You are logged in!</p>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="mt-4 bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">
                Logout
            </button>
        </form>
    </div>
</div>
@endsection