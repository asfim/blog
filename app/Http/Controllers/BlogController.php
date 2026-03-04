<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('category')->latest()->get();
        return view('blogs.index', compact('blogs'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('blogs.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required',
            'feature_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $request->file('feature_image')->store('blogs', 'public');

        Blog::create([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'content' => $request->content,
            'feature_image' => $imagePath,
            'is_published' => $request->has('is_published'),
        ]);

        return redirect()->route('blogs.index')->with('success', 'Blog created successfully.');
    }

    public function show(Blog $blog)
    {
        return view('blogs.show', compact('blog'));
    }

    public function edit(Blog $blog)
    {
        $categories = Category::all();
        return view('blogs.edit', compact('blog', 'categories'));
    }

    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required',
            'feature_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('feature_image')) {
            if ($blog->feature_image) {
                Storage::disk('public')->delete($blog->feature_image);
            }
            $imagePath = $request->file('feature_image')->store('blogs', 'public');
            $blog->feature_image = $imagePath;
        }

        $blog->update([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'content' => $request->content,
            'is_published' => $request->has('is_published'),
        ]);

        return redirect()->route('blogs.index')->with('success', 'Blog updated successfully.');
    }

    public function destroy(Blog $blog)
    {
        if ($blog->feature_image) {
            Storage::disk('public')->delete($blog->feature_image);
        }
        $blog->delete();
        return redirect()->route('blogs.index')->with('success', 'Blog deleted successfully.');
    }

    public function togglePublish(Blog $blog)
    {
        $blog->is_published = !$blog->is_published;
        $blog->save();
        return back()->with('success', 'Blog status updated.');
    }
}
