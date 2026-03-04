@extends('layouts.app')

@section('title', 'Edit Blog: ' . $blog->title)

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="flex items-center gap-4 mb-10">
        <a href="{{ route('blogs.index') }}" class="p-2 rounded-lg glass hover:bg-slate-700 transition">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        </a>
        <h1 class="text-4xl font-bold">Edit Blog</h1>
    </div>

    <div class="glass p-8 rounded-3xl">
        <form action="{{ route('blogs.update', $blog) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div class="space-y-2">
                <label for="title" class="text-sm font-semibold text-slate-400 ml-1">Title</label>
                <input type="text" name="title" id="title" class="w-full px-5 py-3 rounded-xl bg-slate-800 border border-slate-700 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none transition" value="{{ old('title', $blog->title) }}" required>
                @error('title') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label for="category_id" class="text-sm font-semibold text-slate-400 ml-1">Category</label>
                    <select name="category_id" id="category_id" class="w-full px-5 py-3 rounded-xl bg-slate-800 border border-slate-700 focus:border-indigo-500 outline-none transition appearance-none" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ (old('category_id', $blog->category_id) == $category->id) ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-2">
                    <label for="feature_image" class="text-sm font-semibold text-slate-400 ml-1">Update Image (optional)</label>
                    <input type="file" name="feature_image" id="feature_image" class="w-full px-5 py-3 rounded-xl bg-slate-800 border border-slate-700 focus:border-indigo-500 outline-none transition cursor-pointer" accept="image/*">
                    <p class="text-xs text-slate-500 mt-1">Leave empty to keep current image</p>
                    @error('feature_image') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="space-y-2">
                <label for="content" class="text-sm font-semibold text-slate-400 ml-1">Content</label>
                <textarea name="content" id="content" rows="10" class="w-full px-5 py-3 rounded-xl bg-slate-800 border border-slate-700 focus:border-indigo-500 outline-none transition" required>{{ old('content', $blog->content) }}</textarea>
                @error('content') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center gap-3 py-2">
                <input type="checkbox" name="is_published" id="is_published" class="w-5 h-5 rounded border-slate-700 bg-slate-800 text-indigo-600 focus:ring-indigo-500 transition" value="1" {{ old('is_published', $blog->is_published) ? 'checked' : '' }}>
                <label for="is_published" class="text-slate-300 font-medium">Published</label>
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full btn-primary py-4 rounded-2xl font-bold text-lg">
                    Update Blog
                </button>
            </div>
        </form>
    </div>

    <div class="mt-8 p-6 glass rounded-2xl flex items-center gap-6">
        <div class="w-24 h-24 rounded-xl overflow-hidden flex-shrink-0">
            <img src="{{ asset('storage/' . $blog->feature_image) }}" class="w-full h-full object-cover">
        </div>
        <div>
            <h3 class="font-semibold text-slate-400 text-sm mb-1">Current Feature Image</h3>
            <p class="text-xs text-slate-500">{{ basename($blog->feature_image) }}</p>
        </div>
    </div>
</div>
@endsection
