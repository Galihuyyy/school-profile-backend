<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Models\User;
use App\Models\UserPermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyAdminEmail;

class ManageAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mode = "create";
        $account = null;
        return view('admin.admin-management.form', compact('mode', 'account'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminRequest $request)
    {
        $data = $request->validated();

        DB::beginTransaction();

        try {
            $user = User::create([
                'name' => $data['name'],
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);

            if (!empty($data['permissions'])) {
                foreach ($data['permissions'] as $permission) {
                    UserPermission::create([
                        'user_id' => $user->id,
                        'slug' => $permission,
                    ]);
                }
            }

            Mail::to($user->email)
            ->send(new VerifyAdminEmail($user));

            DB::commit();

            return redirect()
                ->route('admin::admins.create.success')
                ->with('success', 'Admin berhasil ditambahkan');
        } catch (\Throwable $th) {
            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', 'Gagal menambahkan data: ' . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $admin)
    {
        $account = $admin->load('user_permission');
        $mode = "show";
        return view('admin.admin-management.form', compact('mode', 'account'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $admin)
    {
        $account = $admin->load('user_permission');
        $mode = "edit";
        return view('admin.admin-management.form', compact('mode', 'account'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminRequest $request, User $admin)
    {
        $data = $request->validated();

        DB::beginTransaction();

        try {

            $isEmailChanged = isset($data['email']) && $data['email'] !== $admin->email;

            $payload = [
                'name' => $data['name'] ?? $admin->name,
                'username' => $data['username'] ?? $admin->username,
                'email' => $data['email'] ?? $admin->email,
            ];

            if (!empty($data['password'])) {
                $payload['password'] = Hash::make($data['password']);
            }

            if ($isEmailChanged) {
                $payload['email_verified_at'] = null;
            }


            $admin->update($payload);

            $admin->user_permission()->delete();

            // insert permissions baru
            if (!empty($data['permissions'])) {

                $permissions = collect($data['permissions'])
                    ->map(fn ($permission) => [
                        'user_id' => $admin->id,
                        'slug' => $permission,
                    ])
                    ->toArray();

                UserPermission::insert($permissions);
            }

            if ($isEmailChanged) {
                Mail::to($admin->email)
                    ->send(new VerifyAdminEmail($admin));
            }

            DB::commit();

            $route = $isEmailChanged
                    ? 'admin::admins.create.success'
                    : 'admin::school-settings.index';

            $message = $isEmailChanged
                    ? 'Admin diperbarui. Kami mendeteksi adanya perubahan email.'
                    : 'Admin berhasil diperbarui.';

            return redirect()
                ->route($route)
                ->with('success', $message);

        } catch (\Throwable $th) {

            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', 'Gagal memperbarui data: ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
