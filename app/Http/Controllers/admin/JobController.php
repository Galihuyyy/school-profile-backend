<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobRequest;
use App\Models\JobRequirement;
use App\Models\Jobs;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sort = $request->sort;
        $active = $request->active;

        $jobs = Jobs::query()

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

        return view('admin.jobs.index', compact('jobs', 'sort', 'active'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobRequest $request)
    {
        $data = $request->validated();
        try {
            DB::beginTransaction();
            $job = Jobs::create(Arr::except($data, 'form_requirements'));

            if (!empty($request->form_requirements[0])) {
                foreach ($data['form_requirements'] as $requirement) {
                    $job->job_requirements()->create([
                        'requirement' => $requirement
                    ]);
                }
            }
            DB::commit();
            return redirect()->route('admin::jobs.show', $job)->with('success', 'Data lowongan berhasil ditambahkan!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Gagal menambahkan data: ' . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Jobs $job)
    {
        $mode = 'show';
        return view('admin.jobs.show', compact('mode', 'job'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jobs $job)
    {
        $mode = 'edit';
        return view('admin.jobs.edit', compact('mode', 'job'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobRequest $request, Jobs $job)
    {
        $data = $request->validated();
        DB::beginTransaction();
        try {
            $job->update(Arr::except($data, 'form_requirements'));

            if (!empty($data['form_requirements'])) {
                JobRequirement::where('job_id', $job->id)->delete();
                $requirements = collect($data['form_requirements'])
                    ->map(fn ($requirement) => [
                        'job_id' => $job->id,
                        'requirement' => $requirement,
                    ])
                    ->toArray();

                JobRequirement::insert($requirements);
            }
            DB::commit();
            return redirect()->route('admin::jobs.show', $job)->with('success', 'Data lowongan berhasil diperbarui.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Gagal memperbarui data: ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jobs $job)
    {
        try {
            $job->delete();
            return redirect()->route('admin::jobs.index')->with('success', 'Data lowongan berhasil dihapus.');
        } catch (\Throwable $th) {
            return back()->withInput()->with('error', 'Gagal menghapus data: ' . $th->getMessage());
        }
    }
}
