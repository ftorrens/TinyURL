<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetTinyUrl extends FormRequest
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
            'url' => 'required|url|max:2083',
        ];
    }

    public function messages()
    {
        return [
            'url.required' => 'The url parameter is required.',
            'url.url' => 'The url parameter does not have a valid format.',
            'url.max' => 'The url parameter cannot exceed 2083 characters.',
        ];
    }
}
