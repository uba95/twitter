<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfile extends FormRequest
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
            'username' => ['required', 'string', 'max:255', 'regex:/^[a-z0-9_.]+$/', Rule::unique('users')->ignore($this->user)],
            'name' => ['required', 'string', 'max:255'],
            'avatar' => ['image', 'max:4096'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($this->user)],
            'bio' => ['required', 'string', 'min:10'],
            'password' => ['required', 'string', 'min:8', 'max:255', 'confirmed'],
        ];
    }

    public function messages()
    {
        return [
            'avatar.max' => 'The avatar may not be greater than 4MB.'
        ];
    }

}
