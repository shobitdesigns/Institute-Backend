<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $id=0;
        if(request()->has('id')){$id=request()->id;}
        return [
            'name'          => 'required|string|max:255|regex:/^[\p{L}\p{M}\p{N}\p{Pd}\p{Pc}\p{Zs}]+$/u',
            'email'         => "required|unique:users,email,$id,id",
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name field is required.',
            'name.string'   => 'Name field should be a string.',
            'name.max'      => 'Name field should not exceed 255 characters.',
            'name.regex'    => 'Name field should only contain alphabetical characters.',
        ];
    }
}
