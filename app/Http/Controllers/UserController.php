<?php

namespace App\Http\Controllers;

use App\Models\Jobs;
use App\Models\Post;
use App\Models\SchoolSettings;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $schoolSetting = SchoolSettings::first();
        $posts = Post::with(['user', 'post_categories'])->where('status', 'published')->latest()->take(2)->get();

        return view('guest.index', compact('schoolSetting', 'posts'));
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
}
