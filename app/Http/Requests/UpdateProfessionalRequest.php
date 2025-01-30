<?php

namespace App\Http\Requests;

use App\Models\Professional;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfessionalRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        $rules = Professional::$rules;

        // If a file is uploaded, ensure it's an image
        if ($this->hasFile('img_file')) {
            $rules['img_file'] = [
                'file',
                'image',
                'mimes:jpeg,png,jpg,gif',
                'max:2048'
            ];
        }

        return $rules;
    }

    /**
     * Get custom error messages for specific validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'img_file.image' => 'The uploaded file must be an image.',
            'img_file.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif.',
        ];
    }
}
