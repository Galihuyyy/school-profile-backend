<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest
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
        $isUpdate = $this->isMethod('PUT') || $this->isMethod('PATCH');

        return [
            'head_teacher_id' => [$isUpdate ? 'sometimes' : 'required', 'exists:ms_teachers,id'],
            'image' => $isUpdate ? 'sometimes|nullable|image|mimes:jpg,jpeg,png,webp|max:2048' : 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'name' => [$isUpdate ? 'sometimes' : 'required', 'string', 'max:150'],
            'description' => [$isUpdate ? 'sometimes' : 'required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'head_teacher_id.required' => 'Kepala jurusan wajib dipilih.',
            'head_teacher_id.exists' => 'Guru yang dipilih tidak ditemukan.',
            'image.required' => 'Gambar jurusan wajib diupload.',
            'image.image' => 'File harus berupa gambar.',
            'image.max' => 'Ukuran gambar maksimal 2MB.',
            'name.required' => 'Nama jurusan wajib diisi.',
            'description.required' => 'Deskripsi jurusan wajib diisi.',
        ];
    }
}
