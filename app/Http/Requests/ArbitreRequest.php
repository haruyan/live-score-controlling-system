<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ArbitreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'fullname' => [
                'required', 'min:3'
            ],
            'username' => [
                'required', 'min:3', Rule::unique('users')->ignore($this->route()->arbitre->id ?? null)
            ],
            'email' => [
                'required', 'email', Rule::unique('users')->ignore($this->route()->arbitre->id ?? null)
            ],
            'password' => [
                $this->route()->arbitre ? 'nullable' : 'required', 'confirmed', 'min:6'
            ]
        ];
    }
}
