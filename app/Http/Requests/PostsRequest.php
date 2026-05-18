<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class PostsRequest extends FormRequest
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
        $isUpdate  = $this->isMethod('PUT') || $this->isMethod('PATCH');

        return [
            'title' => [$isUpdate ? 'sometimes' : 'required', 'string', 'max:150'],
            'slug' => [$isUpdate ? 'sometimes' : 'required', 'string', 'max:50'],
            'content' => [$isUpdate ? 'sometimes' : 'required', 'string'],
            'thumbnail' => [$isUpdate ? 'sometimes' : 'nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'category_id' => [$isUpdate ? 'sometimes' : 'required', 'integer', 'exists:ms_post_categories,id'],
            'status' => [$isUpdate ? 'sometimes' : 'required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Judul wajib diisi.',
            'slug.required' => 'Slug wajib diisi.',
            'content.required' => 'Konten wajib diisi.',
            'thumbnail.mimes' => 'Thumbnail wajib memiliki ekstensi valid.',
            'category_id.required' => 'Kategori wajib diisi.',
            'status.required' => 'Status wajib diisi.',
        ];
    }
}
