<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::query();

        if ($request->has('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->has('keyword')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->keyword . '%')
                  ->orWhere('description', 'like', '%' . $request->keyword . '%');
            });
        }

        $posts = $query->latest()->paginate(5);

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3|unique:posts,title',
            'description' => 'required|min:10',
            'image' => 'nullable|image|max:2048'
        ]);

        $imagePath = $request->hasFile('image') 
            ? $request->file('image')->store('post_images', 'public') 
            : null;

        $post = Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => Auth::id(),
            'image' => $imagePath,
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Created Post',
            'description' => 'User created a post: ' . $post->title,
        ]);

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|min:3|unique:posts,title,' . $post->id,
            'description' => 'required|min:10',
            'image' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
            if ($post->image && Storage::disk('public')->exists($post->image)) {
                Storage::disk('public')->delete($post->image);
            }
            $post->image = $request->file('image')->store('post_images', 'public');
        }

        $post->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Updated Post',
            'description' => 'User updated post: ' . $post->title,
        ]);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        if ($post->image && Storage::disk('public')->exists($post->image)) {
            Storage::disk('public')->delete($post->image);
        }
        
        $title = $post->title;
        $post->delete();

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Deleted Post',
            'description' => 'User deleted post: ' . $title,
        ]);

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}
