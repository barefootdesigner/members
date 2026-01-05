@extends('layouts.app')

@section('title', 'News - Brooklyns Babes')

@section('content')

<section class="max-w-7xl mx-auto px-6 py-20">
    <div class="mb-16 text-center">
        <h1 class="text-4xl md:text-6xl font-serif text-white mb-6 uppercase tracking-widest">Latest News</h1>
        <p class="text-gray-400 font-light max-w-2xl mx-auto">Stay updated with our latest announcements and updates.</p>
    </div>

    @if($news->isEmpty())
        <div class="text-center py-20">
            <p class="text-gray-500 text-lg">No news items available at the moment.</p>
        </div>
    @else
        <div class="max-w-4xl mx-auto space-y-8">
            @foreach($news as $item)
                <article class="bg-[#0A0A0A] border border-white/5 hover:border-[#C5A059]/30 transition-colors duration-300 p-8">
                    <div class="flex items-start justify-between mb-4">
                        <h2 class="text-2xl md:text-3xl font-serif text-white hover:text-[#C5A059] transition-colors">
                            <a href="{{ route('news.show', $item) }}">{{ $item->title }}</a>
                        </h2>
                        <time class="text-xs text-gray-500 uppercase tracking-wider whitespace-nowrap ml-4">
                            {{ $item->created_at->format('M d, Y') }}
                        </time>
                    </div>
                    <div class="text-gray-400 font-light leading-relaxed prose prose-invert max-w-none">
                        {{ Str::limit(strip_tags($item->content), 300) }}
                    </div>
                    <a href="{{ route('news.show', $item) }}" class="inline-block mt-6 text-[#C5A059] text-sm uppercase tracking-widest hover:text-white transition-colors">
                        Read More →
                    </a>
                </article>
            @endforeach
        </div>
    @endif
</section>

@endsection
