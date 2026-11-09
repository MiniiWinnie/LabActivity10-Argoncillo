@extends('app')

@section('title', $post->title)

@section('content')
    <article class="mx-auto flex max-w-3xl flex-col gap-6 px-6 py-10">
        <a href="{{ route('posts.index') }}" class="text-sm font-medium text-teal-700 hover:text-teal-800">
            &larr; Back to posts
        </a>

        <div class="flex flex-wrap items-center gap-2">
            <span class="rounded-full bg-teal-100 px-3 py-1 text-xs font-semibold text-teal-800">
                {{ $post->category }}
            </span>
            @if ($post->is_pinned)
                <span class="rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-800">
                    Pinned
                </span>
            @endif
        </div>

        <div class="flex flex-col gap-3">
            <h1 class="text-3xl font-bold text-slate-900">{{ $post->title }}</h1>
            <p class="text-sm text-slate-500">
                Published {{ $post->published_at->format('F j, Y') }} &middot; {{ $post->views }} views
            </p>
        </div>

        <div class="whitespace-pre-line leading-7 text-slate-700">{{ $post->body }}</div>
    </article>
@endsection
