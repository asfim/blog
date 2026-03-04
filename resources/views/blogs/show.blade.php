@extends('layouts.app')

@section('title', $blog->title)

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex items-center gap-4 mb-10">
        <a href="{{ route('blogs.index') }}" class="p-2 rounded-lg glass hover:bg-slate-700 transition">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        </a>
        <div class="flex items-center gap-3">
            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-indigo-600/90 text-white">
                {{ $blog->category->name }}
            </span>
            <span class="text-slate-500 text-sm">{{ $blog->created_at->format('M d, Y') }}</span>
        </div>
    </div>

    <article>
        <h1 class="text-5xl font-bold mb-8 leading-tight">{{ $blog->title }}</h1>
        
        <div class="rounded-3xl overflow-hidden mb-12 glass p-2">
            <img src="{{ asset('storage/' . $blog->feature_image) }}" alt="{{ $blog->title }}" class="w-full h-auto rounded-2xl">
        </div>

        <div class="glass p-10 rounded-3xl text-slate-300 text-lg leading-relaxed space-y-6">
            {!! nl2br(e($blog->content)) !!}
        </div>
    </article>

    <div class="mt-12 flex justify-between items-center p-6 glass rounded-2xl">
        <div class="flex items-center gap-4">
            <span class="text-sm text-slate-400">Status:</span>
            <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $blog->is_published ? 'bg-emerald-500/20 text-emerald-400' : 'bg-amber-500/20 text-amber-400' }}">
                {{ $blog->is_published ? 'Published' : 'Draft' }}
            </span>
        </div>
        <div class="flex gap-4">
            <a href="{{ route('blogs.edit', $blog) }}" class="px-6 py-2 rounded-xl bg-indigo-500/20 text-indigo-400 hover:bg-indigo-500/30 transition font-semibold">
                Edit Post
            </a>
            <form action="{{ route('blogs.toggle-publish', $blog) }}" method="POST">
                @csrf
                <button type="submit" class="px-6 py-2 rounded-xl {{ $blog->is_published ? 'bg-amber-500/20 text-amber-400 hover:bg-amber-500/30' : 'bg-emerald-500/20 text-emerald-400 hover:bg-emerald-500/30' }} transition font-semibold">
                    {{ $blog->is_published ? 'Unpublish' : 'Publish' }}
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
