@extends('layouts.app')

@section('title', 'Categories')

@section('content')
<div class="flex justify-between items-center mb-10">
    <div>
        <h1 class="text-4xl font-bold mb-2">Categories</h1>
        <p class="text-slate-400">Manage your blog categories.</p>
    </div>
    <a href="{{ route('categories.create') }}" class="btn-primary px-6 py-3 rounded-xl font-semibold">
        + Add New Category
    </a>
</div>

<div class="glass rounded-2xl overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-white/5 border-b border-white/10 text-slate-400 uppercase text-xs font-bold">
            <tr>
                <th class="px-6 py-4">Name</th>
                <th class="px-6 py-4">Blogs Count</th>
                <th class="px-6 py-4 text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-white/10">
            @forelse($categories as $category)
            <tr class="hover:bg-white/5 transition">
                <td class="px-6 py-4 font-semibold text-slate-200">{{ $category->name }}</td>
                <td class="px-6 py-4">
                    <span class="px-3 py-1 rounded-full bg-slate-800 text-xs text-slate-400">
                        {{ $category->blogs_count }} Articles
                    </span>
                </td>
                <td class="px-6 py-4 text-right">
                    <div class="flex justify-end gap-3">
                        <a href="{{ route('categories.edit', $category) }}" class="p-2 rounded-lg bg-indigo-500/20 text-indigo-400 hover:bg-indigo-500/40 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        </a>
                        <form action="{{ route('categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Delete this category?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="p-2 rounded-lg bg-rose-500/20 text-rose-400 hover:bg-rose-500/40 transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="px-6 py-10 text-center text-slate-500">
                    No categories found.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
