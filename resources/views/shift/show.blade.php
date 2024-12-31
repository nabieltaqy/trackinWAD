@extends('layouts.sidebar')

@section('content')
<div class="container mt-5">
    <div class="flex items-center mb-4">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z" fill="url(#paint0_linear_9_749)"/>
            <path d="M12 6c-3.31 0-6 2.69-6 6s2.69 6 6 6 6-2.69 6-6-2.69-6-6-6zm0 10c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4z" fill="url(#paint1_linear_9_749)"/>
            <defs>
                <linearGradient id="paint0_linear_9_749" x1="4" y1="4" x2="20.8001" y2="20.8001" gradientUnits="userSpaceOnUse">
                    <stop stop-color="#FFB790"/>
                    <stop offset="1" stop-color="#E8590C"/>
                </linearGradient>
                <linearGradient id="paint1_linear_9_749" x1="4" y1="4" x2="20.8001" y2="20.8001" gradientUnits="userSpaceOnUse">
                    <stop stop-color="#FFB790"/>
                    <stop offset="1" stop-color="#E8590C"/>
                </linearGradient>
            </defs>
        </svg>
        <h1 class="text-xl font-extrabold text-gray-900 ml-2">Detail Shift</h1>
    </div>

    <div class="bg-white p-4 rounded-md shadow">
        <p><strong>ID:</strong> {{ $shift->id }}</p>
        <p><strong>Nama Shift:</strong> {{ $shift->name }}</p>
        <p><strong>Jam Mulai:</strong> {{ $shift->shift_start }}</p>
        <p><strong>Jam Selesai:</strong> {{ $shift->shift_end }}</p>
        
        <div class="mt-4">
            <a href="{{ route('shift.index') }}" class="bg-yellow-500 text-white px-4 py-2 rounded">Kembali</a>
        </div>
    </div>
</div>
@endsection
