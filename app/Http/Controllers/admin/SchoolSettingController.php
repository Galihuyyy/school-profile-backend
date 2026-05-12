<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SchoolSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mode = "index";
        $setting = SchoolSettings::first();
        $setting->logo = asset('storage/' . $setting->logo);
        return view('admin.school-setting.index', compact('setting', 'mode'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $mode = "edit";
        $setting = SchoolSettings::first();
        return view('admin.school-setting.index', compact('setting', 'mode'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $data = $request->validate([
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:negeri,swasta',
            'akreditasi' => 'nullable|string',
            'profile_video' => 'nullable|url',
            'location' => 'nullable|string',
            'telephone' => 'nullable|string',
            'email' => 'nullable|email',
        ]);

        DB::beginTransaction();
        try {
            $setting = SchoolSettings::first();

            if ($request->hasFile('logo')) {
                $newPath = $request->file('logo')->store('logos', 'public');

                if ($setting && $setting->logo) {
                    Storage::disk('public')->delete($setting->logo);
                }

                $data['logo'] = $newPath;
            }
    
            $setting->update($data);
    
            DB::commit();
            return redirect()
                ->route('admin::school-settings.index')
                ->with('success', 'Data berhasil disimpan');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()
                ->back()
                ->with('error', 'Data gagal disimpan')
                ->withInput();
        }

    }

    public function updateSocmed(Request $request)
    {
        $request->validate([
            'key' => 'required|in:instagram_url,tiktok_url,youtube_url,facebook_url',
            'url' => 'nullable|url'
        ]);

        $setting = SchoolSettings::first();
        $setting->update([
            $request->key => $request->url
        ]);

        return redirect()
            ->route('admin::school-settings.index')
            ->with('success', 'Data berhasil disimpan');
    }
}
