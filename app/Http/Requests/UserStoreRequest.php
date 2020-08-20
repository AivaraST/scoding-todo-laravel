<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;

class UserStoreRequest extends FormRequest
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
//        $user = Auth::user();

        return [
            'name' => 'required|min:3|max:30',
            'email' => 'required|unique:users',
            'password' => 'required|same:password_repeat|min:6',
            'password_repeat' => 'required|same:password|min:6',
        ];
    }

    // Handle a failed validation attempt.
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'messages' => $validator->errors()
            ], 400)
        );
    }

}
