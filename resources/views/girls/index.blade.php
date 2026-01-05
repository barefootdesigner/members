@extends('layouts.app')

@section('content')

<section class="max-w-6xl mx-auto px-8 md:px-12 lg:px-20 py-16 md:py-24">
    <div class="mb-16">
        <h1 class="text-3xl md:text-5xl font-serif text-white mb-6 uppercase tracking-widest">Our Ladies</h1>
        <p class="text-gray-400 font-light max-w-2xl mb-12">Select a profile to view more details. Use the filters below to find exactly who you are looking for.</p>

        {{-- Filters --}}
        <form action="{{ route('girls.index') }}" method="GET" class="flex flex-wrap gap-4 items-center">
            <select name="day" onchange="this.form.submit()" class="bg-black/50 border border-white/10 text-gray-400 px-6 py-3 text-[10px] uppercase tracking-widest focus:border-[#C5A059] focus:text-white outline-none transition-all cursor-pointer hover:bg-white/5">
                <option value="">Availability</option>
                @foreach($filterData['days'] as $day)
                    <option value="{{ $day }}" {{ request('day') == $day ? 'selected' : '' }}>{{ $day }}</option>
                @endforeach
            </select>

            <select name="age" onchange="this.form.submit()" class="bg-black/50 border border-white/10 text-gray-400 px-6 py-3 text-[10px] uppercase tracking-widest focus:border-[#C5A059] focus:text-white outline-none transition-all cursor-pointer hover:bg-white/5">
                <option value="">Age</option>
                @foreach($filterData['age'] as $age)
                    <option value="{{ $age }}" {{ request('age') == $age ? 'selected' : '' }}>{{ $age }}</option>
                @endforeach
            </select>

            <select name="hair" onchange="this.form.submit()" class="bg-black/50 border border-white/10 text-gray-400 px-6 py-3 text-[10px] uppercase tracking-widest focus:border-[#C5A059] focus:text-white outline-none transition-all cursor-pointer hover:bg-white/5">
                <option value="">Hair</option>
                @foreach($filterData['hair'] as $hair)
                    <option value="{{ $hair }}" {{ request('hair') == $hair ? 'selected' : '' }}>{{ $hair }}</option>
                @endforeach
            </select>

            <select name="eyes" onchange="this.form.submit()" class="bg-black/50 border border-white/10 text-gray-400 px-6 py-3 text-[10px] uppercase tracking-widest focus:border-[#C5A059] focus:text-white outline-none transition-all cursor-pointer hover:bg-white/5">
                <option value="">Eyes</option>
                @foreach($filterData['eyes'] as $eyes)
                    <option value="{{ $eyes }}" {{ request('eyes') == $eyes ? 'selected' : '' }}>{{ $eyes }}</option>
                @endforeach
            </select>

            <select name="nationality" onchange="this.form.submit()" class="bg-black/50 border border-white/10 text-gray-400 px-6 py-3 text-[10px] uppercase tracking-widest focus:border-[#C5A059] focus:text-white outline-none transition-all cursor-pointer hover:bg-white/5">
                <option value="">Nationality</option>
                @foreach($filterData['nationality'] as $nationality)
                    <option value="{{ $nationality }}" {{ request('nationality') == $nationality ? 'selected' : '' }}>{{ $nationality }}</option>
                @endforeach
            </select>

            <select name="height" onchange="this.form.submit()" class="bg-black/50 border border-white/10 text-gray-400 px-6 py-3 text-[10px] uppercase tracking-widest focus:border-[#C5A059] focus:text-white outline-none transition-all cursor-pointer hover:bg-white/5">
                <option value="">Height</option>
                @foreach($filterData['height'] as $height)
                    <option value="{{ $height }}" {{ request('height') == $height ? 'selected' : '' }}>{{ $height }}</option>
                @endforeach
            </select>

            <select name="dress_size" onchange="this.form.submit()" class="bg-black/50 border border-white/10 text-gray-400 px-6 py-3 text-[10px] uppercase tracking-widest focus:border-[#C5A059] focus:text-white outline-none transition-all cursor-pointer hover:bg-white/5">
                <option value="">Dress Size</option>
                @foreach($filterData['dress_size'] as $dress_size)
                    <option value="{{ $dress_size }}" {{ request('dress_size') == $dress_size ? 'selected' : '' }}>{{ $dress_size }}</option>
                @endforeach
            </select>

            <select name="bust_size" onchange="this.form.submit()" class="bg-black/50 border border-white/10 text-gray-400 px-6 py-3 text-[10px] uppercase tracking-widest focus:border-[#C5A059] focus:text-white outline-none transition-all cursor-pointer hover:bg-white/5">
                <option value="">Bust Size</option>
                @foreach($filterData['bust_size'] as $bust_size)
                    <option value="{{ $bust_size }}" {{ request('bust_size') == $bust_size ? 'selected' : '' }}>{{ $bust_size }}</option>
                @endforeach
            </select>

            @if(request()->anyFilled(['day', 'hair', 'nationality', 'eyes', 'age', 'height', 'dress_size', 'bust_size']))
                <a href="{{ route('girls.index') }}" class="text-[#C5A059] text-[10px] uppercase tracking-widest px-4 hover:text-white transition-colors">
                    Clear Filters
                </a>
            @endif
        </form>
    </div>

    @if($girls->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-12 gap-y-16">
            @foreach($girls as $girl)
                <x-girl-card :girl="$girl" :index="$loop->index" />
            @endforeach
        </div>
    @else
        <div class="text-center py-20 border border-white/5 bg-white/5 max-w-2xl mx-auto">
            <p class="text-gray-400 italic font-serif text-lg">No girls match your filters.</p>
            <a href="{{ route('girls.index') }}"
                class="inline-block mt-4 text-[#C5A059] uppercase text-xs tracking-widest hover:underline">
                Clear filters
            </a>
        </div>
    @endif
</section>

@endsection
