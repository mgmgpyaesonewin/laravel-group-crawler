<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'profile_name' => 'required',
            'profile_link' => 'required',
            'link' => 'required',
            'text' => 'required',
            'posted_date' => 'required',
            'type'=> 'required',
            'group_id' => 'required',
            'attachments' => 'required',
            'comments' => 'required'
        ];
    }
}
