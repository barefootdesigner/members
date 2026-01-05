@extends('layouts.app')

@section('title', $news->title . ' - Brooklyns Babes')

@section('content')

<section class="max-w-4xl mx-auto px-6 py-20">
    <article>
        <div class="mb-12 text-center">
            <time class="text-xs text-gray-500 uppercase tracking-wider">
                {{ $news->created_at->format('F d, Y') }}
            </time>
            <h1 class="text-4xl md:text-6xl font-serif text-white mt-4 mb-8 uppercase tracking-widest">{{ $news->title }}</h1>
        </div>

        <div class="text-gray-400 font-light leading-relaxed prose prose-invert prose-lg max-w-none prose-p:mb-6">
            {!! $news->content !!}
        </div>

        <div class="mt-12 pt-8 border-t border-white/5">
            <a href="{{ route('news.index') }}" class="text-[#C5A059] text-sm uppercase tracking-widest hover:text-white transition-colors">
                ← Back to News
            </a>
        </div>
    </article>
</section>

@endsection
