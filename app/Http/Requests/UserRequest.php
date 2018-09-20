<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        return [
            'name' => 'required|string|max:10',
            'last_name' => 'required|string|max:20',
            'address' => 'required|string',
            'zip_code' => 'required|digits:5',
            'city' => 'required|string',
            'state' => 'required|string',
            'email' => 'required|email|unique:clients',
        ];
    }

    /**
    * Custom message for validation
    *
    * @return array
    */
    public function messages()
    {
        return [
            'zip_code.required' => 'Zip code is required!',
            'zip_code.digits' => 'Zip code must have 5 digits!',
            'email.required' => 'Email is required!',
            'email.unique' => 'Email is taken!',
            'name.required' => 'Name is required!',
        ];
    }
}
