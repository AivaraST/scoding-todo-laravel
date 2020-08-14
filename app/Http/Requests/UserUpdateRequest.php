<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
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
            'name' => 'string|min:1',
            'email' => [
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email'),
            ],
            'password' => 'string|min:1',
        ];
    }

    // Handle a failed validation attempt.
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'error' => $validator->errors()->first()
            ], 400)
        );
    }
}
