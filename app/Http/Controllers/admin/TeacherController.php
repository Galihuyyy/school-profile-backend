<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeacherRequest;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sort = $request->sort;
        $active = $request->active;

        $teachers = Teacher::query()

            ->when($active !== null && $active !== '', function ($q) use ($active) {
                $q->where('active', $active);
            })

            ->when($sort, function ($q) use ($sort) {
                $q->orderBy('name', $sort);
            }, function ($q) {
                $q->orderBy('created_at', 'desc');
            })

            ->paginate(10)
            ->withQueryString();

        return view('admin.teacher.index', compact('teachers', 'sort', 'active'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.teacher.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TeacherRequest $request)
    {
        $data = $request->validated();
        DB::beginTransaction();
        try {
            if ($request->hasFile('photo')) {
                $data['photo'] = $request->file('photo')->store('teachers', 'public');
            }

            Teacher::create($data);

            DB::commit();
            return redirect()->route('admin::teachers.index')->with('success', 'Data guru berhasill ditambahkan.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Gagal menambahkan data: ' . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
        return view('admin.teacher.show', compact('teacher'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher)
    {
        return view('admin.teacher.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TeacherRequest $request, Teacher $teacher)
    {
        $data = $request->validated();
        DB::beginTransaction();
        try {
            if ($request->hasFile('photo')) {
                if ($teacher->photo) {
                    Storage::disk('public')->delete($teacher->photo);
                }
                $data['photo'] = $request->file('photo')->store('teachers', 'public');
            }

            $teacher->update($data);
            DB::commit();
            return redirect()->route('admin::teachers.index')->with('success', 'Data guru berhasil diperbarui.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Gagal memperbarui data: ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        DB::beginTransaction();
        try {
            if ($teacher->photo) {
                Storage::disk('public')->delete($teacher->photo);
            }

            $teacher->delete();
            DB::commit();
            return redirect()->route('admin::teachers.index')->with('success', 'Data guru berhasil dihapus.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Gagal menghapus data: ' . $th->getMessage());
        }
    }
}
