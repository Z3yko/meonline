<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class UploadRequest extends FormRequest
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
        if($this->boolean('remove')){
            return [ 'remove' => 'boolean', 'image' => 'string'];
        }
        return [
            'remove' => 'boolean',
            'image' =>'image|mimes:png,jpg,jpeg,gif|max:2000',
        ];
    }


}
