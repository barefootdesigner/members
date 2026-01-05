@extends('layouts.app')

@section('content')

    <!-- Full Width Hero Section -->
    <section class="relative w-screen h-screen -ml-0 md:-ml-28 left-0 overflow-hidden">
        <!-- Hero Background Video -->
        <div class="absolute inset-0 w-full h-full">
            <video autoplay muted loop playsinline class="w-full h-full object-cover object-center">
                <source src="{{ asset('homehero.mp4') }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            <!-- Dark Overlay for better text readability -->
            <div class="absolute inset-0 bg-black/50"></div>
            <!-- Bottom Gradient to blend with site background -->
            <div class="absolute inset-x-0 bottom-0 h-64 bg-gradient-to-t from-[#050505] via-[#050505]/80 to-transparent"></div>
        </div>

        <!-- Hero Text Content -->
        <div class="relative z-10 h-full flex items-center justify-center px-8">
            <div class="w-full max-w-4xl text-center">
                <h1 class="text-2xl md:text-4xl lg:text-5xl font-serif font-light text-white mb-16 leading-snug max-w-3xl mx-auto">
                    We present three gorgeous 5* babes each day, <span class="text-[#C5A059]">hand picked</span> for their sensual massage techniques and <span class="text-[#C5A059]">erotic services</span>.
                </h1>

                <!-- Call to Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-5 justify-center items-center">
                    <a href="{{ route('girls.week') }}"
                       class="group relative px-10 py-4 bg-[#C5A059] text-black font-medium uppercase tracking-[0.2em] text-xs hover:bg-white transition-all duration-300 min-w-[220px]">
                        <span class="relative z-10">See Today's Girls</span>
                    </a>
                    <a href="{{ route('girls.index') }}"
                       class="group relative px-10 py-4 border-2 border-[#C5A059] text-[#C5A059] font-medium uppercase tracking-[0.2em] text-xs hover:bg-[#C5A059] hover:text-black transition-all duration-300 min-w-[220px]">
                        <span class="relative z-10">See All Girls</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Overview Section -->
    <section class="max-w-6xl mx-auto px-8 md:px-12 lg:px-20 py-24 md:py-32">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-serif text-white mb-4">
                    Brooklyns Babes Cheshire
                </h2>
                <p class="text-[#C5A059] uppercase tracking-[0.3em] text-sm md:text-base font-medium">
                    Often Imitated – Never Bettered
                </p>
            </div>

            <!-- Main Content -->
            <div class="space-y-8 text-gray-300 leading-relaxed text-center">
                <p class="text-base md:text-lg font-light">
                    Described as Cheshire's premier massage service, with the highest of standards. Upon arrival, you will receive a friendly welcome from our receptionists and are invited to relax with a complimentary beverage in our private lounge whilst you choose the masseuse for your service.
                </p>

                <p class="text-base md:text-lg font-light">
                    With a choice of 3 fabulous ladies each day to choose from, all of which are happy to cater for your every need, we are sure you will find a service perfect for you, be it a soft, sensual GFE or hardcore domination. All descriptions, including ages and abilities, are genuine, and we don't believe in air-brushing images, so what you see is exactly what you will get.
                </p>

                <p class="text-base md:text-lg font-light">
                    We have a choice of three beautifully appointed massage suites with king-size beds and ensuite showers, including the <span class="text-[#C5A059] font-medium">RED ROOM</span>—fully equipped and ready for the naughtiest of you. Of course, we have a full range of uniforms and toys. Appointments are recommended, but you are more than welcome to call in.
                </p>

                <!-- Pricing Highlight -->
                <div class="my-12 py-8 px-8 md:px-12 border-t border-b border-[#C5A059]/30 bg-[#C5A059]/5">
                    <p class="text-center text-xl md:text-2xl font-serif text-white italic">
                        The cost of <span class="text-[#C5A059]">30 minutes</span> massage, shower and service is
                        <span class="text-[#C5A059] text-3xl md:text-4xl not-italic ml-2">£50</span>
                    </p>
                </div>

                <p class="text-base md:text-lg font-light">
                    Whilst we take care to update our rota regularly, please call to ensure the girl you desire is available to prevent any disappointment; our number is <a href="tel:01270215600" class="text-[#C5A059] hover:text-white transition-colors font-medium">01270 215600</a>.
                </p>

                <p class="text-base md:text-lg font-light">
                    To make a booking please call as we do not monitor emails regularly – due to the high content of spam we get.
                </p>

                <!-- Discreet Note -->
                <div class="mt-12 pt-8 border-t border-white/10">
                    <p class="text-sm md:text-base text-gray-400 italic text-center">
                        Pssst….we also have a very discreet rear entrance from our secure private car park.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Available Today Section -->
    @if($todaysGirls->count() > 0)
    <section class="mb-24">
        <div class="max-w-6xl mx-auto px-8 md:px-12 lg:px-20 mb-12">
            <div class="flex items-center justify-between">
                <h2 class="text-2xl md:text-3xl font-serif text-white">Available Today</h2>
                <a href="{{ route('girls.week') }}" class="text-sm text-[#C5A059] hover:text-white transition-colors uppercase tracking-wider">
                    View Week →
                </a>
            </div>
        </div>

        <div class="max-w-6xl mx-auto px-8 md:px-12 lg:px-20">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-12 gap-y-16">
                @foreach($todaysGirls as $girl)
                    <x-girl-card :girl="$girl" :index="$loop->index" />
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Featured Girls Section -->
    @if($featuredGirls->count() > 0)
    <section class="mb-24">
        <div class="max-w-6xl mx-auto px-8 md:px-12 lg:px-20 mb-12">
            <h2 class="text-2xl md:text-3xl font-serif text-white">Featured</h2>
        </div>

        <div class="max-w-6xl mx-auto px-8 md:px-12 lg:px-20">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-12 gap-y-16">
                @foreach($featuredGirls->take(3) as $girl)
                    <x-girl-card :girl="$girl" :index="$loop->index" />
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- All Girls Section -->
    @if($allGirls->count() > 0)
    <section class="mb-24">
        <div class="max-w-6xl mx-auto px-8 md:px-12 lg:px-20 mb-12">
            <div class="flex items-center justify-between">
                <h2 class="text-2xl md:text-3xl font-serif text-white">All Ladies</h2>
                <a href="{{ route('girls.index') }}" class="text-sm text-[#C5A059] hover:text-white transition-colors uppercase tracking-wider">
                    View All →
                </a>
            </div>
        </div>

        <div class="max-w-6xl mx-auto px-8 md:px-12 lg:px-20">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-12 gap-y-16">
                @foreach($allGirls->take(6) as $girl)
                    <x-girl-card :girl="$girl" :index="$loop->index" />
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Latest News Section -->
    @if($news)
    <section class="max-w-6xl mx-auto px-8 md:px-12 lg:px-20 py-16 md:py-24">
        <div class="text-center md:text-left">
            <span class="inline-block border border-[#C5A059] text-[#C5A059] px-4 py-1 text-xs uppercase tracking-widest mb-3">
                Latest News
            </span>
            <h2 class="text-xl md:text-2xl font-serif text-white mb-2">{{ $news->title }}</h2>
            <p class="text-gray-400 font-light max-w-3xl">
                {{ Str::limit(strip_tags($news->content), 200) }}
                <a href="{{ route('news.show', $news) }}" class="text-[#C5A059] hover:text-white ml-2">Read more →</a>
            </p>
        </div>
    </section>
    @endif

@endsection
