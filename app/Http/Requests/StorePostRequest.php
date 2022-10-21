<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
            'title_en' => 'required|max:255|unique:posts',
            'title_fr' => 'required|max:255|unique:posts',
            'body_en' => 'required|max:1000',
            'body_fr' => 'required|max:1000',
            'category_id' => 'required|numeric',
            'photo' => 'required|image|mimes:png,jpg,jpeg|max:2040',
        ];
    }
}
