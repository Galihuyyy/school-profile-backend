<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class JobRequest extends FormRequest
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
        $jobId = $this->route('job')?->id;
        $isUpdate  = $this->isMethod('PUT') || $this->isMethod('PATCH');

        return [
            'title' => [$isUpdate ? 'sometimes' : 'required', 'string', 'max:150'],
            'company_name' => [$isUpdate ? 'sometimes' : 'required', 'string', 'max:50'],
            'location' => [$isUpdate ? 'sometimes' : 'required', 'string', 'max:50'],
            'status' => [$isUpdate ? 'sometimes' : 'required', 'boolean'],
            'apply_link' => [$isUpdate ? 'sometimes' : 'required', 'string'],
            'expired_at' => [$isUpdate ? 'sometimes' : 'required', 'date'],
            'description' => [$isUpdate ? 'sometimes' : 'required', 'string'],
            'form_requirements' => [$isUpdate ? 'sometimes' : 'required', 'array'],
            'form_requirements.*' => [$isUpdate ? 'sometimes' : 'nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Judul wajib diisi.',
            'company_name.required' => 'Perusahaan wajib diisi.',
            'location.required' => 'Lokasi wajib diisi.',
            'status.required' => 'Status wajib diisi.',
            'apply_link.required' => 'Link wajib diisi.',
            'expired_at.required' => 'Tanggal wajib diisi.',
            'description.required' => 'Deskripsi wajib diisi.',
            'form_requirements.required' => 'Ketentuan wajib diisi.',
            'form_requirements.*.required' => 'Ketentuan wajib diisi.',
        ];
    }
}
