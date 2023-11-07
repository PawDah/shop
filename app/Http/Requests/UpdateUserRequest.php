<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'=>'required|max:500',
            'surname'=>'required|max:500',
            'address.city'=>'required|max:255',
            'address.zip_code'=>'required|max:6',
            'address.street'=>'required|max:255',
            'address.street_no'=>'required|max:5',
        ];
    }
}
