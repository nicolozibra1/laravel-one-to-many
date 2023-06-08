<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => [
                'required',
                Rule::unique('projects')->ignore($this->project),
                'max:150',
                'min:3'
            ],
            'image' => 'nullable|max:255',
            'description' => 'nullable',
            'functionality' => 'nullable',
            'technologies' => 'nullable',
            'resource' => 'nullable'
        ];
    }
    public function message()
    {
        return [
            'title.required' => 'The title is required',
            'title.unique:projects' => 'This title already exist',
            'title.max' => 'The title must be a maximum of :max characters long',
            'title.min' => 'The title must be a minimum of :min characters long',
        ];
    }
}
