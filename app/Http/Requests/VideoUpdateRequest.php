<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VideoUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //开启认证
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //设定认证规则
        return [
            'title' => 'required|max:255',
            'description' => 'max:2000',
            'visibility' => [
                'required',
                Rule::in(['private', 'public', 'unlisted']),
            ],
        ];
    }
}
