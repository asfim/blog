@extends('layouts.app')

@section('title', 'Edit Category')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="flex items-center gap-4 mb-10">
        <a href="{{ route('categories.index') }}" class="p-2 rounded-lg glass hover:bg-slate-700 transition">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        </a>
        <h1 class="text-4xl font-bold">Edit Category</h1>
    </div>

    <div class="glass p-8 rounded-3xl">
        <form action="{{ route('categories.update', $category) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            <div class="space-y-2">
                <label for="name" class="text-sm font-semibold text-slate-400 ml-1">Category Name</label>
                <input type="text" name="name" id="name" class="w-full px-5 py-3 rounded-xl bg-slate-800 border border-slate-700 focus:border-indigo-500 outline-none transition" value="{{ old('name', $category->name) }}" required autofocus>
                @error('name') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full btn-primary py-4 rounded-2xl font-bold text-lg">
                    Update Category
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
