<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
            'title'=> ['required', 'string', Rule::unique('events', 'title')->ignore($id, 'id'),
        ],
            'description'=>'required|string',
            'report_description'=>'string',
            'date'=>'required|date',
            'budget'=>'required',
            'price'=>'nullable',
            'club_id'=> 'exists:clubs,id',
            'user_id'=> 'required|exists:users,id',
            'photo'=> [
                
                'required',$this->isMethod('post') ? 'required' : 'sometimes',
                'mimes:jpg,jpeg,png',
            ],
            'report_images'=>[
                
                'mimes:jpg,jpeg,png',
            ],
        ];
    }
}
