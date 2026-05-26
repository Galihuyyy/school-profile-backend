<?php

namespace App\Http\Controllers;

use App\Models\Jobs;
use App\Models\Post;
use App\Models\Teacher;

class UserController extends Controller
{
    public function index(){
        $posts = Post::with(['user', 'post_categories'])->where('status', 'published')->latest()->take(2)->get();

        return view('guest.index', compact('posts'));
    }

    public function jobIndex(){
        $jobs = Jobs::with('job_requirements')->paginate(10);
    
        return view('guest.pages.lowongan.index', compact('jobs'));
    }

    public function jobShow(Jobs $lowongan){
        return view('guest.pages.lowongan.show', ['job' => $lowongan]);
    }

    public function postShow(Post $post){
        $beritaTerkini = Post::with('post_categories')->where('id', '!=', $post->id)
            ->latest()
            ->take(2)
            ->get();

        return view('guest.pages.berita.detail', compact('post', 'beritaTerkini'));
    }

    public function teacherIndex(){
        $teachers = Teacher::paginate(10);

        return view('guest.pages.guru.list-guru', compact('teachers'));
    }

    public function teacherShow(Teacher $guru){
        return view('guest.pages.guru.show', compact('guru'));
    }
    
}
