@extends('layouts.app')

@section('content')

    <div class="max-w-6xl mx-auto px-8 md:px-12 lg:px-20 py-16 md:py-24">
        <a href="{{ route('girls.index') }}"
            class="inline-flex items-center text-xs uppercase tracking-widest text-[#C5A059] hover:text-white mb-12 transition-colors">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to Rota
        </a>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-24">
            <!-- Images Column -->
            <div class="lg:col-span-7 space-y-8">
                @if($girl->featured_image)
                    <div class="aspect-[3/4] bg-gray-900 overflow-hidden">
                        <img src="{{ Storage::url($girl->featured_image) }}" alt="{{ $girl->name }}"
                            class="w-full h-full object-cover">
                    </div>
                @endif

                @if($girl->gallery_images)
                    <div class="grid grid-cols-2 gap-4">
                        @foreach($girl->gallery_images as $image)
                            <div class="aspect-[3/4] bg-gray-900 overflow-hidden">
                                <img src="{{ Storage::url($image) }}" alt="Gallery Image"
                                    class="w-full h-full object-cover hover:scale-105 transition-transform duration-700">
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Details Column -->
            <div class="lg:col-span-5 lg:sticky lg:top-32 h-fit">
                <h1 class="text-5xl md:text-7xl font-serif text-white mb-8">{{ $girl->name }}</h1>

                <div class="prose prose-lg prose-invert text-gray-400 font-light mb-12">
                    {!! $girl->intro !!}
                </div>

                <!-- Stats Block -->
                <div class="border border-white/5 bg-white/5 p-8 mb-8">
                    <h3 class="text-[#C5A059] font-serif text-2xl mb-6 uppercase tracking-[0.2em] text-sm">Physical Stats
                    </h3>
                    <div class="grid grid-cols-2 gap-y-6 gap-x-8">
                        @foreach(['Age' => 'age', 'Height' => 'height', 'Dress Size' => 'dress_size', 'Bust Size' => 'bust_size', 'Eyes' => 'eyes', 'Hair' => 'hair', 'Nationality' => 'nationality'] as $label => $key)
                            @if($girl->$key)
                                <div class="flex flex-col border-b border-white/5 pb-2">
                                    <span class="text-[10px] uppercase tracking-widest text-gray-500 mb-1">{{ $label }}</span>
                                    <span class="text-white text-sm tracking-widest font-medium">{{ $girl->$key }}</span>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

                <!-- Services Block -->
                @if(!empty($girl->services))
                    <div class="border border-white/5 bg-white/5 p-8 mb-8">
                        <h3 class="text-[#C5A059] font-serif text-2xl mb-6 uppercase tracking-[0.2em] text-sm">Specialities</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($girl->services as $service)
                                <span
                                    class="bg-white/5 border border-white/10 px-3 py-1.5 text-[9px] uppercase tracking-widest text-gray-400 hover:border-[#C5A059]/50 transition-colors">
                                    {{ $service }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Availability Block -->
                <div class="border border-white/5 bg-white/5 p-8 mb-12">
                    <h3 class="text-[#C5A059] font-serif text-2xl mb-6">Availability</h3>
                    <div class="space-y-3">
                        @php
                            $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                        @endphp

                        @foreach($days as $day)
                            @php
                                $isAvailable = in_array($day, $girl->availability ?? []);
                            @endphp
                            <div
                                class="flex items-center justify-between text-sm tracking-widest {{ $isAvailable ? 'text-white' : 'text-gray-600' }}">
                                <span>{{ $day }}</span>
                                <span>{{ $isAvailable ? 'Available' : 'Unavailable' }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- CTA -->
                <a href="{{ route('contact') }}"
                    class="block w-full py-4 bg-[#C5A059] text-black text-center uppercase tracking-widest text-sm hover:bg-white transition-colors font-medium">
                    Book {{ $girl->name }} Now
                </a>
            </div>
        </div>
    </div>

@endsection