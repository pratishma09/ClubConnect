<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\UserNameExists;

class ClubRequest extends FormRequest
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
        $id = $this->route('id');
        return [
            //
            'name'=> ['required', 'string', Rule::unique('clubs', 'name')->ignore($id, 'id'),new UserNameExists,
        ],
            'description'=>'required',
            'tenure_date'=>'date',
            'president'=>'required|string',
            'vice_president'=>'required|string',
            'user_id'=> 'required|exists:users,id',
            'logo'=> [
                $this->isMethod('post') ? 'required' : 'sometimes',
                'mimes:jpg,jpeg,png',
            ]
        ];
    }
}
