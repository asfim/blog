@extends('layouts.app')

@section('title', 'Blog Dashboard')

@section('content')
<div class="flex justify-between items-center mb-10">
    <div>
        <h1 class="text-4xl font-bold mb-2">My Stories</h1>
        <p class="text-slate-400">Manage your blog content and publications.</p>
    </div>
    <a href="{{ route('blogs.create') }}" class="btn-primary px-6 py-3 rounded-xl font-semibold">
        + Create New Blog
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
    @forelse($blogs as $blog)
    <div class="glass rounded-2xl overflow-hidden flex flex-col group transition-all duration-300 hover:border-indigo-500/50">
        <div class="relative h-48 overflow-hidden">
            <img src="{{ asset('storage/' . $blog->feature_image) }}" alt="{{ $blog->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
            <div class="absolute top-4 left-4">
                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-indigo-600/90 text-white backdrop-blur-sm">
                    {{ $blog->category->name }}
                </span>
            </div>
            <div class="absolute top-4 right-4">
                <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $blog->is_published ? 'bg-emerald-500/90' : 'bg-amber-500/90' }} text-white backdrop-blur-sm">
                    {{ $blog->is_published ? 'Published' : 'Draft' }}
                </span>
            </div>
        </div>

        <div class="p-6 flex-1 flex flex-col">
            <h2 class="text-xl font-bold mb-3 line-clamp-2">{{ $blog->title }}</h2>
            <div class="text-slate-400 text-sm mb-6 line-clamp-3">
                {!! Str::limit(strip_tags($blog->content), 120) !!}
            </div>
            
            <div class="mt-auto flex items-center justify-between gap-4 pt-6 border-t border-slate-700/50">
                <div class="flex gap-2">
                    <a href="{{ route('blogs.show', $blog) }}" class="p-2 rounded-lg bg-slate-700/50 hover:bg-slate-700 text-slate-300 hover:text-white transition" title="View Details">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    </a>
                    <a href="{{ route('blogs.edit', $blog) }}" class="p-2 rounded-lg bg-indigo-500/20 hover:bg-indigo-500/40 text-indigo-400 hover:text-indigo-300 transition" title="Edit">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    </a>
                    <form action="{{ route('blogs.destroy', $blog) }}" method="POST" onsubmit="return confirm('Delete this blog?')" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="p-2 rounded-lg bg-rose-500/20 hover:bg-rose-500/40 text-rose-400 hover:text-rose-300 transition" title="Delete">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                    </form>
                </div>

                <form action="{{ route('blogs.toggle-publish', $blog) }}" method="POST">
                    @csrf
                    <button type="submit" class="text-sm font-semibold {{ $blog->is_published ? 'text-amber-400 hover:text-amber-300' : 'text-emerald-400 hover:text-emerald-300' }} transition">
                        {{ $blog->is_published ? 'Unpublish' : 'Publish' }}
                    </button>
                </form>
            </div>
        </div>
    </div>
    @empty
    <div class="col-span-full py-20 glass rounded-3xl text-center">
        <svg class="w-20 h-20 mx-auto text-slate-700 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l4 4v10a2 2 0 01-2 2z"></path>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14 2v4a2 2 0 002 2h4"></path>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h8m-8 4h5"></path>
        </svg>
        <h3 class="text-xl font-bold mb-2">No blogs found</h3>
        <p class="text-slate-500 mb-8">Start sharing your thoughts with the world today.</p>
        <a href="{{ route('blogs.create') }}" class="btn-primary px-8 py-3 rounded-xl font-semibold">
            Create First Blog
        </a>
    </div>
    @endforelse
</div>
@endsection
