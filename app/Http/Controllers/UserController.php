<?php

namespace App\Http\Controllers;

use App\Models\Jobs;
use App\Models\SchoolSettings;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $schoolSetting = SchoolSettings::first();

        return view('guest.index', compact('schoolSetting'));
    }

    public function jobIndex(){
        $jobs = Jobs::with('job_requirements')->paginate(10);
    
        return view('guest.pages.lowongan.index', compact('jobs'));
    }

    public function jobShow(Jobs $lowongan){
        return view('guest.pages.lowongan.show', ['job' => $lowongan]);
    }
}
