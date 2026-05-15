<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostsRequest;
use App\Models\Post;
use App\Models\PostCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{

    private function getCategories() {
        return PostCategories::get(['id', 'name']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('post_categories')->paginate(10)->withQueryString();
        $categories = $this->getCategories();
        return view('admin.posts.index', compact('posts', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mode = "create";
        $categories = $this->getCategories();
        return view('admin.posts.create', compact('mode', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostsRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = auth()->id();
        $data['created_by_name'] = auth()->user()->name;

        if ($request->status === 'published') {
            $data['published_at'] = now();
        }

        DB::beginTransaction();
        try {
            if ($request->hasFile('thumbnail')) {
                $data['thumbnail'] = $request->file('thumbnail')->store('posts', 'public');
            }

            $post = Post::create($data);

            DB::commit();
            return redirect()->route('admin::posts.show', $post)->with('success', 'Berita berhasill ditambahkan.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Gagal menambahkan data: ' . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $mode = "show";
        $categories = $this->getCategories();
        return view('admin.posts.show', compact('mode', 'post', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $mode = "edit";
        $categories = $this->getCategories();
        return view('admin.posts.edit', compact('mode', 'categories', 'post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostsRequest $request, Post $post)
    {
        $data = $request->validated();

        if ($request->status === 'published') {
            $data['published_at'] = now();
        }

        DB::beginTransaction();
        try {
            if ($request->hasFile('thumbnail')) {
                if ($post->thumbnail) {
                    Storage::disk('public')->delete($post->thumbnail);
                }
                $data['thumbnail'] = $request->file('thumbnail')->store('posts', 'public');
            }

            $post->update($data);

            DB::commit();
            return redirect()->route('admin::posts.show', $post)->with('success', 'Berita berhasill diubah.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Gagal menambahkan data: ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $posts)
    {
        //
    }
}
