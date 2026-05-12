<?php

namespace App\Http\Controllers;

use App\Models\SchoolSettings;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $schoolSetting = SchoolSettings::first();

        return view('guest.index', compact('schoolSetting'));
    }

    public function jobIndex(){

    
        return view('guest.jobs.index');
    }
}
