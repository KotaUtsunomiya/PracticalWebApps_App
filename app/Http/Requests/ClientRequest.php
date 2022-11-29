<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
            'text' => 'required|max:20',
            'tag_id'  => 'required',
        ];
    }

    public function messages()
    {
        return [
            'text.required'   => 'タスク名を入力してください。',
            'text.max'        => 'タスクは20文字以下で入力してください。',
            'tag_id.required' => 'タグを選択してください。'
        ];
    }
}
