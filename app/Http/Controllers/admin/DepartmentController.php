<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentRequest;
use App\Models\Department;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DepartmentController extends Controller
{

    private function deleteImage($image) {
        return Storage::disk('public')->delete($image);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $departments = Department::with('headTeacher')
            ->orderBy('name')
            ->when($request->search, function ($q, $search) {
                $q->where('name', 'like', "%$search%")
                    ->orWhereHas('headTeacher', function ($q) use ($search) {
                        $q->where('name', 'like', "%$search%");
                    });
            })
            ->paginate(10);

        return view('admin.department.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teachers = Teacher::where('active', true)->orderBy('name')->get();

        return view('admin.department.create', compact('teachers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DepartmentRequest $request)
    {
        $data = $request->validated();
        DB::beginTransaction();
        try {
            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('departments', 'public');
            }

            Department::create($data);
            DB::commit();
            return redirect()->route('admin::departments.index')->with('success', 'Data jurusan berhasil ditambahkan.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Gagal menambah data: ' . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        $department->load('headTeacher');

        return view('admin.department.show', compact('department'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        $teachers = Teacher::where('active', true)->orderBy('name')->get();

        return view('admin.department.edit', compact('department', 'teachers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DepartmentRequest $request, Department $department)
    {
        $data = $request->validated();
        DB::beginTransaction();
        try {
            if ($request->hasFile('image')) {
                if ($department->image) {
                    $this->deleteImage($department->image);
                }
                $data['image'] = $request->file('image')->store('department', 'public');
            }

            $department->update($data);

            DB::commit();
            return redirect()->route('admin::departments.index')->with('success', 'Data jurusan berhasil diperbarui.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Gagal memperbarui data: ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        DB::beginTransaction();
        try {
            if ($department->image) {
                $this->deleteImage($department->image);
            }

            $department->delete();

            DB::commit();
            return redirect()->route('admin::departments.index')->with('success', 'Data jurusan berhasil dihapus.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Gagal menghapus data: ' . $th->getMessage());
        }
    }
}
