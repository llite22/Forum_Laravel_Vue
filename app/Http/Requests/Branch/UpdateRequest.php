<?php

namespace App\Http\Requests\Branch;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'section_id' => ['required', 'integer', 'exists:sections,id'],
            'title' => ['required', 'string', 'max:255'],
            'parent_id' => ['nullable', 'integer', 'exists:branches,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'section_id.required' => 'Поле section_id необходимо для заполнения',
            'title.required' => 'Поле title необходимо для заполнения',
        ];
    }
}
