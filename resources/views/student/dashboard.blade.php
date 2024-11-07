@extends('layouts.app')

@section('title')
    Student Dashboard
@endsection



@section('content')
    <main class="container mx-auto my-10">
        {{-- carousel --}}
        <section>
            <div class="splide">
                <div class="splide__track">
                    <ul class="splide__list">
                        @foreach ($events as $event)
                            <li class="flex items-center justify-center splide__slide">
                                <img src="{{Storage::url($event->cover_image)}}"
                                alt="{{ $event->title }}" class="object-cover w-full h-96">
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </section>
        {{-- latest events --}}
        <section class="my-10">
            <h2 class="my-6 text-2xl font-bold">Latest Events</h2>
            <div class="grid grid-cols-3 gap-4">
                @foreach ($events as $event)
                    <div class="p-4 bg-white rounded-lg shadow">
                        <img src="{{Storage::url($event->cover_image)}}" alt="{{ $event->title }}" class="object-cover w-full h-48">
                        <h3 class="mt-2 text-xl font-bold">{{ $event->name }}</h3>
                        <p class="text-gray-500">{{ $event->date->format('M d, Y') }}</p>
                        <div class="flex items-center justify-between mt-4">
                            {{-- <a href="{{ route('events.show', $event) }}" class="px-4 py-2 text-white bg-blue-500 rounded-lg">View</a> --}}
                            {{-- <span class="text-gray-500">{{ $event->created_at->diffForHumans() }}</span> --}}
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="flex items-center justify-center mt-6">
                <a href="{{route('student.events')}}" class="btn btn-primary">
                    View All 
                </a>
            </div>

        </section>

        {{-- 8 organizations --}}
        <section class="my-10">
            <h2 class="my-6 text-2xl font-bold">Organizations</h2>
            <div class="grid grid-cols-4 gap-4">
                @foreach ($organizations as $organization)
                    <div class="p-4 bg-white rounded-lg shadow">
                        <img src="{{Storage::url($organization->logo)}}" alt="{{ $organization->name }}" class="object-cover w-full h-48">
                        <h3 class="mt-2 text-xl font-bold">{{ $organization->name }}</h3>
                       
                    </div>
                @endforeach
            </div>
            
            
        </section>
        
    </main>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        new Splide('.splide', {
            type: 'fade',
            perPage: 1,
            autoplay: true,
            interval: 5000,
            pauseOnHover: false,
        }).mount();
    });
</script>