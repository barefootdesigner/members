@extends('layouts.app')

@section('title', 'This Week - Brooklyns Babes')

@section('content')

<section class="max-w-6xl mx-auto px-8 md:px-12 lg:px-20 py-16 md:py-24">
    <div class="mb-16">
        <h1 class="text-3xl md:text-5xl font-serif text-white mb-6 uppercase tracking-widest">This Week</h1>
        <p class="text-gray-400 font-light max-w-2xl">View our ladies' availability throughout the week. Click on any profile for more details.</p>
    </div>

    <div class="space-y-24">
        @foreach($daysOfWeek as $day)
            @php
                $isToday = $day === date('l');
                $girls = $weekSchedule[$day];
            @endphp

            <div>
                <div class="flex items-center justify-between mb-12">
                    <h2 class="text-2xl md:text-3xl font-serif {{ $isToday ? 'text-[#C5A059]' : 'text-white' }} uppercase tracking-wider">
                        {{ $day }}
                        @if($isToday)
                            <span class="text-sm ml-3 text-[#C5A059] font-sans normal-case tracking-normal">(Today)</span>
                        @endif
                    </h2>
                    <span class="text-sm text-gray-500 uppercase tracking-widest">
                        {{ $girls->count() }} {{ Str::plural('Lady', $girls->count()) }}
                    </span>
                </div>

                @if($girls->isEmpty())
                    <div class="border border-white/5 bg-white/5 py-12 text-center">
                        <p class="text-gray-600 italic">No ladies scheduled for this day</p>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-12 gap-y-16">
                        @foreach($girls as $girl)
                            <x-girl-card :girl="$girl" :index="$loop->index" />
                        @endforeach
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</section>

@endsection
