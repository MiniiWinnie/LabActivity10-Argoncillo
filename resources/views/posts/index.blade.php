@extends('app')

@section('title', 'Barangay Bulletin – Purok Argoncillo')

@section('content')
    <div class="mx-auto flex max-w-7xl flex-col gap-8 px-6 py-10">
        <div>
            <h1 class="text-3xl font-bold text-slate-900">Barangay Posts</h1>
            <p class="mt-2 text-slate-600">Stay updated with the latest barangay announcements.</p>
        </div>

        <form method="GET" action="{{ route('posts.index') }}" class="flex flex-col gap-2 sm:flex-row">
            <input
                name="q"
                value="{{ request('q') }}"
                placeholder="Search title"
                class="rounded border border-slate-300 px-3 py-2"
            >
            <select name="category" class="rounded border border-slate-300 px-3 py-2">
                <option value="">All categories</option>
                @foreach ($categories as $category)
                    <option value="{{ $category }}" @selected(request('category') === $category)>
                        {{ $category }}
                    </option>
                @endforeach
            </select>
            <button type="submit" class="rounded bg-teal-700 px-4 py-2 font-medium text-white hover:bg-teal-800">
                Filter
            </button>
        </form>

        <div class="grid gap-6 md:grid-cols-2">
            @forelse ($posts as $post)
                <article class="flex flex-col gap-4 rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="flex items-start justify-between gap-4">
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
                        <span class="text-sm text-slate-500">{{ $post->views }} views</span>
                    </div>

                    <div class="flex flex-col gap-2">
                        <h2 class="text-xl font-semibold text-slate-900">
                            <a href="{{ route('posts.show', $post->id) }}" class="hover:text-teal-700">
                                {{ $post->title }}
                            </a>
                        </h2>
                        <p class="text-sm text-slate-500">{{ $post->published_at->format('F j, Y') }}</p>
                    </div>
                </article>
            @empty
                <p class="text-slate-600">No posts match your search.</p>
            @endforelse
        </div>

        <div class="flex flex-col gap-3">
            @if ($posts->total() > 0)
                <div class="flex flex-wrap items-center gap-2">
                    @if ($posts->onFirstPage())
                        <span class="rounded border border-slate-200 px-3 py-2 text-sm text-slate-400">
                            Previous
                        </span>
                    @else
                        <a href="{{ $posts->previousPageUrl() }}" class="rounded border border-slate-300 px-3 py-2 text-sm text-slate-700 hover:bg-slate-100">
                            Previous
                        </a>
                    @endif

                    @for ($page = 1; $page <= $posts->lastPage(); $page++)
                        @if ($page === $posts->currentPage())
                            <span class="rounded border border-teal-700 bg-teal-700 px-3 py-2 text-sm text-white">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $posts->url($page) }}" class="rounded border border-slate-300 px-3 py-2 text-sm text-slate-700 hover:bg-slate-100">
                                {{ $page }}
                            </a>
                        @endif
                    @endfor

                    @if ($posts->hasMorePages())
                        <a href="{{ $posts->nextPageUrl() }}" class="rounded border border-slate-300 px-3 py-2 text-sm text-slate-700 hover:bg-slate-100">
                            Next
                        </a>
                    @else
                        <span class="rounded border border-slate-200 px-3 py-2 text-sm text-slate-400">
                            Next
                        </span>
                    @endif
                </div>

                <p class="text-sm text-slate-600">
                    Showing {{ $posts->firstItem() }}–{{ $posts->lastItem() }} of {{ $posts->total() }} posts
                </p>
            @endif
        </div>
    </div>
@endsection
