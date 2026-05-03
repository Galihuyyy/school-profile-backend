<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class TeacherRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $teacherId = $this->route('teacher')?->id;
        $isUpdate  = $this->isMethod('PUT') || $this->isMethod('PATCH');

        return [
            'name' => [$isUpdate ? 'sometimes' : 'required', 'string', 'max:150'],
            'nip' => [$isUpdate ? 'sometimes' : 'required', 'string', 'max:50', 'unique:ms_teachers,nip,' . $teacherId],
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'birth_place' => [$isUpdate ? 'sometimes' : 'required', 'string', 'max:100'],
            'birth_date' => [$isUpdate ? 'sometimes' : 'required', 'date'],
            'join_date' => [$isUpdate ? 'sometimes' : 'required', 'date'],
            'status' => [$isUpdate ? 'sometimes' : 'required', 'string', 'max:50'],
            'active' => 'boolean',
            'group' => [$isUpdate ? 'sometimes' : 'required', 'string', 'max:50'],
            'position' => [$isUpdate ? 'sometimes' : 'required', 'string', 'max:100'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama guru wajib diisi.',
            'nip.required' => 'NIP wajib diisi.',
            'nip.unique' => 'NIP sudah terdaftar.',
            'photo.image' => 'File harus berupa gambar.',
            'photo.max' => 'Ukuran foto maksimal 2MB.',
            'birth_place.required' => 'Tempat lahir wajib diisi.',
            'birth_date.required' => 'Tanggal lahir wajib diisi.',
            'join_date.required' => 'Tanggal bergabung wajib diisi.',
            'status.required' => 'Status wajib diisi.',
            'group.required' => 'Golongan wajib diisi.',
            'position.required' => 'Jabatan wajib diisi.',
        ];
    }
}
